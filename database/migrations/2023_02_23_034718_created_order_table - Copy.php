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
        Schema::create('vnh_order', function (Blueprint $table) {
            $table->id();//id ,int
            $table->unsignedInteger('user_id');
            $table->string('name',255);
            $table->string('phone',255);
            $table->string('email',255);
            $table->string('address',255);
            $table->string('note',255);
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
        Schema::dropIfExists('vnh_order');
    }
};
