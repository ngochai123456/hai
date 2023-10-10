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
        Schema::create('vnh_brand', function (Blueprint $table) {
           $table->id();//id ,int
            $table->string('name',1000);
            $table->string('slug',1000);
            $table->string('image',1000)->nullable();
            $table->unsignedTinyInteger('sort_order')->default(0);
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
        Schema::dropIfExists('vnh_brand');
    }
};
