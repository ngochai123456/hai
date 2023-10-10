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
        Schema::create('vnh_menu', function (Blueprint $table) {
            $table->id();//id ,int
            $table->string('name',255);
            $table->string('link',255);
            $table->unsignedInteger('table_id');
            $table->string('type');
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
        Schema::dropIfExists('vnh_menu');
    }
};
