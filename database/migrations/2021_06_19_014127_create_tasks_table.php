<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file');
            $table->string('summary');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by');
			$table->unsignedBigInteger('updated_by')->nullable();
			$table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
