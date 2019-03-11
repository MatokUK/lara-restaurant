<?php

namespace App\Console\Commands;

use App\Console\Command\RecordConverter\DataTypeA;
use App\Console\Command\RecordConverter\DataTypeB;
use App\Csv\Reader;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportCsvFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slido:read:csv {--t|truncate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command imports data from specific two files located in csv-data folder.';

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
        $this->line("Import command is running");
        if ($this->option('truncate')) {
            $this->comment('Truncating data...');
            DB::table('restaurant')->delete();
        }

        $this->line("Importing first file");
        $this->importCsvDataA(__DIR__.'/../../../csv-data/restaurants-hours-source-1.csv');
        $this->line("Importing second file");
        $this->importCsvDataB(__DIR__.'/../../../csv-data/restaurants-hours-source-2.csv');
        $this->line("Import command finished");
    }

    private function importCsvDataA(string $filename): void
    {
        $csvReader = new Reader($filename, ['skip_header' => true]);
        $type = new DataTypeA();
        foreach ($csvReader->readLines() as $line) {
            $restaurantAdapter = $type->createRestaurant($line);
            $restaurant = $restaurantAdapter->getRestaurant();
            $restaurant->save();
            $restaurant->openingIntervals()->saveMany($restaurantAdapter->getIntervals($restaurant->getKey()));
        }
    }

    private function importCsvDataB(string $filename): void
    {
        $csvReader = new Reader($filename, ['skip_header' => false]);
        $type = new DataTypeB();
        foreach ($csvReader->readLines() as $line) {
            $restaurantAdapter = $type->createRestaurant($line);
            $restaurant = $restaurantAdapter->getRestaurant();
            $restaurant->save();
            $restaurant->openingIntervals()->saveMany($restaurantAdapter->getIntervals($restaurant->getKey()));
        }
    }
}
