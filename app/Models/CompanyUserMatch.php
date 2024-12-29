<?php

namespace App\Models;

use App\Models\User;
use App\Models\Position;
use App\Models\CompanyMeta;
use App\Utlities\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyUserMatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'talent_id',
        'position_id',
        'company_id',
        'status',
        'interview_request',
        'interview_start_date_time',
        'interview_end_date_time'
    ];

    public function scopeCheckAppliedJobs($query)
    {
        return  $query->whereExists(
            function ($query) {
                $query->from('positions')
                    ->whereColumn('positions.id', 'company_user_matches.position_id')
                    ->where('talent_id', auth()->id());
            }
        );
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function talent()
    {
        return $this->belongsTo(User::class, 'talent_id');
    }

    public function companyMeta()
    {
        return $this->hasManyThrough(CompanyMeta::class, Position::class, 'company_id', 'company_id');
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function appliedPosition()
    {
        return $this->hasOne(Position::class, 'id')->where('talent_id', auth()->id())->where(function ($q) {
            $q->where('status', Constants::BOTH_ACCEPTED_REQUEST);
        });
    }
}
