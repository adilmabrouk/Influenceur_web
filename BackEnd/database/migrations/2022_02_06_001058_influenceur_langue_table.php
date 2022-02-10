<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InfluenceurLangueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('influenceur_langue', function (Blueprint $table) {
            $table->unsignedBigInteger('influenceur_id');
            $table->unsignedBigInteger('langue_id');
            $table->foreign('influenceur_id')->references('id')->on('influenceurs');
            $table->foreign('langue_id')->references('id')->on('langues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('influenceur_langue');
    }
}
