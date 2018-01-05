<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->index('pages_category_id_foreign');
            $table->string('title')->length('125');
            $table->string('content_header')->length('1024')->nullable();
            $table->string('name')->length('125');
            $table->text('content');
            $table->integer('version')->unsigned()->default(0);
            $table->string('page_slug')>length(125);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('page_categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
