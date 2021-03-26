<?php

namespace App\Console\Commands;

use \App\Models\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {--name= : The email used to login the admin} {--password= : The password used to login the admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin for the user table';

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
     * @return int
     */
    public function handle()
    {
        if (!$this->option('name')) {
            $this->error('You must specify a --name option');
            return 0;
        }

        if (!$this->option('password')) {
            $this->error('You must specify a --password option');
            return 0;
        }

        try {
            $user = User::factory()->create([
                'name' => 'Super Admin',
                'email' => $this->option('name'),
                'password' => $this->option('password'),
                'avatar_image' => '/',
                'created_by' => 1,
            ]);
            $this->info('Admin created successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === "23000") {
                $this->error('This email address is already taken');
            } else {
                $this->error($e->errorInfo[2]);
            }
        }
    }
}
