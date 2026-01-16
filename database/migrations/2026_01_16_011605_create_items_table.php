<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('unit_id');
            $table->decimal('quantity', 10, 2)->default(0);
            $table->timestamps();

            $table->index('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
};
