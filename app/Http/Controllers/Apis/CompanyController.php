<?php

namespace App\Http\Controllers\Apis;


use App\Models\Position;
use Illuminate\Http\Request;
use App\Services\CompanyService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\UpdateJobStatus;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Company\CreateJobRequest;
use App\Http\Requests\Company\SendInterviewRequest;
use App\Http\Requests\Company\UpdatePositionRequest;
use App\Http\Requests\Company\UpdateCompanyMetaRequest;

class CompanyController extends Controller
{
    protected $companyService;

    /**
     * __construct
     *
     * @param  mixed $companyService
     * @return void
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * @param CreateJobRequest $request
     *
     * @return [type]
     */
    public function createJob(CreateJobRequest $request)
    {
        $response = $this->companyService->createJob($request);
        return $response == false ?
            sendError('Something went wrong!', [], Response::HTTP_FORBIDDEN) :
            sendSuccess('Job created successfully', $response, Response::HTTP_CREATED);
    }

    /**
     * @param mixed $id
     *
     * @return [type]
     */
    public function updateJobStatus(UpdateJobStatus $request)
    {
        $response = $this->companyService->updateJobStatus($request);
        return $response == false ?
            sendError('Something went wrong!', [], Response::HTTP_FORBIDDEN) :
            sendSuccess('Job created successfully', $response, Response::HTTP_CREATED);
    }

    /**
     * @return [type]
     */
    public function getAllTalent(Request $request)
    {
        $talents = $this->companyService->getAllTalent($request);
        return sendSuccess('Success', $talents, Response::HTTP_OK);
    }

    /**
     * @return [type]
     */
    public function myTalentList(Request $request)
    {
        $talents = $this->companyService->myTalentList($request);
        return sendSuccess('Success', $talents, Response::HTTP_OK);
    }

    /**
     * @return [type]
     */
    public function showMyTalent($id)
    {
        $talents = $this->companyService->showMyTalent($id);
        return sendSuccess('Success', $talents, Response::HTTP_OK);
    }

    /**
     * @return [type]
     */
    public function sendFullAccessRequest()
    {
        $response = $this->companyService->sendFullAccessRequest();
        return $response == false ?
            sendError('Something went wrong!', [], Response::HTTP_FORBIDDEN) :
            sendSuccess('Sent Request successfully', $response, Response::HTTP_CREATED);
    }

    /**
     * @return [type]
     */
    public function sendInterviewRequest(SendInterviewRequest $request)
    {
        $response = $this->companyService->sendInterviewRequest($request);
        return $response == false ?
            sendError('Something went wrong!', [], Response::HTTP_FORBIDDEN) :
            sendSuccess('Sent Request successfully', $response, Response::HTTP_OK);
    }

    public function getPositionDetail($id)
    {
        $position = $this->companyService->getPositionDetail($id);
        return sendSuccess('Success', $position, Response::HTTP_OK);
    }

    public function getPositions()
    {
        $positions = $this->companyService->getPositions();
        return sendSuccess('Success', $positions, Response::HTTP_OK);
    }

    public function updatePosition(UpdatePositionRequest $request)
    {
        $response = $this->companyService->updatePosition($request);
        return $response == false ?
            sendError('Something went wrong!', [], Response::HTTP_FORBIDDEN) :
            sendSuccess('Job updated successfully', $response, Response::HTTP_CREATED);
    }

    public function updateCompanyMeta(UpdateCompanyMetaRequest $request)
    {
        $response = $this->companyService->updateCompanyMeta($request);
        return $response == false ?
            sendError('Something went wrong!', [], Response::HTTP_FORBIDDEN) :
            sendSuccess('updated successfully', $response, Response::HTTP_CREATED);
    }
}
