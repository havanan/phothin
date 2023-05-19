<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AfterTableAdminAddMoreColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('avatar', 1000)->after('id')->nullable()->default(null);
            $table->text('address')->after('phone')->nullable()->default(null);
            $table->longText('locations')->after('phone')->nullable()->default(null);
            $table->longText('note')->after('phone')->nullable()->default(null);
            $table->tinyInteger('role_id')->after('status')->nullable()->default(0);
            $table->integer('author_id')->after('id')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('address');
            $table->dropColumn('locations');
            $table->dropColumn('note');
            $table->dropColumn('role_id');
            $table->dropColumn('author_id');
        });
    }
}
