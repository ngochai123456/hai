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
        Schema::create('vnh_post', function (Blueprint $table) {
            $table->id();//id ,int
            $table->unsignedTinyInteger('topic_id');
            $table->string('title', 1000);
            $table->string('slug',1000);
            $table->mediumText('detail');
            $table->string('image', 1000);
            $table->string('type', 100);
            $table->string('metakey',255);
            $table->string('metadesc',255);
            $table->unsignedInteger('created_by')->default(1);
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
        Schema::dropIfExists('vnh_post');
    }
};
