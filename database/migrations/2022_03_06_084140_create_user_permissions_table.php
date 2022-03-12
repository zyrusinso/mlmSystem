<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('role')->nullable();
            $table->string('route_name')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_permissions');
    }
};
