<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DictionaryEntry extends Model
{
    use HasFactory;
    use Searchable;

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

    #[SearchUsingPrefix([])]
    #[SearchUsingFullText(['text', 'remarks'])]
    public function toSearchableArray()
    {
        return [
            'text' => $this->text,
            'remarks' => $this->remarks,
        ];
    }
}
