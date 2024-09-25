<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Desa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products(): HasMany{
        return $this->hasMany(Kelompok::class, 'desa_id');
    }
}
