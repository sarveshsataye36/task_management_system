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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_user_id')->unsigned();;
            $table->string('project_name');
            $table->binary('project_desc')->nullable();
            $table->string('project_status');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('project_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
