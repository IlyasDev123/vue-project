<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\TagController;
use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\Apis\PostController;
use App\Http\Controllers\Apis\UserController;
use App\Http\Controllers\ChirrrpMetaController;
use App\Http\Controllers\Apis\ManageRequestAndStatus;
use App\Http\Controllers\Apis\NotificationController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ChirrrpMetaController::class)->group(function () {
    Route::get('/chirrrp-meta', 'chirrrpMeta');
    Route::get('/profession/{industry_id}', 'getProfession');
    Route::post('/add-salary', 'addSalary');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/create-account', 'createAccount');
    Route::post('/login', 'login');
    Route::post('/upload-cv', 'storeCvInTempFile');
    Route::post('/check-email', 'checkEmailExist');
    Route::post('/social-login', 'socialLogin');
    Route::post('/forget-password', 'forgetPassword');
    Route::post('/resend-password', 'resend');
    Route::post('/recover-password', 'recoverPassword');
    Route::get('/recruiters', 'getRecruiters');
});

Route::group(['middleware' => ['auth:api', 'IsBlocked', 'throttle:600,1']], function () {

    Route::prefix('user')->controller(AuthController::class)->group(function () {
        Route::get('/logout', 'logout');
        Route::post('/change-password', 'changePassword');
        Route::post('/update-profile', 'updateProfile');
    });

    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::post('/update-profile', 'updateProfile');
        Route::post('/edit-profile', 'editProfile');
        Route::get('/get-profile', 'getProfile');
        Route::get('/deactivate-account', 'deactivateAccount');
        Route::post('/update-position', 'updateCompanyProfile');
        Route::post('/get-refered-talents', 'getReferedTalents');
        Route::post('/search-refered-talents', 'searchReferedTalents');
        Route::post('/search-refered-company', 'searchReferedCompany');
        Route::post('/create', 'createUser');
        Route::post('/update', 'updateUser');
        Route::get('/get-user/{id}', 'getUser');
        Route::get('/block-user/{id}', 'blockUser');
        Route::post('/get-refered-company', 'getReferedCompany');
        Route::get('/get-recruiter-talent-reffers/{id}', 'recruiterTalentReffers');
        Route::get('/get-recruiter-employer-reffers/{id}', 'recruiterEmployerReffers');
        Route::post('/upload-profile-image', 'uploadProfileImage');
        Route::post('/update-status', 'updateStatusProfiles');
        Route::delete('/delete-user/{id}', 'deleteUser');
        Route::get('/search', 'search');
        Route::post('update-user-block-status', 'updateBlockStatus');
    });

    Route::prefix('notifications')->controller(NotificationController::class)->group(function () {
        Route::post('/mark-as-read', 'markAsRead');
        Route::get('/mark-all-as-read', 'markAllAsRead');
        Route::get('/get-notification', 'getNotification');
    });

    Route::prefix('recruiters')->controller(UserController::class)->group(function () {
        Route::post('/get-all-employees', 'getAllEmployees');
        Route::post('/get-all-talent', 'getAllTalent');
        Route::get('/get-all-recruiter', 'getAllRecruiter');
        Route::post('/get-all-recruiter', 'getAllRecruiter');
    });

    Route::prefix('companies')->controller(App\Http\Controllers\Apis\CompanyController::class)->group(function () {
        Route::post('/create-job', 'createJob');
        Route::post('/talent', 'getAllTalent');
        Route::post('/my-talent-list', 'myTalentList');
        Route::get('/my-talent/{id}', 'showMyTalent');
        Route::get('/send-premium-request', 'sendFullAccessRequest');
        Route::post('/send-interview-request', 'sendInterviewRequest');
        Route::get('/get-positions', 'getPositions');
        Route::post('/update-position', 'updatePosition');
        Route::get('/get-position/{id}', 'getPositionDetail');
        Route::get('/get-job-detail/{id}', 'getJobDetailByid');
        Route::post('/update-profile-meta', 'updateCompanyMeta');
    });

    Route::prefix('talents')->controller(App\Http\Controllers\Apis\TalentController::class)->group(function () {
        Route::post('/add-skill', 'addSkill');
        Route::post('/job-list', 'getAllJobsList');
        Route::get('/apply-job-list', 'appliedJobsList');
        Route::get('/applied-job-detail/{id}', 'appliedJobDetail');
        Route::get('/get-skill', 'getSkills');
        Route::get('/get-skill/{id}', 'getSkillById');
        Route::post('/update-skill', 'updateTalentSkill');
        Route::post('/update-profile', 'updateProfileTalent');

        Route::get('/talent/{id}', 'getTalentById');
    });

    Route::prefix('portfolios')->controller(App\Http\Controllers\Apis\PortfolioMatchController::class)->group(function () {
        Route::post('/match', 'storePortfolioMatch');
        Route::post('/reject', 'rejectPortfolioMatch');
        Route::delete('/delete-match-request/{id}', 'deleteSendRequestMatch');
    });

    Route::prefix('posts')->controller(PostController::class)->group(function () {
        Route::get('all', 'all');
        Route::get('/public', 'getAllPosts');
        Route::post('/like-post', 'likeAndUnlikePost');
        Route::post('create', 'create');
        Route::post('update/{id}', 'update');
        Route::post('delete/{id}', 'delete');
        Route::post('privacy-change', 'privacyChange');
    });

    Route::prefix('reviews')->controller(App\Http\Controllers\Apis\UserReviewController::class)->group(function () {
        Route::post('/create', 'addReview');
    });

    Route::prefix('refer')->controller(App\Http\Controllers\Apis\ReferController::class)->group(function () {
        Route::post('/employers-list', 'getEmployerList');
        Route::post('/talents-list', 'getTalentsList');
        Route::post('/talents', 'referCompanyToTalents');
    });

    Route::prefix('tag')->controller(TagController::class)->group(function () {
        Route::post('add', 'add');
        Route::get('list', 'getList');
        Route::get('search', 'search');
    });

    Route::prefix('manage-requests')->controller(ManageRequestAndStatus::class)->group(function () {
        Route::post('/premium-request', 'getFullAccessRequest');
        Route::get('/interview-request', 'getInterviewRequests');
        Route::post('/status-update', 'updateFullAccessRequest');
        Route::post('/schedule-interview', 'scheduleInterviewRequest');
    });
});
