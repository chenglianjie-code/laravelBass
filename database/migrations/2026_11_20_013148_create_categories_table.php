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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            // comment() 方法能为表结构注释；
            $table->string('name')->index()->comment('名称');
            $table->text('description')->nullable()->comment('描述');
            // 分类下的帖子数量，计数器
            $table->integer('post_count')->default(0)->comment('帖子数');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
