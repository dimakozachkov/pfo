<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

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
        $connect = $this->getConnection();
        dd($connect->getPdo());
        
        $select = $connect->select('select * from ru_categories_photo');
        
        dd($select);
    }
	
	private function getConnection()
	{
		return DB::connection('mysql_pfo');
    }
}
