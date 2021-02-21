<?php

namespace App\Console\Commands;

use Hash;
use Illuminate\Console\Command;
use Illuminate\Foundation\Auth\User;
use Str;

/** @version 1.0.0
 * @author ionut
 * @copyright Copyright (C) 2019 Ionut Grecu
 * @license Royalty Free
 * @requires PHP7
 * @package 
 * @subpackage 
 */
class UserUpdate extends Command {

    protected $signature = 'cli:user-update {email} {--name=} {--password=} {--api-token=}';
    protected $description = 'Create or update user. --name --password --api-token';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $user = User::firstOrNew([
                    'email' => $this->argument('email'),
        ]);

        if (!$user)
            $user = new User;

        if ($this->option('name'))
            $user->name = $this->option('name');

        if (null !== $this->option('password')) {
            if ($this->option('password'))
                $user->password = Hash::make($this->option('password'));
            else
                $user->password = Hash::make($this->ask('Input the password', Str::random(8)));
        }

        if (!$user->password) {
            $password = Str::random(8);
            $user->password = Hash::make($password);
            $this->info('Password: ' . $password);
        }

        $user->save();
    }

}
