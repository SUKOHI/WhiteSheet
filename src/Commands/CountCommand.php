<?php

namespace Sukohi\WhiteSheet\Commands;

use Illuminate\Console\Command;

class CountCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:count {table : Table name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get rows of table';

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
        $table_name = $this->argument('table');
        $count = \DB::table($table_name)->count();
        $count = 12343;
        echo $this->info('[ '. $table_name .' ]: '. $count .' rows');
    }
}
