<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeleteBooksTable extends Migration
{
    public function up()
    {
        Schema::table('books', function ($table) {
            $table->softDeletes();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function ($table) {
            $table->dropSoftDeletes();
        });
    }
}
