<?php

namespace Sukohi\WhiteSheet\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class TailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:tail {table? : Table name} 
                                    {--l|limit=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show newest table or rows';

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

        if(!is_null($table_name)) {    // for Rows

            $this->tailRows($table_name);

        } else { // for Tables

            $this->tailTables();

        }

    }

    private function tailTables(){

        $tables = \DB::select('SHOW TABLES');
        $newest_dates = collect();

        foreach ($tables as $table) {

            $key = key($table);
            $table_name = $table->{$key};
            $columns = \Schema::getColumnListing($table_name);

            if (in_array('updated_at', $columns)) {

                $newest_date = \DB::table($table_name)->max('updated_at');

                if (!empty($newest_date)) {

                    $newest_dates->push($newest_date);

                }

            }

        }
        $sorted_newest_dates = $newest_dates->sort();

        if ($sorted_newest_dates->count() > 0) {

            $tails = collect();
            $base_date = $sorted_newest_dates->first();

            foreach ($tables as $table) {

                $key = key($table);
                $table_name = $table->{$key};
                $columns = \Schema::getColumnListing($table_name);

                if (in_array('updated_at', $columns)) {

                    $update_dates = \DB::table($table_name)
                        ->where('updated_at', '>=', $base_date)
                        ->pluck('updated_at');

                    foreach ($update_dates as $update_date) {

                        $tails->push([
                            'table' => $table_name,
                            'updated_at' => $update_date
                        ]);

                    }

                }

            }

            $limit = intval($this->option('limit'));
            $tails = $tails->sortBy('updated_at')
                        ->values()
                        ->splice(-$limit);

            foreach ($tails as $tail) {

                echo $this->info($tail['updated_at'] . ' : [ ' . $tail['table'] . ' ] ');

            }

        } else {

            $this->error('[Error] Rows not found.');

        }

    }

    private function tailRows($table_name){

        $limit = intval($this->option('limit'));
        $updated_dates = \DB::table($table_name)->orderBy('updated_at', 'desc')
                    ->take($limit)
                    ->pluck('updated_at', 'id')
                    ->sort();

        echo $this->info('[ '. $table_name .' ]:');

        foreach ($updated_dates as $id => $updated_date) {

            echo $this->info(' - '. $updated_date .' (ID: '. $id .')');

        }

    }
}
