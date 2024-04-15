<?php

use App\Models\DictionaryEntry;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sentences', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DictionaryEntry::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('text');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sentences');
    }
};
