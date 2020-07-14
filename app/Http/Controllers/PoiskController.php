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
        $ar = [];
        $data = Input::all();

//        $asd = Specialty::all();
//        foreach ($asd as $a) {
//            $a->url = self::GetTransliterate($a->name_ru);
//            $a->saveOrFail();
//        }

        $ar['degrees'] = Degree::select('name_ru', 'url', 'id')->get();
        $ar['directions'] = Direction::select('name_ru', 'url', 'id')->orderBy('id', 'DESC')->get();
        $ar['cities'] = City::where('active', 1)->pluck('name_ru', 'url')->all();
        if ($data['direction_id'] != 'any') {
            $directionId = Direction::where('url', $data['direction_id'])->pluck('id');
            $ar['subdirections'] = Subdirection::select('name_ru', 'url')->where('direction_id', $directionId)->get();
//            echo '<pre>';
//            print_r($ar['subdirections']);
//            die;
        } else {
            $ar['subdirections'] = null;
        }
        $ar['spec'] = null;
        if (empty($data['specialty_id'])) {
            $ar['specialty_id'] = null;
        } else {
            $ar['specialty_id'] = $data['specialty_id'];
        }
        if ($data['direction_id'] != 'any' AND $data['subdirection_id'] != 'any') {
            $subdirectionId = Subdirection::where('url', $data['subdirection_id'])->pluck('id');
            if ($data['degree_id'] != 'any') {
                $degreeId = Degree::where('url', $data['degree_id'])->pluck('id');
                $ar['spec'] = Specialty::select('name_ru', 'id', 'url')->where('subdirection_id', $subdirectionId)->where('degree_id', $degreeId)->get();
            } else {
                $ar['spec'] = Specialty::select('name_ru', 'id', 'url')->where('subdirection_id', $subdirectionId)->get();
            }

        }

        $ar['types'] = Type::pluck('name_ru', 'id')->all();
        $ar['programs'] = Sphere::pluck('name_ru', 'id')->all();
        $ar['subjects'] = Subject::pluck('name_ru', 'id')->all();
        $ar['u'] = University::pluck('name_ru', 'id')->all();
        if (!empty($data['search'])) {
            $ar['search'] = $data['search'];
        } else {
            $ar['search'] = '';
        }
        $specialties = CostEducation::select(DB::raw('cost_education.*'));
        $specialties->join('specialties', 'specialties.id', '=', 'cost_education.specialty_id');
        $specialties->join('universities', 'universities.id', '=', 'cost_education.university_id');

        $ar['type'] = !empty($data['type']) ? $data['type'] : '';
        if(empty($data['degree_id']) OR $data['degree_id'] == 'any'){
            $ar['degree_id'] = null;
        } else {
            $ar['degree_id'] = $data['degree_id'];
        }
        if(empty($data['direction_id']) OR $data['direction_id'] == 'any'){
            $ar['direction_id'] = null;
        } else{
            $ar['direction_id'] = $data['direction_id'];
            $directionId = Direction::where('url', $data['direction_id'])->pluck('id');
            $subdirectionIds = Subdirection::select('id')->where('direction_id', $directionId)->get()->toArray();
//            print_r($subdirectionIds);
//            die;
            $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($subdirectionIds) {
                $q->whereIn('subdirection_id', $subdirectionIds);
            });
        }
        if(!empty($data['specialty_id']) AND $data['specialty_id'] != 'any')
            $specialties->where('specialties.url', $data['specialty_id']);
//        if ($data['pr1'] != 'any') {
//            $specialties->where('subject_id', $data['pr1'])->orWhere('subject_id2', $data['pr1']);
//        }
//        if ($data['pr2'] != 'any') {
//            $specialties->where('subject_id2', $data['pr2'])->orWhere('subject_id2', $data['pr2']);
//        }

        $subjectsId = array();
        if (!empty($data['pr1']) AND $data['pr1'] != 'any') {
            $subjectsId[] = $data['pr1'];
        }
        if (!empty($data['pr2']) AND $data['pr2'] != 'any') {
            $subjectsId[] = $data['pr2'];
        }
        if (count($subjectsId) > 0) {
            if (count($subjectsId) == 1) {
                $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($subjectsId) {
                    $q->whereIn('subject_id', $subjectsId);
                    $q->orWhereIn('subject_id2', $subjectsId);
                });
            } else {
                $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($subjectsId) {
                    $q->whereIn('subject_id', $subjectsId);
                    $q->whereIn('subject_id2', $subjectsId);
                });
            }
        }

        if (empty($data['subdirection_id']) OR $data['subdirection_id'] == 'any') {
            $ar['subdirection_id'] =  null;
        } else {
            $ar['subdirection_id'] =  $data['subdirection_id'];
            $subdirectionId = Subdirection::where('url', $data['subdirection_id'])->pluck('id');
            $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($subdirectionId) {
                $q->where('subdirection_id', $subdirectionId);
            });
        }

        if(empty($data['city_id']) OR $data['city_id'] == 'any'){
            $ar['city_id'] = null;
        } else{
            $ar['city_id'] = $data['city_id'];
            $cityId = City::where('url', $data['city_id'])->pluck('id');
            $specialties = $specialties->whereHas('relUniversity', function ($q) use ($cityId) {
                $q->where('city_id', $cityId);
            });

            $ar['u'] = University::where('city_id', $cityId)->pluck('name_ru', 'id');
        }

        if(empty($data['un_id']) OR $data['un_id'] == 'any'){
            $ar['un_id'] = null;
        } else{
            $ar['un_id'] = $data['un_id'];
            $unId = $data['un_id'];
            $specialties = $specialties->whereHas('relUniversity', function ($q) use ($unId) {
                $q->where('university_id', $unId);
            });
        }

        if (empty($data['type_id']) OR $data['type_id'] == 'any') {
            $ar['type_id'] = null;
        } else {
            $ar['type_id'] = $data['type_id'];
            $ti =  $ar['type_id'];
            $specialties = $specialties->whereHas('relUniversity', function ($q) use ($ti) {
                $q->where('type_id', $ti);
            });
        }

        if(count($data) > 1){
            if(!empty($data['search'])){
                $specialties = $specialties->where('specialties.name_ru', 'LIKE', '%'.$data['search'].'%');
            }
        }

        if(!empty($ar['degree_id'])) {
            $degreeId = Degree::where('url', $ar['degree_id'])->pluck('id');
            $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($degreeId) {
                $q->where('degree_id', $degreeId);
            });
        }

        if(isset($data['sort']) && !empty($data['sort'])){
            if($data['sort'] == 'town')
                $specialties = $specialties->orderBy('cities.name_ru');
            elseif($data['sort'] == 'name')
                $specialties = $specialties->orderBy('specialties.name_ru');
            elseif($data['sort'] == 'cost')
                $specialties = $specialties->orderBy('cost_education.price');

            $ar['sort'] = $data['sort'];
        } else {
            $specialties = $specialties->orderBy('specialties.name_ru'); //По умолчанию сортировка по названию специальности
            $ar['sort'] = 'name';
        }
        $ar['specialties'] = $specialties->paginate(10);
        $ar['count'] = $ar['specialties']->total();

        return view('find.main', $ar);
    }

    public function getView($id){

        $ar = [];
        $ar['specialty'] = CostEducation::findOrFail($id);
        $ar['requirement'] = Requirement::where('degree_id', $ar['specialty']->relSpecialty->degree_id)->first();

        return view('find.view', $ar);
    }
}
