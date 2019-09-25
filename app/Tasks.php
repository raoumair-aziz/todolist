<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{

    protected $casts = [
        'is_complete' => 'boolean',
    ];

    protected $fillable = [
        'name', 'user_id', 'description', 'is_complete'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
