<?php

namespace App\Models;

use App\Models\Refer;
use App\Models\State;
use App\Models\Salary;
use App\Models\CompanyMeta;
use App\Utlities\Constants;
use App\Models\ManagementStyle;
use App\Traits\SubqueriesTrait;
use App\Models\CompanyUserMatch;
use App\Models\TeamLovableAspect;
use App\Models\PreferWorkLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory, SoftDeletes, SubqueriesTrait;

    protected $fillable = [
        'profession_id',
        'salary_id',
        'experience_id',
        'state_id',
        'is_specfic_state',
        'company_id',
        'description',
        'prefer_work_location_id',
        'status'
    ];


    public function recruiterRefer()
    {
        return $this->hasMany(Refer::class, 'position_id', 'id')->where('status', Constants::REFER_STATUS['company']);;
    }

    public function companyUserMatches()
    {
        return $this->hasMany(Position::class, 'position_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id')->where('is_longer_interested', Constants::IS_LONGER_INTEREST['interested'])->where('is_blocked', false);
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class, 'salary_id', 'id');
    }

    public function experience()
    {
        return $this->belongsTo(Experience::class, 'salary_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function industry()
    {
        return $this->hasOne(Industry::class, 'industy_id', 'id');
    }



    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function matchPortfolio()
    {
        return $this->hasOne(CompanyUserMatch::class, 'position_id')->whereNot('status', Constants::TALENT_SEND_REQUEST_TO_COMPANY)->where('talent_id', auth()->id())->where(function ($q) {
            $q->where('status', constants::REFER_TO_BOTH)->orWhere('status', constants::COMPANY_SEND_REQUEST_TO_TALENT);
        });
    }

    public function preferWorklocation()
    {
        return $this->belongsTo(PreferWorkLocation::class);
    }
}
