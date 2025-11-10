<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzJob extends Model
{
    protected $fillable = [
        'user_id',
        'target',
        'scope_regex',
        'wordlist_name',
        'wordlist_path',
        'concurrency',
        'rate_limit',
        'respect_robots',
        'status',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
        'respect_robots' => 'boolean',
    ];

    // pastikan foreign key sesuai kolom di fuzz_results -> 'fuzz_job_id'
    public function results()
    {
        return $this->hasMany(FuzzResult::class, 'fuzz_job_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
