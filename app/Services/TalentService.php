<?php

namespace App\Services;

use App\Models\User;
use App\Models\Skill;
use App\Models\Position;
use App\Utlities\Constants;
use App\Models\CompanyUserMatch;

class TalentService
{

    /**
     * @param mixed $request
     *
     * @return [type]
     */
    public function addSkill($request)
    {
        try {
            $input = $request->except(['token']);
            return  auth()->user()->skills()->updateOrCreate(
                [
                    'profession_id' => $input['profession_id']
                ],
                $input
            );
        } catch (\Throwable $th) {
            return false;
        }
    }
    /**
     * @return [type]
     */
    public function getAllJobsList($request)
    {
        return Position::with('salary', 'company.companyMeta', 'matchPortfolio', 'profession', 'experience')->has('matchPortfolio')
            ->where(function ($q) use ($request) {
                $q->whereHas("company.companyMeta", function ($q) use ($request) {
                    $q->where(function ($q) use ($request) {
                        $q->whereRaw("company_name like '%" . $request->searchItem . "%' ")
                            ->orwhereRaw("email like '%" . $request->searchItem . "%' ");
                    });
                })->orWhereHas("profession", function ($q) use ($request) {
                    $q->whereRaw("name like '%" . $request->searchItem . "%' ");
                });
            })->get();
    }

    /**
     * @return [type]
     */
    public function appliedJobsList()
    {
        return CompanyUserMatch::where('status', Constants::BOTH_ACCEPTED_REQUEST)->with('position.company.companyMeta')->checkAppliedJobs()->simplePaginate();
    }

    /**
     * @return [type]
     */
    public function appliedJobDetail($id)
    {
        return Position::with('company.companyMeta.preferWorklocation', 'profession', 'salary', 'experience', 'company.companyMeta.managementStyles',)->find($id);
    }

    /**
     * Get the current login user skill
     * @return [type]
     */
    public function getSkills()
    {
        return Skill::where('talent_id', auth()->id())->with('profession:id,name')->simplePaginate();
    }

    public function getSkillById($id)
    {
        return Skill::find($id);
    }

    public function updateTalentSkill($request)
    {
        try {
            $skill =  Skill::find($request->id);
            $skill = $skill->update([
                'experience_id' => $request->experience_id,
                'profession_id' => $request->profession_id,
                'coworker_review_id' => $request->coworker_review_id,
                'state_id' => $request->state_id,
                'salary_id' => $request->salary_id,
            ]);

            return  $skill;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateProfileTalent($request)
    {
        try {
            auth()->user()->talentMeta()->update([
                "current_role" => $request->current_role,
                'coworker_review_id' => $request->coworker_review_id,
                'state_id' => $request->state_id,
                'employer_selection_preference_id' => $request->employer_selection_preference_id,
                'prefer_work_location_id' => $request->prefer_work_location_id,
                'hobby_id' => $request->hobby_id
            ]);

            return  true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getTalentById($id)
    {
        return User::with('talentMeta', 'talentSkils')->find($id);
    }
}
