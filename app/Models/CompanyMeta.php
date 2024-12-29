<?php

namespace App\Models;

use App\Models\User;
use App\Models\State;
use App\Models\ManagementStyle;
use App\Models\TeamLovableAspect;
use App\Models\PreferWorkLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyMeta extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name',
        'current_role',
        'description',
        'company_id',
        'state_id',
        'team_loveable_aspect_id',
        'prefer_work_location_id',
        'premium_status',
        'is_hiring'
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }
    public function positions()
    {
        return $this->hasMany(Position::class, 'company_meta_id', 'id');
    }

    public function managementStyles()
    {
        return $this->belongsToMany(ManagementStyle::class, 'company_meta_management_style', 'company_meta_id', 'management_style_id');
    }

    public function state()
    {
        return $this->hasOne(State::class);
    }

    public function preferWorklocation()
    {
        return $this->belongsTo(PreferWorkLocation::class);
    }

    public function teamLoveableAspect()
    {
        return $this->belongsTo(TeamLovableAspect::class);
    }
}
