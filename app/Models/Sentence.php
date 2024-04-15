<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sentence extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
    ];

    public function dictionaryEntry(): BelongsTo
    {
        return $this->belongsTo(DictionaryEntry::class);
    }
}
