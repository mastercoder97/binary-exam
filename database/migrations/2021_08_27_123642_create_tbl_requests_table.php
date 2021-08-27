<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_requests', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('request_id');
            $table->string('request_code')->nullable();

            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')
                            ->references('user_id')
                            ->on('tbl_users');
            
            $table->bigInteger('book_id')->nullable()->unsigned();
            $table->foreign('book_id')
                            ->references('book_id')
                            ->on('tbl_books');

            $table->bigInteger('approved_by')->nullable()->unsigned();
            $table->foreign('approved_by')
                            ->references('user_id')
                            ->on('tbl_users');
            
            $table->date('date_request');
            $table->date('date_approved')->nullable();
            $table->date('date_return')->nullable();
            $table->date('returned')->nullable();
            $table->tinyInteger('status')->default(0);

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
        Schema::dropIfExists('tbl_requests');
    }
}
