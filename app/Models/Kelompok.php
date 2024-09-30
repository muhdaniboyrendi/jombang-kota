<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelompok extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function generuses(): HasMany{
        return $this->hasMany(Generus::class, 'kelompok_id');
    }

    public function desa(): BelongsTo{
        return $this->belongsTo(Desa::class);
    }

    public function users(): HasMany{
        return $this->hasMany(User::class, 'kelompok_id');
    }
}
