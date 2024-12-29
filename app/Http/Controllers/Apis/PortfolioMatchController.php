<?php

namespace App\Http\Controllers\Apis;

use App\Utlities\Constants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PortfolioMatchService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreMatchPortfolioRequest;

class PortfolioMatchController extends Controller
{
    protected $portfolioMatchService;

    /**
     * __construct
     *
     * @param  mixed $portfolioMatchService
     * @return void
     */
    public function __construct(PortfolioMatchService $portfolioMatchService)
    {
        $this->portfolioMatchService = $portfolioMatchService;
    }


    /**
     * @param StoreMatchPortfolioRequest $request
     *
     * @return [type]
     */
    public function storePortfolioMatch(StoreMatchPortfolioRequest $request)
    {

        $matchPortfolios = $this->portfolioMatchService->portfolioMatchStatus($request);

        return $matchPortfolios === false ?
            sendError('Something went wrong!', [], Response::HTTP_FORBIDDEN) :
            sendSuccess('Request has been sent successfully', $matchPortfolios, Response::HTTP_OK);
    }

    /**
     * @param StoreMatchPortfolioRequest $request
     *
     * @return [type]
     */
    public function rejectPortfolioMatch(StoreMatchPortfolioRequest $request)
    {
        $matchPortfolios = $this->portfolioMatchService->rejectProfile($request);

        return $matchPortfolios === false ?
            sendError('Something went wrong!', [], Response::HTTP_FORBIDDEN) :
            sendSuccess('Success', $matchPortfolios, Response::HTTP_OK);
    }

    /**
     * @param mixed $id
     *
     * @return [type]
     */
    public function deleteSendRequestMatch($id)
    {
        $response = $this->portfolioMatchService->deleteSendRequestMatch($id);

        return $response === false ?
            sendError('Something went wrong!', [], Response::HTTP_BAD_REQUEST) :
            sendSuccess('Deleted successfully', $response, Response::HTTP_OK);
    }
}
