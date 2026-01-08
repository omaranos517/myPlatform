<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesson_questions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lesson_id')
                  ->constrained('lessons')
                  ->cascadeOnDelete();

            $table->text('question_text');

            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c')->nullable();
            $table->string('option_d')->nullable();

            $table->enum('correct_answer', ['A', 'B', 'C', 'D']);

            $table->text('explanation')->nullable();

            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_questions');
    }
};
