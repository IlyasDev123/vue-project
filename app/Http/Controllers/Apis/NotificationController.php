<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationService;

    /**
     * __construct
     *
     * @param  mixed $notificationService
     * @return void
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }


    public function getNotification()
    {
        $response = $this->notificationService->getNotification();
        return sendSuccess("success", $response, Response::HTTP_OK);
    }

    public function markAllAsRead()
    {
        $response = $this->notificationService->markAllAsRead();
        return sendSuccess("success", $response, Response::HTTP_OK);
    }

    public function markAsRead(Request $request)
    {
        $response = $this->notificationService->markAsRead($request);
        return sendSuccess("success", $response, Response::HTTP_OK);
    }
}
