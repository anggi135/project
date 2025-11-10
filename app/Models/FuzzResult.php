<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzResult extends Model
{
    protected $table = 'fuzz_results';

    protected $fillable = [
        'fuzz_job_id',
        'matched_word',
        'status',
        'url',
        'snippet',
        'response_time',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function job()
    {
        return $this->belongsTo(FuzzJob::class, 'fuzz_job_id');
    }
}
