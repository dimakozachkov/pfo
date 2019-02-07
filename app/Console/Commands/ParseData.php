<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\Orphan;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

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

    protected $url = 'http://prayfororphan.info/';

    /**
     * Create a new command instance.
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
        $this->countries();
        $this->orphans();
    }

    private function countries(): void
    {
        $countries = \DB::connection('mysql_pfo')
            ->table('country')
            ->get();

        $countries->each(function ($item) {
            Country::create([
                'title' => $item->country,
                'code' => $item->code,
            ]);
        });
    }

    private function orphans()
    {
        $orphans = \DB::connection('mysql_pfo')
            ->table('orphans_list')
            ->get();

        $orphans->each(function ($item) {
            $orphan = Orphan::where('orphan_id', $item->child_id)
                ->first()
                ->photos()
                ->first()
                ->update([
                    'url' => $item->image ?? '',
                ]);
        });
    }

    /**
     * @param $photo
     *
     * @return string
     */
    private function storeImage($photo): string
    {
        $randName = '';

        try {
            $randName = Str::random(32).'.jpg';
            $file = file_get_contents($photo);
            file_put_contents("./public/storage/photos/$randName", $file);
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
        } finally {
            return $randName;
        }
    }
}
