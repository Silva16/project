<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediaTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            $table->string('title');
            $table->text('description');
            $table->string('alt'); // img alt property
            $table->smallInteger('flags');

            $table->string('mime_type');
            $table->string('ext_url')->nullable(); // external url
            $table->string('int_file')->nullable(); // internal name
            $table->string('public_name')->nullable();

            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->integer('approved_by')->unsigned();
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');

            $table->integer('replaces_id')->unsigned()->nullable(); // edited version of a comment
            $table->foreign('replaces_id')->references('id')->on('media')->onDelete('cascade');

            $table->integer('state')->unsigned();
            $table->string('refusal_msg')->nullable();

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
        Schema::table('media', function (Blueprint $table) {
            $table->dropForeign('media_project_id_foreign');
            $table->dropForeign('media_created_by_foreign');
            $table->dropForeign('media_approved_by_foreign');
        });
        Schema::drop('media');
    }

}
