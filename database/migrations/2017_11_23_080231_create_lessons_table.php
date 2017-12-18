<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('课程标题');
            $table->string('introduce')->comment('课程介绍');
            $table->string('preview')->comment('课程预览图');
            $table->tinyInteger('iscommend')->comment('是否推荐');
            $table->tinyInteger('ishot')->comment('是否热门');
            $table->smallInteger('click')->comment('查看次数');
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
        Schema::dropIfExists('lessons');
    }
}
