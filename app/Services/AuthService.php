<?php

namespace App\Services;

use App\Models\User;
use App\Utlities\Constants;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{

    /**
     * @param mixed $request
     *
     * @return [type]
     */
    public function createUser($request)
    {
        DB::beginTransaction();
        try {
            $input = $request->except(['token']);
            $input['is_agree_with_terms_condition'] = $request->is_agree_with_terms_condition == true ? true : false;
            if (isset($input['social_login_id']) && $input['social_login_id']) {
                $input['password'] = '1234ChirrrpData';
                $input['email_verified_at'] = now();
            } else {
                $input['password'] = Hash::make($input['password']);
            }
            if ($request->has('cv')) {
                $cv = basename($request->cv);
                Storage::disk('public')->move('temp/' . $cv, 'cv/' . $cv);
                $input['cv'] = $cv;
            }
            if (!$request->recruiter_id) {
                $input['recruiter_id'] = $this->assignDirectRecruiter($request);
                $input['is_directly_assign'] = true;
            }
            $user =  User::create($input);
            if ($input['type'] == Constants::USER_TYPE_TALENT) {
                $user->talentMeta()->create($input);
                $user->skills()->create($input);
            } else {
                $companyMeta = $user->companyMeta()->create($input);
                $companyMeta->managementStyles()->attach($request->management_style_id);
                $user->positions()->create($input);
            }
            DB::commit();

            return $user;
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function checkEmailExist($request)
    {
        $emailExist =  User::where('email', $request->email)->first();
        if ($emailExist) {
            return sendError('email already exists.', null);
        }

        return sendSuccess("success", $emailExist, Response::HTTP_OK);
    }

    /**
     * @param mixed $request
     *
     * @return [type]
     */
    public function assignDirectRecruiter($request)
    {
        $recIds = User::where('type', Constants::RECRUITER)->pluck('id');

        $recruiterId = User::where('is_directly_assign', true)->where('type', $request->type)->orderByDesc('id')->limit(count($recIds))->pluck('recruiter_id');
        if ($recruiterId->isNotEmpty()) {
            $checkValue = $recIds->diff($recruiterId);
            if (!$checkValue) {
                shuffle($recIds);
                return $recIds[0];
            }
            foreach ($checkValue as $key => $value) {
                return $value;
                break;
            }
        }

        return $recIds[0];
    }

    /**
     * @param mixed $request
     *
     * @return [type]
     */
    public function socialLogin($request)
    {
        try {
            $user = User::where('social_login_id', $request->social_login_id)->first();
            if (!$user) {
                return sendError('User does not exist', null);
            }
            $tokenResult = $user->createToken('Personal Access Token');
            $user['access_token'] = $tokenResult->accessToken;
            $user['token_type'] = 'Bearer';

            return sendSuccess('Logged-in successful', $user);
        } catch (\Throwable $th) {

            return sendError('Some thing went wrong', null);
        }
    }

    /**
     * @return [type]
     */
    public function login($request)
    {
        if (auth()->attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = auth()->user();
            if ($user->is_blocked == Constants::BLOCKED_USER) {
                auth()->logout();
                return sendError('Your account has been blocked. Please contact with customer support.', null);
            }
            $tokenResult = $user->createToken('Personal Access Token');
            $user['token'] = $tokenResult->accessToken;

            return sendSuccess("You are successfully logged in", $user, Response::HTTP_OK);
        }
        return sendError('Email or password is incorrect', [], Response::HTTP_FORBIDDEN);
    }

    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function sendLink($request)
    {
        try {

            $status = Password::sendResetLink(
                $request->only('email')
            );
    
            $status == Password::RESET_LINK_SENT;

            return $status === Password::RESET_LINK_SENT
                ? sendSuccess("Please check your email. Reset password link has been sent.")
                : sendError("Reset link not sent, please try again.");
        }
        catch(\Exception $e){
            return sendError("Something went wrong, please try again.");
        }
    }

    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function passwordReset(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        if (count($credentials->errors())) {
            return Redirect::back()->withErrors($credentials);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/')
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * @return [type]
     */
    public function logout()
    {
        $user = auth()->user();
        if ($user->token()->revoke()) {
            return sendSuccess('Logged-out successfully', null, Response::HTTP_OK);
        }

        return sendError('Failed to logout', Response::HTTP_FORBIDDEN);
    }

    /**
     * @return [type]
     */
    public function getRecruiters()
    {
        return User::select('id', 'first_name', 'last_name', 'avatar')->where('type', Constants::RECRUITER)->get();
    }
}
