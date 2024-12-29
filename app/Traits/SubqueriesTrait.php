<?php

namespace App\Traits;

use App\Utlities\Constants;
use PHPUnit\TextUI\XmlConfiguration\Constant;

trait SubqueriesTrait
{
    public function scopecheckReferByRecruiter($query)
    {
        return  $query->whereExists(
            function ($query) {
                $query->from('refers')
                    ->whereColumn('refers.talent_id', 'users.id')
                    ->where('company_id', auth()->id())
                    ->where('status', Constants::REFER_STATUS['company']);
            }
        );
    }

    /**
     * This function is use to remove applied and reject position from job list
     * @param mixed $query
     *
     * @return [type]
     */
    public function scopeRemoveAllSentRequestPosition($query)
    {
        return  $query->whereNotExists(
            function ($query) {
                $query->from('company_user_matches')
                    ->whereColumn('company_user_matches.position_id', 'positions.id')
                    ->where('talent_id', '!=', auth()->id())
                    ->where(function ($q) {
                        $q->where('status', '!=', Constants::TALENT_SEND_REQUEST_TO_COMPANY)
                            ->orWhere('status', '!=', Constants::COMPANY_REJECT_REQUEST)
                            ->orWhere('status', '!=', Constants::TALENT_REJECT_REQUEST);
                    });
            }
        );
    }

    /**
     * This function is use to check recruiter refer post
     * @param mixed $query
     *
     * @return [type]
     */
    public function scopeGetReferPositions($query)
    {
        return  $query->whereExists(
            function ($query) {
                $query->from('refers')
                    ->whereColumn('refers.position_id', 'positions.id')
                    ->where('talent_id', auth()->id())
                    ->where('status', Constants::REFER_STATUS['talent']);
            }
        );
    }

    /**
     * This function is use to remove applied and reject position from job list
     * @param mixed $query
     *
     * @return [type]
     */
    public function scopeRemoveSentRequestTalent($query)
    {
        return  $query->whereNotExists(
            function ($query) {
                $query->from('company_user_matches')
                    ->whereColumn('company_user_matches.talent_id', 'users.id')
                    ->where('company_id', auth()->id())
                    ->where(function ($q) {
                        $q->where('status', '!=', Constants::COMPANY_SEND_REQUEST_TO_TALENT)
                            ->orWhere('status', '!=', Constants::COMPANY_REJECT_REQUEST)
                            ->orWhere('status', '!=', Constants::TALENT_REJECT_REQUEST);
                    });
            }
        );
    }
}
