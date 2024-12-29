<?php

namespace App\Services;

use App\Models\User;
use App\Models\Refer;
use App\Models\Skill;
// use App\Models\Notification;
use App\Models\Position;
use App\Models\CompanyMeta;
use App\Utlities\Constants;
use Illuminate\Support\Str;
use App\Mail\SendCredentials;
use App\Traits\NotificationTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;


class UserService
{
    use NotificationTrait;
    /**
     * This is the main function where we call talent and company update profile function
     * @param mixed $request
     *
     * @return [type]
     */
    public function updateProfile($request)
    {
        try {
            $user =  auth()->user();
            $input = $request->except(['token']);
            $user->update($input);

            return  $user->type === Constants::USER_TYPE_TALENT
                ? $this->updateTalentProfile($user, $request)
                : $this->updateCompanyProfile($user, $request);
        } catch (\Throwable $th) {
            return $th->getMessage();
            return false;
        }
    }

    /**
     * @Description This function is use for update talent profile
     * @param mixed $user
     * @param mixed $input
     * @param mixed $request
     *
     * @return [type]
     */
    public function updateTalentProfile($user, $request)
    {
        $input = $request->except(['first_name', 'last_name', 'type']);
        if ($request->file('cv')) {
            $input['cv'] = storeFiles('Cvs', $request->cv);
        }
        $user->talentMeta()->update([
            'cv' =>  $input['cv'],
        ]);
        $skill =  Skill::find($request->id);
        $skill->update($input);

        return  $user = $user->load('skills');
    }

    /**
     * @Description This function is use to update the company profile
     * @param mixed $user
     * @param mixed $input
     *
     * @return [type]
     */
    public function updateCompanyProfile($request)
    {
        $company = CompanyMeta::where('company_id', auth()->id())->first();
        $company->update([
            'company_name' => $request->company_name,
            'current_role' => $request->current_role,
            'description' => $request->description ?? null,
            'prefer_work_location_id' => $request->prefer_work_location_id ?? null,
        ]);
        $company->managementStyles()->sync($request->management_style_id);
        $position =  Position::find($request->position_id);
        $input = $request->except(['company_name', 'current_role', 'managementStyleId']);
        $position->update($input);

        return  $position->load("company.companyMeta");
    }


    public function editProfile($request)
    {
        try {
            $user =  auth()->user();
            $input = $request->except(['token', 'avatar', 'password']);
            if ($request->has('password') && $request->filled('password')) {
                $input['password'] = Hash::make($request->password);
            }
            $user->update($input);

            return  $user;
        } catch (\Throwable $th) {
            return $th->getMessage();
            return false;
        }
    }

    /**
     * Get the current login user data
     * @return [type]
     */
    public function getProfile()
    {
        $user = auth()->user();
        return  $user->type === Constants::USER_TYPE_TALENT
            ? $user->load('talentMeta')
            : $user->load('companyMeta.managementStyles');
    }

    public function getTalentList($type, $relation, $request = null)
    {
        return User::when($request->has('status') && $request->status != 'all', function ($q) use ($request) {
            $q->where('is_blocked', $request->status);
        })->with('children', $relation)->when($request->search, function ($q) use ($request, $relation) {
            $q->SearchByNameAndEmail();
        })->where('type', $type)->where(['is_longer_interested' => true])->paginate(10);
    }

    public function getEmployerList($type, $relation, $request = null)
    {
        return User::with('children', $relation)->when($request->status, function ($q) use ($relation, $request) {
            $q->whereHas($relation, function ($q) use ($request) {
                $q->where('premium_status', $request->status);
            });
        })->when($request->search, function ($q) use ($request, $relation) {
            $q->SearchByNameAndEmail()
                ->orWhereHas($relation, function ($q) use ($request) {
                    $q->where('company_name', $request->search);
                });
        })->where('type', $type)->where(['is_longer_interested' => true])->paginate(10);
    }

    public function getAllRecruiter($type, $request = null)
    {
        return User::when($request->has('status') && $request->status != 'all', function ($q) use ($request,) {
            $q->where('is_blocked', $request->status);
        })->when($request->search, function ($q) use ($request,) {
            $q->SearchByNameAndEmail();
        })->with('children')
            ->withCount('refers')
            ->where('type', $type)->where(['is_longer_interested' => true])->paginate(10);
    }

    public function getUser($id)
    {
        return User::with('companyMeta')->findOrFail($id);
    }

    public function blockUser($id)
    {
        return User::findOrFail($id)->update([
            'is_blocked' => true,
        ]);
    }

    public function updateBlockStatus($request)
    {
        return User::find($request->id)->update([
            'is_blocked' => $request->status
        ]);
    }

