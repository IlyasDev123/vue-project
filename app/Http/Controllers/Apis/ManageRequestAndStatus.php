<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ManageRequestService;
use App\Http\Resources\GetFullAccessResource;
use App\Http\Requests\UpdateFullAccessRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\GetInterviewRequestsResource;
use App\Http\Requests\Manage\ScheduleInterviewRequest;


class ManageRequestAndStatus extends Controller
{
    protected $manageRequestService;

    /**
     * __construct
     *
     * @param  mixed $manageRequestService
     * @return void
     */
    public function __construct(ManageRequestService $manageRequestService)
    {
        $this->manageRequestService = $manageRequestService;
    }

    /**
     * @return [type]
     */
    public function getFullAccessRequest(Request $request)
    {
        $response = $this->manageRequestService->getFullAccessRequest($request);
        $response =  GetFullAccessResource::collection($response);

        return sendSuccess("success", $response, Response::HTTP_OK);
    }

    public function getInterviewRequests()
    {
        $response = $this->manageRequestService->getInterviewRequests();
        $response =  GetInterviewRequestsResource::collection($response);

        return sendSuccess("success", $response, Response::HTTP_OK);
    }

    public function updateFullAccessRequest(UpdateFullAccessRequest $request)
    {
        $response = $this->manageRequestService->updateFullAccessRequest($request);
        if ($response == false) {
            return sendError("Something went wrong !", null, Response::HTTP_BAD_REQUEST);
        }

        return sendSuccess("Status update successfully!", $response, Response::HTTP_CREATED);
    }

    public function scheduleInterviewRequest(ScheduleInterviewRequest $request)
    {

        $response = $this->manageRequestService->scheduleInterviewRequest($request);
        if ($response == false) {
            return sendError("Something went wrong !", null, Response::HTTP_BAD_REQUEST);
        }

        return sendSuccess("Request sent successfully!", $response, Response::HTTP_CREATED);
    }
}
