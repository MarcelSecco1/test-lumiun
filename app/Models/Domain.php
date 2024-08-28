<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
        'is_blocked',
        'status',
        'priority',
        'description'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeBlocked($query)
    {
        return $query->where('is_blocked', 1);
    }

    public function scopePriority($query)
    {
        return $query->orderBy('priority', 'desc');
    }

    public function scopeDomain($query, $domain)
    {
        return $query->where('domain', $domain);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('domain', 'like', '%' . $search . '%');
    }
}
