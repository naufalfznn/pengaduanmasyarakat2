<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasyarakatTable extends Migration
{
    public function up()
    {
        Schema::create('masyarakat', function (Blueprint $table) {
            $table->char('nik', 16)->primary();
            $table->string('nama', 35);
            $table->string('username', 25)->unique();
            $table->string('password', 255);
            $table->string('telp', 13);
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('masyarakat');
    }
}

