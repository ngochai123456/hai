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
        Schema::create('vnh_contact', function (Blueprint $table) {
            $table->id();//id ,int
            $table->unsignedInteger('user_id');
            $table->string('name',255);
            $table->string('email',255);
            $table->string('phone',255);
            $table->string('title',255);
            $table->mediumText('content');
            $table->unsignedInteger('replay_id');
            $table->timestamps();//create_at. update_at
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedTinyInteger('status')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vnh_contact');
    }
};
