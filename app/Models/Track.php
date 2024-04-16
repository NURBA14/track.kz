<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "album_id", "path"
    ];
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function getTrack()
    {
        return 'storage/'. $this->path;
    }
}
