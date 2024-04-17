<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Singer extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    public function getCreatedAtAttribute($value)
    {
        $createdAt = Carbon::parse($value);        
        return $createdAt->format('Y:m:d H:i:s');
    }
}
