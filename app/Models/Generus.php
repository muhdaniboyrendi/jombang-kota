<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function guest(): HasOne{
        return $this->hasOne(Guest::class, 'generus_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($generus) {
            $generus->qr_code = $generus->id . '-' . Str::random(10);
            $generus->save();
        });
    }

    public function getQrCodeImageAttribute()
    {
        return QrCode::size(105)->generate($this->qr_code);
    }
}
