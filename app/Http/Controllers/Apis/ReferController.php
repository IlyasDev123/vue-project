<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Services\ReferService;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployerCvDataResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\UserReferTOListResource;
use App\Http\Requests\Company\RefereCompanyToTalentRequest;

class ReferController extends Controller
{
    protected $referService;

    /**
     * __construct
     *
     * @param  mixed $authService
     * @return void
     */
    public function __construct(ReferService $referService)
    {
        $this->referService = $referService;
    }

    /**
     * @return [type]
     */
    public function referCompanyToTalents(RefereCompanyToTalentRequest $request)
    {
        $employers = $this->referService->referCompanyToTalents($request);
        if ($employers == false) {
            return sendError("Something went wrong !", null, Response::HTTP_BAD_REQUEST);
        }
        return sendSuccess('Success', $employers, Response::HTTP_OK);
    }
    /**
     * @return [type]
     */
    public function getTalentsList(Request $request)
    {
        $talents = $this->referService->getTalentsList($request);
        $talents = UserReferTOListResource::collection($talents)->response()->getData(true);
        unset($talents['meta']);
        return sendSuccess('Success', $talents, Response::HTTP_OK);
    }

    /**
     * @return [type]
     */
    public function getEmployerList(Request $request)
    {
        $employers = $this->referService->getEmployerList($request);
        $employers = EmployerCvDataResource::collection($employers)->response()->getData(true);
        unset($employers['meta']);
        return sendSuccess('Success', $employers, Response::HTTP_OK);
    }
}
