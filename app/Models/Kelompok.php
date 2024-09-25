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

    public function products(): HasMany{
        return $this->hasMany(Generus::class, 'kelompok_id');
    }

    public function kelompok(): BelongsTo{
        return $this->belongsTo(Desa::class);
    }
}
