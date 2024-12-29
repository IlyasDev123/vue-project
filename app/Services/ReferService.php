<?php

namespace App\Services;

use App\Models\User;
use App\Models\Refer;
use App\Models\Position;
use App\Utlities\Constants;
use App\Models\CompanyUserMatch;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReferService
{
    public function referCompanyToTalents($request)
    {
        DB::beginTransaction();
        try {
            $notify = [];
            $refers = [];
            $matchs = [];
            $talents = json_decode($request->talentIds);

            foreach ($talents as  $talent) {
                $data = [
                    'talent_id' => $talent,
                    'company_id' => $request->companyId,
                    'position_id' => $request->positionId,
                    'status' => Constants::REFER_TO_BOTH,
                    'refer_by' => auth()->id(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $notify[] = [
                    'sender_id' => Auth::id(),
                    'receiver_id' => $talent,
                    'content' => 'Job refer',
                    'type' => Constants::NOTIFICATION_TYPE['referRequest'],
                    'status' => Constants::REFER_TO_BOTH,
                    'position_id' => $request->positionId,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                array_push($refers, $data);
                unset($data["refer_by"]);
                array_push($matchs, $data);
            }
            Refer::insert($refers);
            $response = CompanyUserMatch::insert($matchs);
            Notification::insert($notify);

            DB::Commit();
            return $response;
        } catch (\Throwable $th) {
            DB::Rollback();
            return false;
        }
    }

    public function getTalentsList($request)
    {
        return User::where(['type' => Constants::USER_TYPE_TALENT, 'is_longer_interested' => true, 'is_blocked' => false])
            ->whereNotExists(
                function ($query) use ($request) {
                    $query->from('refers')
                        ->where('position_id', $request->position_id)
                        ->whereColumn('talent_id', 'users.id');
                }
            )->when($request->name, function ($q) use ($request) {
                $q->whereRaw("concat(first_name, ' ', last_name) like '%" . $request->name . "%' ");
            })
            ->with('TalentMeta', 'jobInterest', 'children')->orderByDesc('id')->simplePaginate();
    }

    public function getEmployerList($request)
    {
        return Position::where('status', Constants::JOB_STATUS['open'])->has('company')
            ->whereNotExists(
                function ($query) use ($request) {
                    $query->from('refers')
                        ->whereColumn('position_id', 'positions.id')
                        ->where('talent_id', $request->talent_id);
                }
            )->when($request->name, function ($q) use ($request) {
                $q->whereHas('company', function ($q) use ($request) {
                    $q->whereRaw("concat(first_name, ' ', last_name) like '%" . $request->name . "%' ")
                        ->orwhereRaw("email like '%" . $request->name . "%' ");
                });
            })->with('salary', 'company.companyMeta.preferWorkLocation', 'profession', 'state', 'experience', 'company.companyMeta.teamLoveableAspect')
            ->get();
    }
}
