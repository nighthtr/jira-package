<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jira_posts', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('status');
            $table->string('name');
            $table->text('content');
            $table->integer('date_created');
            $table->integer('date_updated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jira_posts');
    }
};
