<?php

namespace App\Console\Commands;

use App\Models\Track;
use Illuminate\Console\Command;

class MonthlyTrackCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'track:update_month_view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update month view tracks monthly';

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
        $tracks = Track::all();
        foreach ($tracks as $track) {
            $track->view_last_month = $track->month_view;
            $track->month_view = 0;
            $track->save();
        }
    }
}
