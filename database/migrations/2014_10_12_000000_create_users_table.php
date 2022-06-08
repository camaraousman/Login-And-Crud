<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('userId');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        //initialize Id 
        DB::statement("ALTER TABLE users AUTO_INCREMENT = 1981;");

        //insert default user
        DB::table('users')->insert
        ([
            'name' => 'Ousman Camara',
            'email' => 'ousman@gmail.com',
            'role' => '0',
            'password' => Hash::make('password'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
