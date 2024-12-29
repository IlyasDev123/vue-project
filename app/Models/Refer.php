<?php

namespace App\Models;

use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Refer extends Model
{
    use HasFactory;

    protected $fillable = [
        'talent_id',
        'position_id',
        'company_id',
        'status'
    ];


    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function talent()
    {
        return $this->hasOne(User::class, 'id', 'talent_id');
    }

    public function company()
    {
        return $this->hasOne(User::class, 'id', 'company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
