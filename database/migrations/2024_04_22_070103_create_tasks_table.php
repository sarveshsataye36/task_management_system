<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('task_project_id')->unsigned();
            $table->bigInteger('task_user_id')->unsigned();
            $table->string('task_name');
            $table->binary('task_details');
            $table->string('task_status');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('task_project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('task_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
