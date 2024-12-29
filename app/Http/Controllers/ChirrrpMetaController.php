<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\State;
use App\Models\Salary;
use App\Models\Industry;
use App\Models\Experience;
use App\Models\Profession;
use Illuminate\Http\Request;
use App\Models\CoworkerReview;
use App\Models\TeamLovableAspect;
use App\Models\PreferWorkLocation;
use App\Models\EmployerSelectionPreference;
use App\Models\ManagementStyle;

class ChirrrpMetaController extends Controller
{
    /**
     * This function data is use when singup
     * @return [type]
     */
    public function chirrrpMeta()
    {
        $data['industries'] = Industry::select('id', 'name')->get();
        $data['professions'] = Profession::select('id', 'name')->get();

        $data['coworkerReviews'] = CoworkerReview::select('id', 'name')->get();
        $data['salaries'] = Salary::select('id', 'start_range')->get();
        $data['experiences'] = Experience::select('id', 'start_range')->get();
        $data['teamLovableAspects'] = TeamLovableAspect::select('id', 'name')->get();
        $data['ManagementStyles'] = ManagementStyle::select('id', 'name')->get();
        $data['hobbies'] = Hobby::select('id', 'name')->get();
        $data['preferWorkLocations'] = PreferWorkLocation::select('id', 'name')->get();
        $data['employerSelectionPreference'] = EmployerSelectionPreference::select('id', 'name')->get();
        $data['states'] = State::select('id', 'name')->get();

        return sendSuccess("success", $data, 200);
    }

    public function getProfession($id)
    {
        $professions = Profession::select('id', 'name')->where('industry_id', $id)->get();
        return sendSuccess("success", $professions, 200);
    }

    public function addSalary(Request $request)
    {
        try {
            $salaray = Salary::UpdateOrCreate([
                'start_range' => $request->salary,
            ], [
                'salary_range' => $request->salary,
            ]);
            return sendSuccess("success", $salaray, 200);
        } catch (\Exception $e) {
            return sendError($e->getMessage(), null, 400);
        }
    }
}