<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\SeoSorcery\Utils\Table;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Table::entities(), function (Blueprint $table) {
            $table->id();
            $table->morphs('seoable');
            $table->json('title')->nullable();
            $table->json('slug')->nullable();
            $table->json('description')->nullable();
            $table->string('type')->nullable();
            $table->json('keywords')->nullable();
            $table->json('meta')->nullable();
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
        Schema::dropIfExists(Table::entities());
    }
};
