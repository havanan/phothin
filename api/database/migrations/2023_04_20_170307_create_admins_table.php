<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->nullable()->default(null);
            $table->string('password')->nullable()->default(null);
            $table->dateTime('email_verified_at')->nullable();
            $table->string('verify_email_token')->nullable()->default(null);
            $table->string('phone', 20)->nullable();
            $table->tinyInteger('status')->default(\App\Models\Admin::INACTIVE);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
