<?php

namespace App\Console\Commands;

use App\Models\Track;
use Illuminate\Console\Command;

class WeeklyTrackCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'track:update_week_view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update week view tracks weekly';

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
            $track->view_last_week = $track->week_view;
            $track->week_view = 0;
            $track->save();
        }
    }
}
