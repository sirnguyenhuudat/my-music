<?php

namespace App\Console\Commands;

use App\Models\Album;
use Illuminate\Console\Command;

class MonthlyAlbumCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'album:update_month_view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update month view albums monthly';

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
        $albums = Album::all();
        foreach ($albums as $album) {
            $album->view_last_month = $album->month_view;
            $album->month_view = 0;
            $album->save();
        }
    }
}
