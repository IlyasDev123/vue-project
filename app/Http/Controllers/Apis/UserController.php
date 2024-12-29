<?php

namespace App\Http\Controllers\Apis;

use App\Models\UserReview;
use App\Utlities\Constants;
use Illuminate\Http\Request;
// use App\Traits\Notification;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
// use App\Http\Requests\User\CreateAccountRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\User\AddNewEmployer;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\EditProfileRequest;
use App\Http\Requests\User\UploadProfileImage;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Resources\ReferTalentToCompanyResource;
use App\Mail\DeactivateAccount;

class UserController extends Controller
{
    protected $userService;

    /**
     * __construct
     *
     * @param  mixed $authService
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return [type]
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $response = $this->userService->updateProfile($request);
        if ($response == false) {
            return sendError("Something went wrong !", [], Response::HTTP_BAD_REQUEST);
        }

        return sendSuccess("Profile updated successfully", $response, Response::HTTP_OK);
    }

    public function editProfile(EditProfileRequest $request)
    {
        $response = $this->userService->editProfile($request);
        if ($response == false) {
            return sendError("Something went wrong !", [], Response::HTTP_BAD_REQUEST);
        }

        return sendSuccess("Profile updated successfully", $response, Response::HTTP_OK);
    }



    /**
     * @return [type]
     */
    public function getProfile()
    {
        $response = $this->userService->getProfile();
        return sendSuccess("success", $response, Response::HTTP_OK);
    }

    public function getUser($id)
    {
        $response = $this->userService->getUser($id);
        return sendSuccess("success", $response, Response::HTTP_OK);
    }

    public function blockUser($id)
    {
        $response = $this->userService->blockUser($id);
        return sendSuccess("success", $response, Response::HTTP_OK);
    }

    public function updateBlockStatus(Request $request){

        $this->validate($request, [
            'id' => 'required',
            'status' => 'required',
        ]);

        $response = $this->userService->updateBlockStatus($request);
        return sendSuccess("Status updated.", $response, Response::HTTP_OK);
    }

