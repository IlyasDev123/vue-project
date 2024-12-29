<?php

namespace App\Services;

use App\Models\User;
use App\Models\Refer;
use App\Models\Position;
use App\Models\CompanyMeta;
use App\Utlities\Constants;
use App\Models\Notification;
use App\Models\CompanyUserMatch;
use App\Traits\NotificationTrait;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    use NotificationTrait;
    /**
     * @param mixed $request
     *
     * @return [type]
     */
    public function createJob($request)
    {
        try {
            $input = $request->except(['token']);
            $position = auth()->user()->positions()->updateOrCreate(
                [
                    'profession_id' => $input['profession_id']
                ],
                $input
            );

            return  $position;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * @param mixed $id
     * @param mixed $status
     *
     * @return [type]
     */
    public function updateJobStatus($request)
    {
        try {
            return Position::findOrFail($request->id)->update([
                'status' => $request->status
            ]);
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * This function is used to get all talent for matching
     * @return [type]
     */
    public function getAllTalent($request)
    {
        $talentId = CompanyUserMatch::select('talent_id')
            ->where(function ($q) {
                $q->where('status', Constants::TALENT_SEND_REQUEST_TO_COMPANY)
                    ->orWhere('status', Constants::REFER_TO_BOTH);
            })->where('company_id', auth()->id())->pluck('talent_id');

        return User::where('is_longer_interested', true)
            ->when($request->searchItem, function ($q) use ($request) {
                $q->where(function ($q) use ($request) {
                    $q->whereRaw("concat(first_name, ' ', last_name) like '%" . $request->searchItem . "%' ")
                        ->orwhereRaw("email like '%" . $request->searchItem . "%' ");
                });
            })
            ->where('type', Constants::USER_TYPE_TALENT)
            ->whereIn('id', $talentId)->with('skills.profession', 'skills.experience', 'matches', 'talentMeta.state', 'talentMeta.hobbies', 'talentMeta.salary')
            ->orderByDesc('id')->get();
    }

    /**
     * @return [type]
     */
    public function myTalentList($request)
    {
        return CompanyUserMatch::with('talent', 'position.profession')->has('position')
            ->when($request->searchItem, function ($q) use ($request) {
                $q->whereHas('talent', function ($q) use ($request) {
                    $q->whereRaw("concat(first_name, ' ', last_name) like '%" . $request->searchItem . "%' ")
                        ->orwhereRaw("email like '%" . $request->searchItem . "%' ");
                });
            })
            ->where('company_id', auth()->id())
            ->where('status', Constants::BOTH_ACCEPTED_REQUEST)->simplePaginate();
    }

    /**
     * @return [type]
     */
    public function showMyTalent($id)
    {
        return User::with('skills.profession', 'matches')->findOrFail($id);
    }

    /**
     * @return [type]
     */
    public function sendFullAccessRequest()
    {
        DB::beginTransaction();
        try {
            auth()->user()->companyMeta()->update([
                'premium_status' => Constants::PREMIUM_STATUS['pending']
            ]);
            Notification::create([
                'sender_id' => auth()->id(),
                'receiver_id' => auth()->id(),
                'status' => Constants::NOTIFICATION_STATUS['sendAdminAndRecruiter'],
                'type' => Constants::NOTIFICATION_TYPE['fullAccessRequest'],
                'content' => "send Full access request",
            ]);
            DB::commit();

            return auth()->user()->load('companyMeta');
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param mixed $request
     *
     * @return [type]
     */
    public function sendInterviewRequest($request)
    {
        DB::beginTransaction();
        try {
            $data = CompanyUserMatch::find($request->company_user_match_id);
            $data->update([
                'interview_request' => Constants::SENT_INTERVIEW_REQUEST
            ]);
            $data['recruiter_id'] = $request->recruiter_id;
            $data['content'] = auth()->user()->first_name . ' sent interview request to ' . $request->talent_name;
            $data['type'] = Constants::NOTIFICATION_TYPE['employerSentInterviewRequest'];
            $data['status'] = Constants::NOTIFICATION_STATUS['sendAdminAndRecruiter'];
            $this->sendNotification($data);
            DB::commit();

            return $data->refresh();
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }

    public function getPositionDetail($id)
    {
        return Position::with('company.companyMeta.managementStyles')->findOrFail($id);
    }

    /**
     * Get the current login user
     * @return [type]
     */
    public function getPositions()
    {
        return Position::where('company_id', auth()->id())->with('profession:id,name')->simplePaginate();
    }

    /**
     * @Description
     * @param mixed $user
     * @param mixed $input
     *
     * @return [type]
     */
    public function updatePosition($request)
    {
        try {
            $position =  Position::find($request->position_id);
            $position->update($request->all());

            return  $position->load("company.companyMeta");
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * @Description
     * @param mixed $user
     * @param mixed $input
     *
     * @return [type]
     */
    public function updateCompanyMeta($request)
    {
        try {

            $companyMeta = CompanyMeta::find($request->id);
            $companyMeta->update([
                "company_name" => $request->company_name,
                "current_role" => $request->current_role,
                "state_id" => $request->state_id,
                "prefer_work_location_id" => $request->prefer_work_location_id,
                "team_loveable_aspect_id" => $request->team_loveable_aspect_id,
            ]);

            $companyMeta->managementStyles()->sync($request->management_style_id);

            return  $companyMeta->load("company.companyMeta");
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return false;
        }
    }
}
