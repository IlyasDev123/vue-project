<?php

namespace App\Services;

use Mail;
use App\Mail\SendMail;
use App\Models\CompanyMeta;
use App\Models\CompanyUserMatch;
use App\Utlities\Constants;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManageRequestService
{
    public function getFullAccessRequest($request)
    {
        return Notification::when($request->search, function ($q) {
            $q->SearchByEmailAndName();
        })->where('status', Constants::NOTIFICATION_STATUS['sendAdminAndRecruiter'])
            ->with('sender.companyMeta')
            ->where('type', Constants::NOTIFICATION_TYPE['fullAccessRequest'])
            ->get();
    }

    public function getInterviewRequests()
    {
        return CompanyUserMatch::where('interview_request', Constants::SENT_INTERVIEW_REQUEST)
            ->with('talent', 'position', 'company')->get();
        
        return Notification::where('type', Constants::NOTIFICATION_TYPE['fullAccessRequest'])
            ->where('status', Constants::NOTIFICATION_STATUS['sendAdminAndRecruiter'])->with('sender.companyMeta')
            ->get();
    }

    public function updateFullAccessRequest($request)
    {
        DB::beginTransaction();
        try {

            $companyMeta =  CompanyMeta::findOrFail($request->company_meta_id);
            $companyMeta->update([
                'premium_status' => $request->status
            ]);
            Notification::find($request->notification_id)->delete();
            $mailData = [
                "message" => "The administrator has approved your request for full access."
            ];
            if ($request->status == Constants::PREMIUM_STATUS['premium']) {
                Mail::to($request->email)->send(new SendMail($mailData));
            }
            DB::commit();

            return true;
        } catch (\Throwable $th) { 
            DB::rollBack();
            return false;
        }
    }

    public function scheduleInterviewRequest($request)
    {
        DB::beginTransaction();

        try {

            $match = CompanyUserMatch::with('talent', 'company')->find($request->id);
            if ($match) {

                $date = Carbon::parse($request->datetime)->format('Y-m-d H:i:s');

                $match->details = $request->description;
                $match->interview_start_date_time = $date;
                $match->status = Constants::SENT_INTERVIEW_REQUEST;
                $match->interview_request = Constants::INTERVIEW_REQUEST['admin'];
                $match->save();

                DB::commit();

                $mailData = [
                    "message" => "Interview has been scheduled with the employer"
                ];
                Mail::to($match->talent->email)->send(new SendMail($mailData));

                $mailData = [
                    "message" => "Interview has been scheduled with the talent."
                ];
                Mail::to($match->company->email)->send(new SendMail($mailData));

                return $match;
            }

            return false;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