    /**
     * @return [type]
     */
    public function deactivateAccount()
    {

        DB::beginTransaction();
        try {
            
            $user = auth()->user();

            $review = UserReview::where('user_id', $user->id)->first();

            
            $user->token()->revoke();
            $response =  $user->delete();

            $userType = "";
            if($user->type == Constants::USER_TYPE_COMPANY)
                $userType = "Employer";
            elseif($user->type == Constants::USER_TYPE_TALENT)
                $userType = "Talent";
            elseif($user->type == Constants::RECRUITER)
                $userType = "Recruiter";
    
            DB::commit();
            
            Mail::to(env('ADMIN_EMAIL'))->send(new DeactivateAccount([
                "name" => $user->first_name . ' ' .$user->last_name,
                "email" => $user->email,
                "phone" => $user->phone_no,
                "type"  => $userType,
                "rating" => $review->rating ?? '',
                "feedback" => $review->review ?? '',
            ]));

            return sendSuccess("Account deleted successfully!", $response, Response::HTTP_OK);
            
        } catch (\Throwable $th) {

            DB::rollBack();
            return sendError("Something went wrong !", [], Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateCompanyProfile(UpdateProfileRequest $request)
    {
        $response = $this->userService->updateCompanyProfile($request);
        if ($response == false) {
            return sendError("Something went wrong !", [], Response::HTTP_BAD_REQUEST);
        }

        return sendSuccess("Profile updated successfully", $response, Response::HTTP_OK);
    }

    public function getAllEmployees(Request $request)
    {
        $type = Constants::USER_TYPE_COMPANY;
        $relation = "companyMeta";
        $response = $this->userService->getEmployerList($type, $relation, $request);
        return sendSuccess("Employees get successfully!", $response, Response::HTTP_OK);
    }

    public function getAllTalent(Request $request)
    {
        $type = Constants::USER_TYPE_TALENT;
        $relation = "talentMeta";
        $response = $this->userService->getTalentList($type, $relation, $request);
        return sendSuccess("Talents get successfully!", $response, Response::HTTP_OK);
    }

    public function getAllRecruiter(Request $request)
    {
        $type = Constants::RECRUITER;
        $response = $this->userService->getAllRecruiter($type, $request);
        return sendSuccess("Recruiter get successfully!", $response, Response::HTTP_OK);
    }

    public function getReferedTalents(Request $request)
    {
        $response = $this->userService->getReferedTalents($request);

        return sendSuccess("Refered talents by employer get successfully!", $response, Response::HTTP_OK);
    }

    public function recruiterTalentReffers($id)
    {
        $result = $this->userService->recruiterTalentReffers($id);

        $response = [
            'count' => 0,
            'talent' => $result
        ];

        if ($result) {
            $response['count'] = $result->refers->count();
        }
        return sendSuccess("Reffered", $response, Response::HTTP_OK);
    }

    public function recruiterEmployerReffers($id)
    {
        $result = $this->userService->recruiterEmployerReffers($id);

        $response = [
            'count' => 0,
            'employer' => $result
        ];
        if ($result) {
            $response['count'] = $result->refers->count();
        }
        return sendSuccess("Reffered", $response, Response::HTTP_OK);
    }

    // public function searchReferedTalents(Request $request)
    // {
    //     $response = $this->userService->searchReferedTalents($request);
    //     if ($response == false) {
    //         return sendError("Something went wrong !", [], Response::HTTP_BAD_REQUEST);
    //     }

    //     return sendSuccess("Talent found successfully", $response, Response::HTTP_OK);
    // }

    public function  getReferedCompany(Request $request)
    {
        $response = $this->userService->getReferedCompany($request);
        // $response = ReferTalentToCompanyResource::collection($response);

        return sendSuccess("Refer to company get successfully!", $response, Response::HTTP_OK);
    }

    public function searchReferedCompany(Request $request)
    {
        $response = $this->userService->searchReferedCompany($request);
        if ($response == false) {
            return sendError("Something went wrong !", [], Response::HTTP_BAD_REQUEST);
        }

        return sendSuccess("Company found successfully", $response, Response::HTTP_OK);
    }

    public function createUser(AddNewEmployer $request)
    {
        $response = $this->userService->createUser($request);

        if ($response == false) {
            return sendError("Something went wrong !", [], Response::HTTP_BAD_REQUEST);
        }
        return sendSuccess("Employer Added successfully", $response, Response::HTTP_OK);
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $response = $this->userService->updateUser($request);

        if ($response == false) {
            return sendError("Something went wrong !", [], Response::HTTP_BAD_REQUEST);
        }
        return sendSuccess("User updated successfully", $response, Response::HTTP_OK);
    }

    

    public function updateStatusProfiles(Request $request)
    {
        $response = $this->userService->updateStatusProfiles($request);
        if ($response == false) {
            return sendError("Something went wrong !", [], Response::HTTP_BAD_REQUEST);
        }
        return sendSuccess("Profile updated successfully", $response, Response::HTTP_OK);
    }

    public function uploadProfileImage(UploadProfileImage $request)
    {
        $response = $this->userService->uploadProfileImage($request);
        if ($response == false) {
            return sendError("Something went wrong !", [], Response::HTTP_BAD_REQUEST);
        }
        return sendSuccess("Profile updated successfully", $response, Response::HTTP_OK);
    }

    public function deleteUser($id)
    {
        $response = $this->userService->deleteUser($id);

        return $response === false ?
            sendError('Something went wrong!', [], Response::HTTP_BAD_REQUEST) :
            sendSuccess('User Deleted successfully', $response, Response::HTTP_OK);
    }

    public function search(Request $request)
    {
        $response = $this->userService->search($request);
        return sendSuccess("success", $response, Response::HTTP_OK);
    }
}
