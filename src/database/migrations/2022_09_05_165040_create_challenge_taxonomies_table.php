<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengeTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenge_taxonomies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('challenge_id');
            $table->unsignedInteger('user_id');
            $table->string('done_percentage');
            $table->longText('progress');
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
        Schema::dropIfExists('challenge_taxonomies');
    }
}
