<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Post;
use App\Models\Admin;
use App\Models\Refer;
use App\Models\Skill;
use App\Models\Position;
use App\Models\TalentMeta;
use App\Utlities\Constants;
use Laravel\Scout\Searchable;
use App\Traits\SubqueriesTrait;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, SubqueriesTrait, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_no',
        'type',
        'avatar',
        'recruiter_id',
        'is_agree_with_terms_condition',
        'is_directly_assign',
        'status',
        'is_blocked',
        'premium_status',
        'social_login_id',
        'is_longer_interested'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_longer_interested' => 'boolean',
    ];

    public function talentMeta()
    {
        return $this->hasOne(TalentMeta::class, 'talent_id', 'id');
    }

    public function skills()
    {
        return $this->hasOne(Skill::class, 'talent_id', 'id');
    }

    public function companyMeta()
    {
        return $this->hasOne(CompanyMeta::class, 'company_id', 'id');
    }


    public function recruiterRefers()
    {
        return $this->hasMany(Refer::class, 'company_id', 'id');
    }

    public function positions()
    {
        return $this->hasMany(Position::class, 'company_id', 'id');
    }

    public function refers()
    {
        return $this->hasMany(Refer::class, 'refer_by', 'id');
    }

    public function positionMatches()
    {
        return $this->hasManyThrough(CompanyUserMatch::class, Position::class, 'company_id', 'position_id');
    }

    public function userMatches()
    {
        return $this->hasManyThrough(CompanyUserMatch::class, Position::class, 'company_id', 'talent_id');
    }
    public function matches()
    {
        return $this->hasOne(CompanyUserMatch::class, 'talent_id', 'id');
    }

    public function postLikes()
    {
        return $this->belongsToMany(Post::class, 'user_like_post', 'user_id', 'post_id')->withTimestamps();
    }

    public function getAvatarAttribute($path)
    {
        if ($path && file_exists(public_path('images/img/' . $path))) {
            return $path;
        } else {
            return 'person-placeholder.jpg';
        }
    }

    public function parent()
    {
        return $this->belongsToOne(User::class, 'recruiter_id');
    }

    public function children()
    {
        return $this->hasOne(User::class, 'id', 'recruiter_id');
    }

    public function referToCompany()
    {
        return $this->hasMany(Refer::class, 'talent_id');
    }

    public function jobInterest()
    {
        return $this->hasOne(Skill::class, 'talent_id', 'id')->with('profession:id,name');
    }

    public function referTalent()
    {
        return $this->hasOne(Refer::class, 'talent_id');
    }

    public function referEmployer()
    {
        return $this->hasOne(Refer::class, 'company_id');
    }

    public function toSearchableArray()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
        ];
    }

    public function recruiterRefersCompany()
    {
        return $this->hasMany(Refer::class, 'talent_id', 'id');
    }

    public function talentSkils()
    {
        return $this->hasMany(Skill::class, 'talent_id')->with('profession', 'experience');
    }

    public function scopeSearchByNameAndEmail($query)
    {
        return $query->whereRaw("concat(first_name, ' ', last_name) like '%" . request()->search . "%' ")
            ->orWhereRaw("email like '%" . request()->search . "%' ");
    }
}
