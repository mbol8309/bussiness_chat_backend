<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:generate {email=admin@localhost} {password=12345}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin user';

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
        try {
            $admin_role = Role::findOrCreate('super-admin');
            $email = $this->argument('email');
            $password = $this->argument('password');

            $user_data = [
                'name' => 'admin',
                'email' => $email,
                'password' => Hash::make($password),
            ];
            $user = new User($user_data);
            $user->save();
            $user->assignRole($admin_role);

            print("User:$email with password:$password created");

            return 0;
        } catch (Exception $e) {
            print("Error:".$e->getMessage());
            return 1;

        }
    }
}
