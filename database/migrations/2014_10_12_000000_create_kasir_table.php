<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_kasir', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->integer('id_cabang');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    // /**
    //  * Reverse the migrations.
    //  */
    // // public function down(): void
    // // {
    // //     Schema::dropIfExists('users');
    // // }
};
