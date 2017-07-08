<?php

namespace Sukohi\WhiteSheet\Commands;

use Illuminate\Console\Command;

class FindCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:find {keyword : Table or Column name}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Search for column';

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
        $keyword = $this->argument('keyword');
        $tables = \DB::select('SHOW TABLES');
        $matches = [];

        foreach($tables as $table)
        {
            $key = key($table);
            $table_name = $table->{$key};

            if(str_contains($table_name, $keyword)) {

                $matches[$table_name] = [];

            }

            $columns = \Schema::getColumnListing($table_name);

            foreach ($columns as $column) {

                if(str_contains($column, $keyword)) {

                    if(!isset($matches[$table_name])) {

                        $matches[$table_name] = [];

                    }

                    $matches[$table_name][] = $column;


                }

            }

        }

        foreach ($matches as $table => $columns) {

            echo $this->info("\n". '[ '. $table .' ]:');

            foreach ($columns as $column) {

                echo $this->info(' => '. $column);

            }

        }


    }
}
