<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_books', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('book_id');
            $table->string('book_code', 100);
            $table->string('title');
            $table->string('author');
            $table->integer('orig_quantity');
            $table->integer('moving_quantity')->nullable();
            $table->integer('return_days');
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
        Schema::dropIfExists('tbl_books');
    }
}
