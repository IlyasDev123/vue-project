<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Services\TalentService;
use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;
use App\Http\Resources\PositionResourec;
use App\Http\Resources\TalentCvDataResource;
use App\Http\Requests\Talent\AddSkillRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Talent\UpdateSkillRequest;
use App\Http\Requests\User\UpdateProfileRequest;

class TalentController extends Controller
{
    protected $talentService;

    /**
     * __construct
     *
     * @param  mixed $talentService
     * @return void
     */
    public function __construct(TalentService $talentService)
    {
        $this->talentService = $talentService;
    }

    /**
     * @param CreateJobRequest $request
     *
     * @return [type]
     */
    public function addSkill(AddSkillRequest $request)
    {
        $response = $this->talentService->addSkill($request);
        return $response == false ?
            sendError('Something went wrong!', [], Response::HTTP_FORBIDDEN) :
            sendSuccess('Skill added successfully', $response, Response::HTTP_CREATED);
    }

    /**
     * @return [type]
     */
    public function getAllJobsList(Request $request)
    {
        $portfolioLists = $this->talentService->getAllJobsList($request);

        return sendSuccess('success', $portfolioLists, Response::HTTP_OK);
    }

    /**
     * @return [type]
     */
    public function appliedJobsList()
    {
        $portfolioLists = $this->talentService->appliedJobsList();

        return sendSuccess('success', $portfolioLists, Response::HTTP_OK);
    }

    /**
     * @param mixed $id
     *
     * @return [type]
     */
    public function appliedJobDetail($id)
    {
        $appliedJobDetail = $this->talentService->appliedJobDetail($id);
        $appliedJobDetail = PositionResourec::make($appliedJobDetail);

        return sendSuccess('success', $appliedJobDetail, Response::HTTP_OK);
    }

    public function getSkills()
    {
        $getSkill = $this->talentService->getSkills();
        $getSkill = SkillResource::collection($getSkill)->response()->getData(true);
        unset($getSkill['meta']);
        // $getSkill = new SkillResource($getSkill);
        return sendSuccess('success', $getSkill, Response::HTTP_OK);
    }

    public function getSkillById($id)
    {
        $getSkill = $this->talentService->getSkillById($id);
        return sendSuccess('success', $getSkill, Response::HTTP_OK);
    }

    public function updateTalentSkill(UpdateSkillRequest $request)
    {
        $response = $this->talentService->updateTalentSkill($request);
        return $response == false ?
            sendError('Something went wrong!', [], Response::HTTP_FORBIDDEN) :
            sendSuccess('Skill updated successfully', $response, Response::HTTP_CREATED);
    }

    public function updateProfileTalent(UpdateProfileRequest $request)
    {
        $response = $this->talentService->updateProfileTalent($request);
        return $response == false ?
            sendError('Something went wrong!', [], Response::HTTP_FORBIDDEN) :
            sendSuccess('Skill updated successfully', $response, Response::HTTP_CREATED);
    }

    public function getTalentById($id)
    {
        $talent = $this->talentService->getTalentById($id);
        $talent =  TalentCvDataResource::make($talent);
        return sendSuccess('success', $talent, Response::HTTP_OK);
    }
}