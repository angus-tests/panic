<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['name','long', 'lat'];

    public function getLongAttribute($value): float
    {
        return floatval($value);
    }

    public function getLatAttribute($value): float
    {
        return floatval($value);
    }

}
