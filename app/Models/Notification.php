<?php

namespace App\Models;

use App\Models\User;
use App\Traits\NotificationTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory, NotificationTrait;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'type',
        'status',
        'is_read',
        'position_id'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function scopeSearchByEmailAndName($query)
    {
        $query->whereHas("sender", function ($q) {
            $q->whereRaw("concat(first_name, ' ', last_name) like '%" . request()->search . "%' ")
                ->orWhereRaw("email like '%" . request()->search . "%' ");
        });
    }
}
