<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breeds', function (Blueprint $table) {
            // $table->string('id', 5)->primary();
            $table->id();
            // $table->boolean('complete')->default(0);
            $table->string("code", 4)->unique();
            $table->string("name", 40)->nullable();
            $table->string("url_image")->nullable();
            $table->string("origin", 30)->nullable();
            $table->string("weight_metric", 10)->nullable();
            $table->string("life_span", 7)->nullable();
            $table->text("description")->nullable();
            $table->string("wikipedia_url")->nullable();
            // $table->boolean("indoor");
            // $table->string("lap");
            // $table->string("alt_names")->nullable();
            // $table->integer("adaptability");
            // $table->integer("affection_level");
            // $table->string("child_friendly");
            // $table->string("dog_friendly");
            // $table->string("energy_level");
            // $table->string("grooming");
            // $table->string("health_issues");
            // $table->string("intelligence");
            // $table->string("shedding_level");
            // $table->string("social_needs");
            // $table->string("stranger_friendly");
            // $table->string("vocalisation");
            // $table->string("experimental");
            // $table->string("hairless");
            // $table->string("natural");
            // $table->string("rare");
            // $table->string("rex");
            // $table->string("suppressed_tail");
            // $table->string("hypoallergenic");
            // $table->string("reference_image_id")->nullable();
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
        Schema::dropIfExists('breeds');
    }
}
