<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    /** @use HasFactory<\Database\Factories\RecordFactory> */
    use HasFactory , SoftDeletes;

    protected $guarded = [];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, "student_id");
    }

    public function evaluation(): BelongsTo
    {
        return $this->belongsTo(Evaluation::class, "student_evaluation");
    }
}
