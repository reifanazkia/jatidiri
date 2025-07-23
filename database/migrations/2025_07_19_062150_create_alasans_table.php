<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlasansTable extends Migration
{
    public function up()
    {
        Schema::create('alasan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->text('description')->nullable(); // CKEditor content
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alasan');
    }
}
