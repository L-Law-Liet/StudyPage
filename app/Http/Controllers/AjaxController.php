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
use App\Models\Sphere;
use App\Models\Subdirection;
use App\Models\Subject;
use App\Models\Type;
use App\Models\University;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;

class AjaxController extends Controller
{
    public function doctorFilter($pages, Request $request, $query = null){
        $a = json_decode($request->get('a'));
        $degree = 0;
        $city_id = 0;
        $direction_id = 0;
        if ($a->degree){
            $degree = $a->degree;
        }
        if ($a->sphere){
            $direction_id = $a->sphere;
            $subDir = Subdirection::where('direction_id', $a->sphere)->get();
        }
        else {
            $subDir = Subdirection::all();
        }
        if ($a->region){
            $city_id = $a->region;
            $us = University::where('city_id', $a->region);
        }
        else {
            $us = University::all();
        }
        $costs = PagesController::mainFilter($degree, $direction_id, $city_id, $query);
        if ($a->when){
            if ($a->when == 'after9' ){
                $costs = $costs->where('income', 'После 9 класса')->values();
            }
            elseif ($a->when == 'afterSchool'){
                $costs = $costs->where('income', 'После школы')->values();
            }
        }
        if ($a->studyForm){
            if ($a->studyForm == 'ochnaya' ){
                $costs = $costs->where('education_form', 'Очная (дневная)')->values();
            }
            elseif ($a->studyForm == 'dist' ){
                $costs = $costs->where('education_form', 'Заочная')->values();
            }
        }
        if ($a->direction){
            $costs = $costs->whereIn('specialty_id', Specialty::where('subdirection_id', $a->direction)->pluck('id')->toArray());
            $specs = Specialty::where('subdirection_id', $a->direction)->get();

        }
        else {
            $specs = Specialty::all();
        }
        if ($a->programGroup){
            $costs = $costs->where('specialty_id', $a->programGroup)->values();
        }
        if ($a->univer){
            $costs = $costs->where('university_id', $a->univer)->values();
            //dd($costs);
        }
        if ($a->uniType){
            $costs = $costs->whereIn('university_id', University::where('type_id', $a->uniType)->pluck('id')->toArray());
        }
        $dirs = Direction::all();
        $sub = Subject::all();
        $sp = Sphere::all();
        $cs = City::all();
        $ts = Type::all();
        switch ($a->sort){
            case 'name':
                $costs = $costs->sortBy('specialty_id')->values();
                break;
            case 'city':
                $costs = $costs->sortBy('city_id')->values();
                break;
            case 'cost':
                $costs = $costs->sortBy('price')->values();
                break;
        }
        $result = "";
        $result .= "            
            <div class=\"col-md-4 left-block\">
                <div class=\"form-group\">
                    <label>Степень обучения</label>
                    <select onchange=\"dopFilter(event)\" id=\"degreeSelect\" class=\"ajax-filter form-control\" name=\"degree\">
                        <option value=\"\">Выберите</option>";
                        foreach(\App\Models\Degree::all() as $d) {
                           $result .= "<option ";
                           if($d->id == $degree) {
                               $result .= "selected ";
                               }
                        $result .= "value=\"".$d->id."\">".$d->name_ru."</option>";
                        }
        $result .= "</select>
                </div>
                <div class=\"form-group\">
                    <label>Область образования</label>
                    <select onchange=\"dopFilter(event)\" id=\"oblSelect\" class=\"ajax-filter form-control\" name=\"sphere\">
                        <option value=\"\">Выберите</option>";
        foreach($dirs as $s) {
            $result .= "<option ";
            if($direction_id == $s->id) {
                $result .= "selected ";
            }
            $result .= "value=\"".$s->id."\">".$s->name_ru."</option>";
        }
        $result .= "</select>
                </div>
                <div id=\"dir\" class=\"form-group\"";
        if (!$direction_id){
            $result .= "style=\"display: none\"";
        }
        $result .= ">
                    <label>Направление подготовки</label>
                    <select onchange=\"dopFilter(event)\" id=\"dirSelect\" class=\"ajax-filter form-control\" name=\"direction\">
                        <option value=\"\">Выберите</option>";
        foreach($subDir as $d) {
            $result .= "<option ";
            if($a->direction == $d->id) {
                $result .= "selected ";
            }
            $result .= "value=\"".$d->id."\">".$d->name_ru."</option>";
        }
        $result .= "</select>
                </div>
                <div id=\"grup\" class=\"form-group\"";
        if (!$a->direction){
            $result .= " style=\"display: none\"";
        }
        $result .= ">
                    <label>Группа образовательных программ</label>
                    <select id=\"grupSelect\" class=\"ajax-filter form-control\" name=\"programGroup\">
                        <option value=\"\">Выберите</option>";
        foreach($specs as $s) {
            $result .= "<option ";
            if($a->programGroup == $s->id) {
                $result .= "selected ";
            }
            $result .= "value=\"".$s->id."\">".$s->name_ru."</option>";
        }
        $result .= "</select>
                </div>
                <div id=\"income\" class=\"form-group\"";
        if ($a->degree != 1){
            $result .= " style=\"display: none\"";
        }
        $result .= ">
                    <label>Поступление в ВУЗ</label>
                    <select onchange=\"dopFilter(event)\" id=\"incomeSelect\" class=\"ajax-filter form-control\" name=\"when\">
                        <option value=\"\">Выберите</option>";
        $result .= "<option ";
        if($a->when == 'after9') {
            $result .= "selected ";
        }
        $result .= "value=\"after9\">После 9 класса</option>";

        $result .= "<option ";
        if($a->when == 'afterSchool') {
            $result .= "selected ";
        }
        $result .= "value=\"afterSchool\">После школы</option>";
        $result .= "</select>
                </div>
                <div id=\"1prof\" class=\"form-group\"";
        if ($a->when != 'afterSchool'){
            $result .= " style=\"display: none\"";
        }
        $result .= ">
                    <label>1-й профильный предмет</label>
                    <select id=\"1profSelect\" class=\"ajax-filter form-control\" name=\"firstSubject\">
                        <option value=\"\">Выберите</option>";
        foreach($sub as $s) {
            if ($s->id != $a->secondSubject){
                $result .= "<option ";
                if($a->firstSubject == $s->id) {
                    $result .= "selected ";
                }
                $result .= "value=\"".$s->id."\">".$s->name_ru."</option>";
            }
        }
        $result .= "</select>
                </div>
                <div id=\"2prof\" class=\"form-group\"";
        if ($a->when != 'afterSchool'){
            $result .= " style=\"display: none\"";
        }
        $result .= ">
                    <label>2-й профильный предмет</label>
                    <select id=\"2profSelect\" class=\"ajax-filter form-control\" name=\"secondSubject\">
                        <option value=\"\">Выберите</option>";
        foreach($sub as $s) {
         if ($s->id != $a->firstSubject){
             $result .= "<option ";
             if($a->secondSubject == $s->id) {
                 $result .= "selected ";
             }
             $result .= "value=\"".$s->id."\">".$s->name_ru."</option>";
         }
        }
        $result .= "</select>
                </div>
                <div id=\"sfera\" class=\"form-group\"";
        if ($a->degree < 2){
            $result .=  " style=\"display: none\"";
        }
        $result .= ">
                    <label>Сфера направления</label>
                    <select id=\"sferaSelect\" class=\"ajax-filter form-control\" name=\"sphereDirect\">
                        <option value=\"\">Выберите</option>";
        foreach($sp as $s) {
            $result .= "<option ";
            if($a->sphereDirect == $s->id) {
                $result .= "selected ";
            }
            $result .= "value=\"".$s->id."\">".$s->name_ru."</option>";
        }
        $result .= "</select>
                </div>
                <div class=\"form-group\">
                    <label>Стоимость обучения</label>
                    <div class=\"d-flex justify-content-between\">
                        <input name=\"startCost\" class=\"ajax-filter form-control w-50 mr-2 p-2 \" value=\"\" type=\"number\" placeholder=\"от\">
                        <input name=\"endCost\" class=\"ajax-filter form-control w-50 ml-3 p-2 \" value=\"\" type=\"number\" placeholder=\"до\">
                    </div>
                </div>
                <div id=\"forma\" class=\"form-group\"";
        if ($a->degree < 2 && $a->when != 'afterSchool'){
            $result .=  " style=\"display: none\"";
        }
        $result .= ">
                    <label>Форма обучения</label>
                    <select id=\"formaSelect\" class=\"ajax-filter form-control\" name=\"studyForm\">
                        <option value=\"\">Выберите</option>";
        $result .= "<option ";
        if($a->studyForm == 'ochnaya') {
            $result .= "selected ";
        }
        $result .= "value=\"ochnaya\">Очная(дневная)</option>";

        $result .= "<option ";
        if($a->studyForm == 'dist') {
            $result .= "selected ";
        }
        $result .= "value=\"dist\">Дистанционная</option>";
        $result .= "</select>
                </div>
                <div class=\"form-group\">
                    <label>Регион</label>
                    <select class=\"ajax-filter form-control\" name=\"region\">
                        <option value=\"\">Выберите</option>";
        foreach($cs as $c) {
            $result .= "<option ";
            if($city_id == $c->id) {
                $result .= "selected ";
            }
            $result .= "value=\"".$c->id."\">".$c->name_ru."</option>";
        }
        $result .= "</select>
                </div>
                <div class=\"form-group\">
                    <label>ВУЗ</label>
                    <select class=\"ajax-filter form-control\" name=\"univer\">
                        <option value=\"\">Выберите</option>";
        foreach($us as $c) {
            $result .= "<option ";
            if($city_id == $c->id) {
                $result .= "selected ";
            }
            $result .= "value=\"".$c->id."\">".$c->name_ru."</option>";
        }
        $result .= "</select>
                </div>
                <div class=\"form-group\">
                    <label>Тип учебного заведения</label>
                    <select class=\"ajax-filter form-control\" name=\"uniType\">
                        <option value=\"\">Выберите</option>";
                        foreach($ts as $s){
                            $result .= "<option ";
                            if($a->uniType == $s->id) {
                                $result .= "selected ";
                            }
                            $result .= "value=\"".$s->id."\">".$s->name_ru."</option>";
                        }
        $result .= "</select>
                </div>
            </div>";
        $result .= "            
            <div class=\"col-md-8 right-block result\">
                <div class=\"sgs-list-header clearfix\">
                    <div class=\"row\">
                        <div class=\"col-xs-12 col-sm-8 col-md-8 col-lg-8\">
                            <p class=\"pull-left\">Результат: найдено специальностей <span class=\"count\">".count($costs)."</span></p>
                        </div>
                        <div class=\"col-xs-12 col-sm-4 col-md-4 col-lg-4 mt--3\">
                                <div class=\"form-group m-b-0\">
                                    <select class=\"ajax-filter form-control\" id=\"sortorder\" name=\"sort\">
                                        <option value=\"\">Сортировка по</option>";
        $result .= "<option ";
        if($a->sort == 'name'){
            $result .= "selected ";
        }
        $result .= "value=\"name\">Наименование</option>";

        $result .= "<option ";
        if($a->sort == 'city'){
            $result .= "selected ";
        }
        $result .= "value=\"city\">Город</option>";

        $result .= "<option ";
        if($a->sort == 'cost'){
            $result .= "selected ";
        }
        $result .= "value=\"cost\">Стоимость</option>";
        $result .=                 "</select>
                                </div>
                        </div>
                    </div>
                </div>
                <div>
                    <ul class=\"sgs-list-ul\">";
        $pageSize = 10+$pages*10;
        if ($pageSize > count($costs))
        $pageSize = count($costs);
        for ($i = $pages*10; $i < $pageSize; $i++) {
            if (University::find($costs[$i]->university_id)->city_id){
                $result .= "<li>
                            <div style=\"margin-bottom: 30px;\">
                                <h3>
                                    <a href=\"" . url('/college/view', [$costs[$i]->specialty_id, 'uid', $costs[$i]->university_id]) . "\">
                                        <strong>" . Specialty::find($costs[$i]->specialty_id)->name_ru . "</strong>
                                        <span>" .University::find($costs[$i]->university_id)->name_ru . "</span> • " .University::find($costs[$i]->university_id)->relCity->name_ru ."
                                    </a>
                                </h3>
                                <table>
                                    <tbody class=\"main-table\">
                                    <tr>
                                        <td>Степень обучения</td>
                                        <td>" . Specialty::find($costs[$i]->specialty_id)->relDegree->name_ru . "</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость обучения</td>
                                        <td>" . $costs[$i]->price . " тг. / год</td>
                                    </tr>";
                if ($costs[$i]->relSpecialty->degree_id == 2 || $costs[$i]->relSpecialty->degree_id == 3) {
                    $result .= "<tr>
                                            <td>Сфера направления</td>
                                            <td>" . Specialty::find($costs[$i]->specialty_id)->relSphere->name_ru . "</td>
                                        </tr>";
                }
                else {
                    $result .= "<tr>
                                            <td>Поступление в ВУЗ</td>
                                            <td>" . $costs[$i]->income . "</td>
                                        </tr>
                                        <tr>
                                            <td>Профильный предмет</td>
                                            <td>" . Specialty::find($costs[$i]->specialty_id)->relSubject->name_ru . "</td>
                                        </tr>";
                }
                $result .= "<tr>
                                        <td>Срок обучения</td>
                                        <td>".Specialty::find($costs[$i]->specialty_id)->education_time."</td>
                                    </tr>
                                    <tr>
                                        <td>Форма обучения</td>
                                        <td>".$costs[$i]->education_form."</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>";
            }
        }
        $result .= "
                            </ul>
                </div>
            </div>
     
            </div>";
        if ($degree == 1) {
            $map = 'Главная , Бакалавриат';
        }
        elseif ($degree == 2){
            $map = 'Главная , Магистратура';
        }
        elseif($degree == 3) {
            $map = 'Главная , Докторантура';
        }
        else {
            $map = 'Главная , Специалности';
        }
        return Response($result);
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
