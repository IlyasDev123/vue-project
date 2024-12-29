<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerSelectionPreference extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
}
