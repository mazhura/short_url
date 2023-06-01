<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkRedirectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_redirects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('link_id');
            $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');

            $table->json('user_data');

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
        Schema::dropIfExists('link_redirects');
    }
}
