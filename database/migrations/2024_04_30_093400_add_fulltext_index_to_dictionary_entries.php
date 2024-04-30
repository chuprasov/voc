<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dictionary_entries', function (Blueprint $table) {
            $table->fulltext('text');
            $table->fulltext('remarks');
        });
    }

    public function down(): void
    {
        Schema::table('dictionary_entries', function (Blueprint $table) {
            $table->dropFullText('text');
            $table->dropFullText('remarks');
        });
    }
};
