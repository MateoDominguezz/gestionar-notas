<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }

    public function records(): HasMany
    {
        return $this->hasMany(Record::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->BelongsToMany(Subject::class, "inscriptions");
    }

    public function evaluations(): BelongsToMany
    {
        return $this->BelongsToMany(Evaluation::class, "records")
                    ->withPivot("note");
    }
}
