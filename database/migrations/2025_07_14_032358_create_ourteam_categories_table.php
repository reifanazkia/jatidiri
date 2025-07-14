<?php

// database/migrations/xxxx_xx_xx_create_ourteam_categories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurteamCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('ourteam_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ourteam_categories');
    }
}
