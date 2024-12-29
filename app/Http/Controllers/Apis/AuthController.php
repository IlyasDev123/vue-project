<?php

namespace App\Http\Controllers\Apis;


use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckEmailRequest;
use App\Http\Requests\User\EmailCheck;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\SocialLoginRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\User\CreateAccountRequest;


class AuthController extends Controller
{

    protected $authService;

    /**
     * __construct
     *
     * @param  mixed $authService
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param CreateAccountRequest $request
     *
     * @return [type]
     */
    public function createAccount(CreateAccountRequest $request)
    {
        $response = $this->authService->createUser($request);
        if ($response == false) {
            return sendError("Something went wrong !", null, Response::HTTP_BAD_REQUEST);
        }
        $tokenResult = $response->createToken('Personal Access Token');
        $response['token'] = $tokenResult->accessToken;
        return sendSuccess("Account created successfully", $response, Response::HTTP_CREATED);
    }

    public function checkEmailExist(CheckEmailRequest $request)
    {
        return $this->authService->checkEmailExist($request);
    }
    /**
     * @param LoginRequest $request
     *
     * @return [type]
     */
    public function login(LoginRequest $request)
    {
        return $this->authService->login($request);
    }

    /**
     * @param LoginRequest $request
     *
     * @return [type]
     */
    public function socialLogin(SocialLoginRequest $request)
    {
        return $this->authService->socialLogin($request);
    }

    /**
     * @param LoginRequest $request
     *
     * @return [type]
     */
    public function forgetPassword(EmailCheck $request)
    {
        return $this->authService->sendLink($request);
    }

    /**
     * @param LoginRequest $request
     *
     * @return [type]
     */
    public function resend(EmailCheck $request)
    {
        return $this->authService->sendLink($request);
    }

    /**
     * @param LoginRequest $request
     *
     * @return [type]
     */
    public function passwordReset(EmailCheck $request)
    {
        return $this->authService->passwordReset($request);
    }

    /**
     * @return [type]
     */
    public function logout()
    {
        return $this->authService->logout();
    }

    /**
     * @return [type]
     */
    public function getRecruiters()
    {
        $response = $this->authService->getRecruiters();
        return sendSuccess("success", $response, Response::HTTP_OK);
    }

    /**
     * @return [type]
     */
    public function storeCvInTempFile(Request $request)
    {
        if ($request->previous_url) {
            $filename = basename($request->previous_url);
            Storage::disk('public')->delete('temp/' . $filename);
        }

        $url = saveFile($request->file, 'temp');
        if ($url) {
            return sendSuccess("success", asset('storage/temp/' . $url), Response::HTTP_OK);
        }
        return sendError("error", $url, Response::HTTP_OK);
    }
}
