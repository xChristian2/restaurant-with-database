<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('work_email')->nullable();
            $table->string('personal_email')->nullable();
            $table->text('address')->nullable();
            $table->string('emergency_contact')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'work_email', 'personal_email', 'address', 'emergency_contact']);
        });
    }
};