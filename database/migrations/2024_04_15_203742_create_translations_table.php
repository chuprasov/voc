<?php

use App\Models\DictionaryEntry;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DictionaryEntry::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('lang', 2);
            $table->string('text');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
