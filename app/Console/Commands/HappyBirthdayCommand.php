<?php

namespace App\Console\Commands;

use App\Mail\HappyBirthday;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class HappyBirthdayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:send_mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail happy birthday';

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
        $users = User::where('birthday', 'like', '%' . date('m-d' . '%'))->get();
        foreach ($users as $user) {
            Mail::to($user->email)->queue(new HappyBirthday($user));
        }
    }
}
