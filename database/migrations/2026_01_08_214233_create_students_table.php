<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto increment

            $table->string('name', 100);
            $table->string('password');
            $table->string('phone', 15);
            $table->string('parent_phone', 15);

            $table->enum('stage', ['إعدادية', 'ثانوية']);
            $table->enum('section', ['علمي', 'أدبي'])->nullable();
            $table->enum('educational_type', ['أزهري', 'عام']);

            $table->string('class', 50)->nullable();
            $table->boolean('is_language')->default(false);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
