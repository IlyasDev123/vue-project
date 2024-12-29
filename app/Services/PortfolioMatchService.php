<?php

namespace App\Services;

use App\Models\Refer;
use App\Utlities\Constants;
use App\Models\Notification;
use App\Models\CompanyUserMatch;
use Illuminate\Support\Facades\DB;

class PortfolioMatchService
{
    /**
     * @return [type]
     */
    public function portfolioMatchStatus($request)
    {
        DB::beginTransaction();
        try {
            $portfolioMatches = CompanyUserMatch::find($request->matchId);
            if (auth()->user()->type == Constants::USER_TYPE_TALENT) {
                $status =  $portfolioMatches->status == Constants::COMPANY_SEND_REQUEST_TO_TALENT ? Constants::BOTH_ACCEPTED_REQUEST : Constants::TALENT_SEND_REQUEST_TO_COMPANY;
            } else {
                $status =  $portfolioMatches->status == Constants::TALENT_SEND_REQUEST_TO_COMPANY ? Constants::BOTH_ACCEPTED_REQUEST : Constants::COMPANY_SEND_REQUEST_TO_TALENT;
            }
            $portfolioMatches->update([
                'status' =>  $status,
            ]);

            Notification::create([
                'sender_id' => auth()->id(),
                'receiver_id' => auth()->user()->type == Constants::USER_TYPE_TALENT ? $portfolioMatches->company_id :
                    $portfolioMatches->talent_id,
                'content' => 'sent a match request',
                'type' => Constants::NOTIFICATION_TYPE['referRequest'],
                'status' => auth()->user()->type == Constants::USER_TYPE_TALENT ? Constants::NOTIFICATION_STATUS['employer'] :
                    Constants::NOTIFICATION_STATUS['talent'],
                'position_id' => $portfolioMatches->position_id,
            ]);
            DB::commit();

            return $portfolioMatches;
        } catch (\Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    /**
     * @return [type]
     */
    public function deleteSendRequestMatch($id)
    {
        try {
            return CompanyUserMatch::find($id)->forcedelete();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function rejectProfile($request)
    {
        DB::beginTransaction();
        try {
            $portfolioMatches = CompanyUserMatch::find($request->matchId);
            $refer = Refer::where('talent_id', $portfolioMatches->talent_id)->where('position_id', $portfolioMatches->position_id)->first();
            $portfolioMatches->forcedelete();
            $refer->forcedelete();

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollback();
            return false;
        }
    }
}
