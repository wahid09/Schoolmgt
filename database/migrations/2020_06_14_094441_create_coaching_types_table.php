<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('class_name_id');
            $table->string('coaching_type');
            $table->tinyInteger('status')->default(0);
            $table->foreign('class_name_id')
                  ->references('id')->on('class_names')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('coaching_types');
    }
}
