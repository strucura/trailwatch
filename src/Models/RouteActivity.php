<?php

namespace Strucura\TrailWatch\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RouteActivity extends Model
{
    protected $fillable = [
        'name',
        'path',
        'user_agent',
        'ip_address',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'user_id');
    }
}
