<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dictionary_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('lang', 2);
            $table->string('text');
            $table->string('remarks');
            $table->integer('importance');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dictionary_entries');
    }
};
