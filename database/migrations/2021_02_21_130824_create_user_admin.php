<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateUserAdmin extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $user = User::firstOrNew(['id' => 1]);
        $user->fill([
            'name'=>'Admin',
            'email'=>'ionut@grecu.eu',
            'password'=> \Hash::make('fCMWLbH7Z4XavbeSaTVr')
        ]);
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        User::find(1)->delete();
    }

}
