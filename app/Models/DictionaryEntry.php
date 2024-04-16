<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DictionaryEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lang',
        'text',
        'remarks',
        'importance',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(Translation::class);
    }

    public function sentence(): HasOne
    {
        return $this->hasOne(Sentence::class);
    }
}
