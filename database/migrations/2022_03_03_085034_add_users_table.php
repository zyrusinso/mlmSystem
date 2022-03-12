<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cp_num')->after('email')->nullable();
            $table->string('activation_code')->after('cp_num')->nullable();
            $table->string('endorsers_id')->after('activation_code')->nullable();
            $table->string('referred_by')->after('id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
