<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CostEducation;
use App\Models\Degree;
use App\Models\Direction;
use App\Models\Requirement;
use App\Models\Specialty;
use App\Models\Sphere;
use App\Models\Subdirection;
use App\Models\Subject;
use App\Models\Type;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PoiskController extends Controller
{
    public static function GetTransliterate($s) {
        $s = (string) $s;
        $s = strip_tags($s);
        $s = str_replace(array("\n", "\r"), " ", $s);
        $s = preg_replace("/\s+/", ' ', $s);
        $s = trim($s);
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s);
        $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
        $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s);
        $s = str_replace(" ", "-", $s);
        return $s;
    }
    public function index()
    {
//        if(Input::get('degree_id') == 1){
//            return redirect()->route('uni-col', ['pages' => 0, 'direction_id' => Input::get('direction_id'),
//                'city_id' => Input::get('city_id'), 'search' => Input::get('search')]);
//        }
        return redirect()->route('doctor', ['degree' => Input::get('degree_id'), 'pages' => 0, 'direction_id' => Input::get('direction_id'),
            'city_id' => Input::get('city_id'), 'search' => Input::get('search')]);
    }

    public function getView($id){

        $ar = [];
        $ar['specialty'] = CostEducation::findOrFail($id);
        $ar['requirement'] = Requirement::where('degree_id', $ar['specialty']->relSpecialty->degree_id)->first();

        return view('find.view', $ar);
    }
}
