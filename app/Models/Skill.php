<?php

namespace App\Models;

use App\Models\User;
use App\Models\Experience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'profession_id',
        'talent_id',
        'experience_id',
        'company',
        'description',
        'status',
        'salary_id'
    ];

    public function talent()
    {
        return $this->belongsTo(User::class, 'talent_id', 'id');
    }

    public function profession()
    {
        return $this->hasOne(Profession::class, 'id', 'profession_id');
    }

    public function experience()
    {
        return $this->hasOne(Experience::class, 'id', 'experience_id');
    }
}