    public function getReferedTalents($request)
    {
        $referTalentIds = Refer::where('company_id', $request->id)->groupBy('talent_id')->pluck('talent_id');
        $user['employer'] = User::with('companyMeta')->find($request->id);
        $user["user"] = User::when($request->searchItem, function ($q) use ($request) {
            $q->where(function($q) use($request){
                $q->whereRaw("concat(first_name, ' ', last_name) like '%" . $request->searchItem . "%' ")
                ->orWhereHas('skills.profession', function ($q) use ($request) {
                    $q->whereRaw("name like '%" . $request->searchItem . "%' ");
                });
            });
        })->whereIn('id', $referTalentIds)
            ->with('skills.profession')->get();

        return $user;
    }

    public function getReferedCompany($request)
    {
        $referedPositionIds = Refer::where('talent_id', $request->id)->groupBy('position_id')->pluck('position_id');
        $user['talent'] = User::with('skills.profession')->find($request->id);
        $user['position'] = Position::when($request->searchItem, function ($q) use ($request) {
            $q->where(function($q) use($request){
                $q->whereHas('company.companyMeta', function ($q) use ($request) {
                    $q->whereRaw("company_name  like '%" . $request->searchItem . "%' ");
                })->orWhereHas('profession', function ($q) use ($request) {
                    $q->whereRaw("name  like '%" . $request->searchItem . "%' ");
                });
            });
        })->whereIn('id', $referedPositionIds)->with('company.companyMeta', 'profession')->get();

        return $user;
    }

    public function recruiterTalentReffers($id)
    {
        $res = User::with(['refers' => function ($q) {
            $q->select('talent_id', 'refer_by')->groupBy('talent_id', 'refer_by');
        }, 'refers.talent'])
            ->findOrFail($id);
        return $res;
    }

    public function recruiterEmployerReffers($id)
    {
        $res = User::with(['refers' => function ($q) {
            $q->select('company_id', 'refer_by')->groupBy('company_id', 'refer_by');
        }, 'refers.company.companyMeta'])
            ->withCount('refers')
            ->findOrFail($id);
        return $res;
    }

    public function createUser($request)
    {
        DB::beginTransaction();
        try {

            $input = $request->except(['token']);

            $password = Str::random(10);
            $input['password'] = bcrypt($password);

            if ($request->avatar != '' && $request->avatar != null && $request->hasFile('avatar')) {
                $thumb = $request->file('avatar');
                $thumbname = pathinfo($thumb, PATHINFO_FILENAME);
                $thumb_name = $thumbname . rand(1000, 9999) . '.' . $thumb->getClientOriginalExtension();
                $uploaded_path = public_path() . '/images/img';
                $thumb->move($uploaded_path, $thumb_name);
                $input['avatar'] = $thumb_name;
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
            $user = User::create($input);
            if ($input['type'] == Constants::USER_TYPE_TALENT) {
                $user->talentMeta()->create($input);
                $user->skills()->create($input);
            } elseif ($input['type'] == Constants::USER_TYPE_COMPANY) {
                $companyMeta = $user->companyMeta()->create($input);
                $position = $user->positions()->create($input);
                $companyMeta->managementStyles()->attach($request->management_style_id);
            }

            DB::commit();

            $credentials = [
                "email" => $request->email,
                "password" => $password,
                "url" => env("APP_URL")."login"
            ];

            Mail::to($request->email)->send(new SendCredentials($credentials));

            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }

    
    public function updateUser($request)
    {
        try {
            $user =  User::find($request->id);
            $input = $request->except(['token']);
            // dd($input);

            $user->update($input);

            if($request->type == Constants::USER_TYPE_COMPANY) {

                $meta = $user->companyMeta();
                $meta->update([
                    'company_name' => $input['company_name']
                ]);
            }

            return  $user;
        } catch (\Throwable $th) {
            return false;
        }
    }

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

    public function updateStatusProfiles($request)
    {
        try {
            $user = auth()->user();
            $user->update([
                'is_longer_interested' => $request->status,
            ]);
            $user->refresh();
            return $user;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::find($id)->delete();

            return $user;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function uploadProfileImage($request)
    {
        try {
            $user = User::where('id', Auth::id())->first();
            if ($request->avatar != '' && $request->avatar != null && $request->hasFile('avatar')) {
                $thumb = $request->file('avatar');
                $thumbname = pathinfo($thumb, PATHINFO_FILENAME);
                $thumb_name = $thumbname . rand(1000, 9999) . '.' . $thumb->getClientOriginalExtension();
                $uploaded_path = public_path() . '/images/img';
                $thumb->move($uploaded_path, $thumb_name);

                if (file_exists($user->getAttributes()['avatar'])) {
                    unlink($user->getAttributes()['avatar']);
                }
                // $user->avatar = 'public/images/img/' . $thumb_name;
                $user->avatar =  $thumb_name;
            }
            $user->save();

            return $user;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function search($request)
    {
        if ($request->filled('search')) {
            $students = User::search(("CONCAT(first_name, ' ' ,last_name)"), 'like', "%" . $request->name . "%")->get(); // search by value
        } else {
            $students = User::get();
        }

        return $students;
    }
}
