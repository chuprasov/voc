<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang',
        'text',
    ];

    public function dictionaryEntry(): BelongsTo
    {
        return $this->belongsTo(DictionaryEntry::class);
    }
}
