<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);

            $table->enum('stage', ['إعدادية', 'ثانوية']);
            $table->string('class', 20);

            $table->enum('section', ['علمي', 'أدبي'])->nullable();
            $table->enum('educational_type', ['أزهري', 'عام']);

            $table->boolean('is_language')->default(false);

            $table->decimal('price_yearly', 10, 2)->nullable();
            $table->decimal('price_monthly', 10, 2)->nullable();

            $table->integer('months_count')->default(10);
            $table->string('link')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
