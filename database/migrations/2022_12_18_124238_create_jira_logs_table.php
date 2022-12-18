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
        Schema::create('jira_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('jira_post_id')->nullable();
            $table->string('issue_url');
            $table->integer('issue_id');
            $table->jsonb('fields');
            $table->integer('created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jira_logs');
    }
};
