<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Generus extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kelompok(): BelongsTo{
        return $this->belongsTo(Kelompok::class);
    }

    public function desa(): BelongsTo{
        return $this->belongsTo(Desa::class);
    }
}
