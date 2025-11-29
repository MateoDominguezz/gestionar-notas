<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function evaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class);
    }

    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, "inscriptions")
                    ->withPivot("registration_date")
                    ->withTimestamps();
    }

    public function records(): HasManyThrough
    {
        return $this->hasManyThrough(Record::class, Evaluation::class);
    }
}
