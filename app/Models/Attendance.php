<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'generus_id', 'attended_at'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function generus()
    {
        return $this->belongsTo(Generus::class);
    }
}
