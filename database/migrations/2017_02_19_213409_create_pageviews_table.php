<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageviewsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pageviews', function (Blueprint $table) {
            $table->integer('ip_id');
            $table->string('page');
            $table->timestamp('created_at')->nullable();
        });

        Schema::table('pageviews', function($table) {
            $table->foreign('ip_id')->references('ip_id')->on('uniqueips');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('pageviews');
    }

}
