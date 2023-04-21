<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->nullable()->default(null);
            $table->dateTime('email_verified_at')->nullable();
            $table->string('verify_token')->nullable()->default(null);
            $table->string('phone', 20);
            $table->dateTime('phone_verified_at')->nullable();
            $table->tinyInteger('gender')->nullable()->default(null);
            $table->string('password')->nullable()->default(null);
            $table->tinyInteger('status')->default(User::INACTIVE);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
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
}
