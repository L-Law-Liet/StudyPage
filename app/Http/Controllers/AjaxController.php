<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.07.2018
 * Time: 19:22
 */

namespace App\Http\Controllers;


use App\Models\City;
use App\Models\CostEducation;
use App\Models\Degree;
use App\Models\Direction;
use App\Models\Specialty;
use App\Models\Subdirection;
use App\Models\University;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function doctorFilter(Request $request){
        dd(1);
        //dd($request->all());
    }

    public function getCity(){
        $data = Input::all();
        $cities = City::where('id', $data['city_id'])->where('active', 1)->pluck('name_ru', 'id')->all();
        $res = '';
        foreach($cities as $k => $v){
            $res .= '<option value="'.$k.'">'.$v.'</option>';
        }
        return json_encode($res);
    }
    public function getSubdirection(){
        $data = Input::all();
        if ($data['direction_id'] != 'any') {
            $directionId = Direction::where('url', $data['direction_id'])->pluck('id');
            $sdirections = Subdirection::where('direction_id', $directionId)->pluck('name_ru', 'url')->all();
            $res = '<option value="">Выберите</option>';
            foreach ($sdirections as $k => $v) {
                $res .= '<option value="' . $k . '">' . $v . '</option>';
            }
        } else {
            $res = 'any';
        }
        return json_encode($res);
    }
    public function getUn(){
        $data = Input::all();
        if ($data['city_id'] != 'any') {
            $cityId = City::where('url', $data['city_id'])->pluck('id');
            $un = $data = University::where('city_id', $cityId)->pluck('name_ru', 'id');
            $res = '<option value="">Выберите</option>';
            foreach ($un as $k => $v) {
                $res .= '<option value="' . $k . '">' . $v . '</option>';
            }
        } else {
            $un = $data = University::pluck('name_ru', 'id');
            $res = '<option value="">Выберите</option>';
            foreach ($un as $k => $v) {
                $res .= '<option value="' . $k . '">' . $v . '</option>';
            }
        }
        return json_encode($res);
    }
    public function getSpecialties(){
        $data = Input::all();
        if (!empty($data['subdirection_id']) AND $data['subdirection_id'] != 'any') {
            if ($data['degree_id'] != 'any') {
                $degreeId = Degree::where('url', $data['degree_id'])->pluck('id');
                $subdirectionId = Subdirection::where('url', $data['subdirection_id'])->pluck('id');
                $specialties = Specialty::select('name_ru', 'id', 'url')->where('subdirection_id', $subdirectionId)->where('degree_id', $degreeId)->get();
            } else {
                $subdirectionId = Subdirection::where('url', $data['subdirection_id'])->pluck('id');
                $specialties = Specialty::select('name_ru', 'id', 'url')->where('subdirection_id', $subdirectionId)->get();
            }

        } else {
            //$degreeId = Degree::where('url', $data['degree_id'])->pluck('id');
            //$specialties = Specialty::where('degree_id', $degreeId)->pluck('name_ru', 'id')->all();
            $specialties = null;
        }
        if ($specialties != null) {
            $mass = array();
            $res = '<option value="any">Выберите</option>';
            foreach ($specialties as $k => $v) {
                if (!in_array($v->name_ru, $mass)) {
                    $res .= '<option value="' . $v->url . '">' . $v->name_ru . '</option>';
                    $mass[] = $v->name_ru;
                }
            }
        } else {
            $res = 'any';
        }
        return json_encode($res);
    }
    public function getSpecialty(){
        $data = Input::all();
        
        $specialties = CostEducation::select(DB::raw('cost_education.*'));
        $specialties->join('specialties', 'specialties.id', '=', 'cost_education.specialty_id');
        $specialties->join('universities', 'universities.id', '=', 'cost_education.university_id');
        $specialties->join('cities', 'cities.id', '=', 'universities.city_id');
        $ar['type'] = !empty($data['type']) ? $data['type'] : '';

        if(empty($data['degree_id']) OR $data['degree_id'] == 'any'){
            $ar['degree_id'] = null;
        } else {
            $ar['degree_id'] = $data['degree_id'];
            $degreeId = Degree::where('url', $ar['degree_id'])->pluck('id');
            $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($degreeId) {
                $q->where('degree_id', $degreeId);
            });
        }

        if(!empty($data['direction_id']) AND $data['direction_id'] != 'any') {
            $directionId = Direction::where('url', $data['direction_id'])->pluck('id');
            $subdirectionIds = Subdirection::select('id')->where('direction_id', $directionId)->get()->toArray();
                $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($subdirectionIds) {
                    $q->whereIn('subdirection_id', $subdirectionIds);
                });
        }


        if(!empty($data['subdirection_id']) AND $data['subdirection_id'] != 'any') {
            $subdirectionId = Subdirection::where('url', $data['subdirection_id'])->pluck('id');
            $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($subdirectionId) {
                $q->where('subdirection_id', $subdirectionId);
            });
        }

        if(!empty($data['specialty_id']) AND $data['specialty_id'] != 'any')
            $specialties->where('specialties.url', $data['specialty_id']);

        if(!empty($data['subject_id'])) {
            $subjectId = $data['subject_id'];
            if(count($subjectId) == 1) {
                $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($subjectId) {
                    $q->whereIn('subject_id', $subjectId);
                    $q->orWhereIn('subject_id2', $subjectId);
                });
            } else {
                $specialties = $specialties->whereHas('relSpecialty', function ($q) use ($subjectId) {
                    $q->whereIn('subject_id', $subjectId);
                    $q->whereIn('subject_id2', $subjectId);
                });
            }
        }

        if(count($data) > 1){
            if(!empty($data['search'])){
                $specialties = $specialties->where('specialties.name_ru', 'LIKE', '%'.$data['search'].'%');
            }
        }

        if(!empty($data['city_id']) AND $data['city_id'] != 'any') {
            $cityId = City::where('url', $data['city_id'])->pluck('id');
            $specialties = $specialties->whereHas('relUniversity', function ($q) use ($cityId) {
                $q->where('city_id', $cityId);
            });
        }

        if(!empty($data['un_id'])) {
            $un = $data['un_id'];
            $ar['un_id'] = $un;
            $specialties = $specialties->whereHas('relUniversity', function ($q) use ($un) {
                $q->where('id', $un);
            });
        }

        if(!empty($data['type_id'])) //ВУЗ
            $specialties->where('type_id', $data['type_id']);

        if(!empty($data['program_id'])) //Программа (ранее сфера называлась)
            $specialties->where('sphere_id', $data['program_id']);

        if(isset($data['sort']) && !empty($data['sort'])){
            if($data['sort'] == 'town')
                $specialties = $specialties->orderBy('cities.name_ru');
            elseif($data['sort'] == 'name')
                $specialties = $specialties->orderBy('specialties.name_ru');
            elseif($data['sort'] == 'cost')
                $specialties = $specialties->orderBy('cost_education.price');
        } else {
            $specialties = $specialties->orderBy('specialties.name_ru'); //По умолчанию сортировка по названию специальности
        }

        $ar['specialties'] = $specialties->paginate(10);
        $ar['count'] = $ar['specialties']->total();
        $ar['sort'] = $data['sort'];

        return view('paginate', $ar);
    }

    public function postUniversity(){
        $name = Input::get('name', '');
        if (isset($name)){
            $university = University::where('name_ru', 'LIKE', '%'.$name.'%')->take(10)->select('name_ru', 'id')->get();
            if ($university){
                $array =  [];
                foreach ($university as $val) {
                    $array[] = [
                        'label' => $val->name_ru,
                        'value' => $val->id
                    ];
                }
                return $array;
            }
        }
        return false;
    }

}
