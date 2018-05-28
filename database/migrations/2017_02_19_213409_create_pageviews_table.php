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
            $table->integer('ip_id')->unsigned();
            $table->foreign('ip_id')->references('ip_id')->on('uniqueips');
            $table->string('page');
            $table->string('requested_page');
            $table->timestamp('created_at')->nullable();
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
