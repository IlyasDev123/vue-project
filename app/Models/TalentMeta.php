<?php

namespace App\Models;

use App\Models\User;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TalentMeta extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'talent_id',
        'current_role',
        'cv',
        'is_searching',
        'state_id',
        'prefer_work_location_id',
        'employer_selection_preference_id',
        'coworker_review_id',
        'hobby_id',
        'description',
        'salary_id',
        'status'
    ];

    public function talent()
    {
        return $this->belongsTo(User::class, 'talent_id');
    }

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function hobbies()
    {
        return $this->hasOne(Hobby::class, 'id', 'hobby_id');
    }

    public function salary()
    {
        return $this->hasOne(Salary::class, 'id', 'salary_id');
    }


}
