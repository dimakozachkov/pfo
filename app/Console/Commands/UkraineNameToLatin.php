<?php

namespace App\Console\Commands;

use App\Models\Orphan;
use Illuminate\Console\Command;

class UkraineNameToLatin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'name:convert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $charLibs = [
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ґ' => 'G',
        'Д' => 'D', 'Е' => 'E', 'Є' => 'E', 'Э' => 'E', 'Ж' => 'J',
        'З' => 'Z', 'И' => 'I', 'І' => 'I', 'Ї' => 'I', 'Ы' => 'I',
        'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M',
        'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R',
        'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F',
        'Х' => 'Kh', 'Ц' => 'Ts', 'Ч' => 'Ch', 'Ш' => 'Sh',
        'Щ' => 'Sch', 'Ь' => '', 'Ю' => 'Yu', 'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ґ' => 'g',
        'д' => 'd', 'е' => 'e', 'є' => 'e', 'э' => 'e', 'ж' => 'j',
        'з' => 'z', 'и' => 'i', 'і' => 'i', 'ї' => 'i', 'ы' => 'i',
        'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm',
        'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f',
        'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh',
        'щ' => 'sch', 'ь' => '', 'ю' => 'yu', 'я' => 'ya',
        ' ' => ' ', '-' => '-'
    ];

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
        $orphans = Orphan::all();

        if ($orphans !== null && $orphans->count() > 0) {

            $orphans->each(function (Orphan $orphan) {
                $firstName = $this->stringToArray($orphan->first_name);

                $latinName = '';

                foreach ($firstName as $char) {
                    $latinName .= $this->charLibs[$char] ?? $char;
                }

                unset($char);

                $lastName = $this->stringToArray($orphan->last_name);

                $latinLastName = '';

                foreach ($lastName as $char) {
                    $latinLastName .= $this->charLibs[$char] ?? $char;
                }

                unset($char);

                $orphan->update(['first_name' => $latinName, 'last_name' => $latinLastName]);
            });

        }
    }

    /**
     * @param $str
     * @return string[]
     */
    private function stringToArray($str): array
    {
        $len = mb_strlen($str, 'UTF-8');
        $result = [];
        for ($i = 0; $i < $len; $i++) {
            $result[] = mb_substr($str, $i, 1, 'UTF-8');
        }

        return $result;
    }
}
