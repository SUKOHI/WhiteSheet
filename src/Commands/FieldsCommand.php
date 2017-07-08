<?php

namespace Sukohi\WhiteSheet\Commands;

use Illuminate\Console\Command;

class FieldsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:fields {table : Table name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show table fields(columns)';

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
        $columns = \DB::select(\DB::raw('SHOW COLUMNS FROM `'. $table_name. '`'));

        $this->info('[ '. $table_name .' ]:');

        foreach($columns as $column){

            $this->info(' - '. $column->Field);


        }
    }
}
