<?php

namespace App\Console\Commands;

use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class ParseData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command parse all data of the old pfo project';

    protected $url = "http://prayfororphan.info/";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $countriesLinks = $this->countries();

        $orphansLink = [];

        foreach ($countriesLinks as $countryLink) {
            $orphansLink[] = \array_flatten($this->getOrphans($countryLink));
        }

        $orphansLinks = \array_flatten($orphansLink);

        foreach ($orphansLinks as $orphanLink) {
            $this->saveOrphan($orphanLink);
        }
    }

    /**
     * @return array
     */
    private function countries()
    {
        $html = file_get_contents($this->url);
        $crawler = new Crawler($html);
        $crawler = $crawler->filter('.main')
            ->filter('section.gallery .gallery-bot');

        $countries = $crawler
            ->filter('p.gallery-bot__name')
            ->each(function (Crawler $node) {
                return $node->text();
            });

        foreach ($countries as $country) {
            Country::create([
                'title' => $country,
                'code' => $country,
            ]);
        }

        return $crawler->filter('a.gallery-bot__album')
            ->each(function (Crawler $node) {
                return $node->attr('href');
            });
    }

    private function getOrphans(string $link): array
    {
        $html = file_get_contents($this->url . $link);
        $crawler = new Crawler($html);
        $pages = $crawler->filter('ul.gallery-pages__list .gallery-pages__item');
        $orphansLink = [];

        if ($pages->count() > 1) {
            $lastLink = $pages->last()->filter('.gallery-pages__link')->attr('href');
            $count = ((int)explode('=', $lastLink)) + 40;
            $countPages = $count / 40;

            for ($i = 0; $i < $countPages; $i++) {
                $orphansLink[] = $this->getOrphansLinks($link . '&entry=' . $i);
            }
        } else {
            $orphansLink[] = $this->getOrphansLinks($link . '&entry=0');
        }

        return $orphansLink;
    }

    /**
     * @param string $link
     *
     * @return array
     */
    private function getOrphansLinks(string $link): array
    {
        $html = file_get_contents($this->url . $link);
        $crawler = new Crawler($html);
        $elements = $crawler->filter('.gallery-bot .col-md-4')
            ->each(function (Crawler $node) {
                return $node->filter('.gallery-bot__box .gallery-bot__album');
            });

        $links = [];

        /**
         * @var Crawler $link
         */
        foreach ($elements as $element) {
            $links[] = $element->attr('href');
        }

        return $links;
    }

    private function saveOrphan($link)
    {
        $html = file_get_contents($this->url . $link);

        $crawler = new Crawler($html);
        $profile = $crawler->filter('.section_profile');

        $first_name = $profile->filter('p.section-profile__title')
            ->filter('span.section-profile__title-inner.float-left')
            ->text();

        $last_name = "";

        $birthday = $profile->filter('li.section__item_birthday');

        if ($birthday->count() > 0) {
            $birthday = trim(explode(':', $birthday->text())[1]);

            if (strlen($birthday) > 2 && strlen($birthday) <= 4) {
                $birthday = Carbon::createFromFormat('Y-m-d', "$birthday-01-01")->toDateString();
            } elseif (strlen($birthday) > 4) {
                $year = strlen(explode('/', $birthday)[2]) > 2;
                if ($year) {
                    $birthday = Carbon::createFromFormat('m/d/Y', $birthday)->toDateString();
                } else {
                    $birthday = Carbon::createFromFormat('m/d/y', $birthday)->toDateString();
                }
            } else {
                $birthday = Carbon::createFromFormat('y-m-d', "$birthday-01-01")->toDateString();
            }
        } else {
            $birthday = Carbon::now()->toDateString();
        }

        $class = $profile->filter('li.section__item_classroom');

        if ($class->count() > 0) {
            $class = $class->text();

            preg_match('!\d+!', $class, $classNumber);

            $class = $classNumber[0];
        } else {
            $class = 0;
        }

        $user_id = 1;

        $country = $profile->filter('a.section-profile__box img')
            ->attr('alt');

        $country = Country::where('title', $country)->first();

        $ul = $profile->filter('ul.section__list.section__list_company');
        $address = $ul->filter('li.section__item.section__item_adress');

        $about = $crawler->filter('p.section__description');

        $aboutText = "";

        if ($about->count() > 0) {
            $about = $about->each(function (Crawler $node) {
                return $node->text();
            });

            foreach ($about as $a) {
                $aboutText .= $a;
            }
        }

        if ($address->count() > 0) {
            $address = $address->text();

            $residence = $country->residences()
                ->where('title', $address)
                ->first();

            if (isset($residence) && !$residence->exists) {
                $residence = $country->residences()->create([
                    'country_id' => $country->id,
                    'title' => $address,
                ]);

                $orphan = $residence->orphans()->create([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'birthday' => $birthday,
                    'class' => $class,
                    'user_id' => $user_id,
                    'about' => $aboutText,
                ]);
            } else {
                $orphan = $country->orphans()->create([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'birthday' => $birthday,
                    'class' => $class,
                    'user_id' => $user_id,
                    'about' => $aboutText,
                ]);
            }
        } else {
            $orphan = $country->orphans()->create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'birthday' => $birthday,
                'class' => $class,
                'user_id' => $user_id,
                'about' => $aboutText,
            ]);
        }

        $avatar = $this->removeTag(
            $profile->filter('#edit-avatar')
                ->attr('style')
        );

        $randName = "";

        if (explode('/', $avatar) >  4) {
            $randName = $this->storeImage($avatar);
        }

        $orphan->photos()->create([
            'url' => $randName,
            'weight' => 100,
            'main' => true,
        ]);

        $crawler->filter('a.open_window .gallery__img')
            ->each(function (Crawler $node) use ($orphan) {
                $photo = $this->removeTag($node->attr('style'));

                if (explode('/', $photo) >  4) {

                    $randName = $this->storeImage($photo);

                    $orphan->photos()->create([
                        'url' => $randName,
                        'weight' => rand(0, 99),
                        'main' => false,
                    ]);
                }
            });
    }

    /**
     * @param $photo
     *
     * @return string
     */
    private function storeImage($photo): string
    {
        $randName = "";

        try {
            $avatar = str_replace('thumb', 'photo', $photo);
            $avatar = $this->url . $avatar;

            $randName = Str::random(32) . '.jpg';
            $file = file_get_contents($avatar);
            file_put_contents("./public/storage/photos/$randName", $file);
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        } finally {
            return $randName;
        }
    }

    /**
     * @param string $attr
     *
     * @return string
     */
    private function removeTag(string $attr): string
    {
        return substr(explode('(', $attr)[1], 0, -2);
    }

}
