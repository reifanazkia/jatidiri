<?php

// database/migrations/xxxx_xx_xx_create_services_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug'); // Tidak pakai unique
            $table->string('title1')->nullable();
            $table->text('description1')->nullable();
            $table->string('image1')->nullable();
            $table->string('title2')->nullable();
            $table->text('description2')->nullable();
            $table->string('image2')->nullable();
            $table->string('title3')->nullable();
            $table->text('description3')->nullable();
            $table->string('image3')->nullable();
            $table->string('title4')->nullable();
            $table->text('description4')->nullable();
            $table->string('image4')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

