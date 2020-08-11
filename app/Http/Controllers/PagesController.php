<?php

namespace App\Http\Controllers;

use App\CalculatorCost;
use App\GrantsDiscounts;
use App\Models\City;
use App\Models\CostEducation;
use App\Models\Direction;
use App\Models\Faq;
use App\Models\Parner;
use App\Models\Requirement;
use App\Models\Specialty;
use App\Models\Sphere;
use App\Models\Subdirection;
use App\Models\Subject;
use App\Models\Type;
use App\Models\University;
use App\Models\User;
use App\Profile;
use App\ProfileUniversity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\Cast\Object_;

class PagesController extends Controller
{
    public function showCabinet(){
        $cities = City::all();
        return view('cabinet')->with('map', 'Главная , Личные данные')->with('cities', $cities);
    }

    public function showCollege($pages = 0){
        $specialities = Specialty::where('degree_id', 1)->get();
        $specIDs = array_column($specialities->toArray(), 'id');
        $costs = CostEducation::whereIn('specialty_id', $specIDs)->get();
        return view('college')->with('costs', $costs)->with('page', $pages)->with('active', 'college')->with('map', 'Главная , Колледж');
    }
    public function viewCollege($sid, $uid){
        $u = University::find($uid);
        $speciality = Specialty::find($sid);
        $ar['requirement'] = Requirement::where('degree_id', 1)->first();
        $features = [ 'Квалификация' , 'Поступление в колледж', CostEducation::where('specialty_id', $sid)->where('university_id', $uid)->first()->income];
        if ($speciality->degree_id == 2){
            $ar['requirement'] = Requirement::where('degree_id', 2)->first();
            $features = [ 'Степень обучения' , 'Сфера направления', $speciality->relSphere->name_ru];
        }
        else if ($speciality->degree_id == 3){
            $ar['requirement'] = Requirement::where('degree_id', 3)->first();
            $features = [ 'Степень обучения' , 'Сфера направления', $speciality->relSphere->name_ru ];
        }
        else if(CostEducation::where('specialty_id', $sid)->where('university_id', $uid)->first()->income == 'После 9 класса'){
            $features = [ 'Степень обучения' , 'Поступление в ВУЗ', CostEducation::where('specialty_id', $sid)->where('university_id', $uid)->first()->income, 'Профильный предмет', $speciality->relSubject->name_ru ];
        }
        else if (CostEducation::where('specialty_id', $sid)->where('university_id', $uid)->first()->income == 'После школы'){
            $features = [ 'Степень обучения' , 'Поступление в ВУЗ', CostEducation::where('specialty_id', $sid)->where('university_id', $uid)->first()->income, 'Профессиональные дисциплины', $speciality->relSubdirection->name_ru ];
    }
        if (str_contains(url()->previous(), '/college')) {
            $hrefTitle = 'college';
        }
        else {
            $hrefTitle = 'univer';
        }
        return view('view-college')->with('s', $speciality)->with('u', $u)->with('requirement', $ar['requirement'])->with('f', $features)->with('href', $hrefTitle);
    }
    public function viewUniver($id){
//        $u = University::find($id);

        $ar['requirement'] = Requirement::where('degree_id', 1)->first();
        return view('view-univer')->with('requirement', $ar['requirement'])/*->with('college', $u)*/;
    }
    public function showUniversityAfterSchool($pages = 0){
        $specialities = Specialty::where('degree_id', 1)->get();
        $specIDs = array_column($specialities->toArray(), 'id');
        $costs = CostEducation::whereIn('specialty_id', $specIDs)->get();

        return view('university-school')->with('costs', $costs)->with('page', $pages)->with('active', 'university')->with('map', 'Главная , ВУЗ');
    }
    public function showUniversityAfterCollege($pages, Request $request){
        $city_id = 0;
        $direction_id = 0;
        $query = null;
        if ($request->get('direction_id')){
            $direction_id = $request->get('direction_id');
        }
        if ($request->get('city_id')){
            $city_id = $request->get('city_id');
        }
        if ($request->get('search')){
            $query = $request->get('search');
        }

        $specialities = PagesController::mainFilter(1, $direction_id, $city_id, $query);
        return view('university-college')->with('costs', $specialities)->with('page', $pages)->with('active', 'university')->with('query', $query)->with('dir_id', $request->get('direction_id'))->with('city_id', $request->get('city_id'))->with('map', 'Главная , Бакалавриат');
    }
public static function mainFilter($degree, $direction_id, $city_id, $query){
    $s = CostEducation::select(DB::raw('cost_education.*'));
    $s->join('specialties', 'specialties.id', '=', 'cost_education.specialty_id');
    $s->join('universities', 'universities.id', '=', 'cost_education.university_id');
    if ($degree != 0) {
        $ar['specialties'] = $s->where('specialties.degree_id', $degree);
    }
    if ($city_id != 0) {
        $ar['specialties'] = $s->where('city_id', $city_id);
    }
    if ($query != null AND strlen($query) >= 1 AND $query != 'none') {
        $ar['specialties'] = $s->where('specialties.name_ru', 'LIKE', '%'.$query.'%');
    }
    if ($direction_id != 0) {
        if ($direction_id == 1){
            $L = 'Очная (дневная)';
        }
        else{
            $L = 'Дистанционная';
        }
        $s = $s->where('education_form', $L);
    }
    $S = $s->get();
    return $S;
}
    public function showDoctor($degree, $page, Request $request){
        $city_id = 0;
        $studyForm = 0;
        $query = null;
        if ($request->get('studyForm')){
            $studyForm = $request->get('studyForm');
        }
        if ($request->get('city_id')){
            $city_id = $request->get('city_id');
        }
        if ($request->get('search')){
            $query = $request->get('search');
        }
        $costs = PagesController::mainFilter($degree, $studyForm, $city_id, $query);
        $directions = Direction::all();
        $subDir = Subdirection::all();
        $subs = Subject::where('forCollege', 0)->get();
        $sp = Sphere::all();
        $cs = City::all();
        $ts = Type::all();
        if ($degree == 4){
            $us = University::where('type_id', 5)->get();
        }
        else {
            $us = University::where('type_id', '<>', 5)->get();
        }
        $specs = Specialty::all();
        if ($degree == 1) {
            $map = 'Главная , Бакалавриат';
            $active = 'university';
        }
        elseif ($degree == 2){
            $map = 'Главная , Магистратура';
            $active = 'university';
        }
        elseif($degree == 3) {
            $map = 'Главная , Докторантура';
            $active = 'university';
        }
        elseif($degree == 4) {
            $map = 'Главная , Колледжи';
            $active = 'college';
        }
        else {
            $map = 'Главная , ВУЗы';
            $active = 'university';
        }
        $a = (object) array('sphere' => null, 'direction' => null, 'programGroup' => null,
            'when' => null, 'startCost' => null, 'endCost' => null, 'firstSubject' => null,
            'secondSubject' => null, 'sphereDirect' => null, 'univer' => null, 'uniType' => null,
            'sort' => null, 'pageBtn' => null, 'learnProgram' => null);
        return view('doctor', compact('active', 'subDir'), ['dirs' => $directions, 'subs' => $subs, 'sp' => $sp, 'us' => $us, 'specs' => $specs,
            'ts' => $ts, 'cs' => $cs])->with('costs', $costs)->with('page', $page)->with('degree', $degree)
            ->with('query', $query)->with('studyForm', $studyForm)->with('city_id', $request->get('city_id'))->with('map', $map)->with('a', $a);
    }


    public function showFAQ($id = 1){
        $faq = Faq::find($id);
        $navActive = true;
        return view('faq.select-prof', compact('faq', 'navActive'))->with('map', 'Главная , Навигатор , '.$faq->question);
    }

    public function collegeList(){
        $universities = University::where('city_id', '<>', null)->get();
        return view('college-list')->with('universities', $universities)->with('map', 'Главная , Навигатор , Список колледжей')->with('navActive', 1);
    }
    public function univerList(){
        $universities = University::where('city_id', '<>', null)->get();
        return view('univer-list')->with('universities', $universities)->with('map', 'Главная , Навигатор , Список ВУЗов')->with('navActive', 1);
    }
    public function partnerList(){
        $partners = Parner::all();
        return view('partner-list')->with('partners', $partners)->with('map', 'Главная , Навигатор , Партнеры')->with('navActive', 1);
    }
    public function entCalculator($error = null){
        if (!session()->get('refreshed')){
            session(['refreshed' => url()->previous()]);
        }
        if (strstr(session()->get('refreshed'), '?', TRUE) == strstr(url()->previous(), '?', TRUE)){
            $error = null;
        }
        return view('ent-calculator', ['ss' => Subject::where('forCollege', 0)->get()])->with('active', 'ent-calc')->with('map', 'Главная , Калькулятор ЕНТ')->with('error', $error);
    }
    public function entResult(Request $request){
        $check = 0;
        if (!$request->get('access')){
            session()->forget('access');
            return redirect()->route('calculator-ent');
        }
        if (Auth::check()) {
                if (Auth::user()->bill < CalculatorCost::all('calc_price')->first()->calc_price) {
                    return redirect()->route('calculator-ent')->with('m', 'Недостаточно средств!')->with('active', 'ent-calc')->with('map', 'Главная , Калькулятор ЕНТ');
                } else {
                    $user = User::find(Auth::id());
                    $user->bill -= CalculatorCost::all('calc_price')->first()->calc_price;
                    Auth::user()->bill = $user->bill;
                    $user->save();
//                    session(['matGr' => $request->get('matGr'),
//                        'readGr' => $request->get('readGr'),
//                        'historyKZ' => $request->get('historyKZ'),
//                        '1profPoint' => $request->get('1profPoint'),
//                        '2profPoint' => $request->get('2profPoint'),
//                        '1profSelect' => $request->get('1profSelect'),
//                        '2profSelect' => $request->get('2profSelect'),
//                    ]);
                    //$epay = EpayController::entResultPayment(CalculatorCost::all('calc_price')->first()->calc_price);
                }
                $L = $request->input('1profPoint') + $request->input('2profPoint') +
                    $request->input('matGr') + $request->input('readGr') + $request->input('historyKZ');
                $arrProf = [$request->input('1profSelect'), $request->input('2profSelect')];

                return redirect()->route('ent-show', ['score' => encrypt($L), 'profs1' => $arrProf[0], 'profs2' => $arrProf[1], 'map' => 'Главная , Калькулятор ЕНТ , Результаты']);
        }
        else {
            return redirect()->route('calculator-ent')->with('m1', 'Данная услуга доступна в личном кабинете')->with('active', 'ent-calc')->with('map', 'Главная , Калькулятор ЕНТ');
        }
    }
    public function showENTResult($L, $profs1, $profs2, $map){
        $L = decrypt($L);
        $arrProf = [$profs1, $profs2];
        $specs = Specialty::whereIn('subject_id', $arrProf)->whereIn('subject_id2', $arrProf)->with('cost')->get();
        $sHigh = [];
        $sMiddle = [];
        $sLow = [];
        $sPaid = [];
        foreach ($specs as $s) {
            $getCost = $s->cost;
            if ($getCost) {
                if ($L >= $getCost->passing_score) {
                    $sHigh[] = $s;
                } elseif ($L >= $getCost->passing_score - 5) {
                    $sMiddle[] = $s;
                } elseif ($L >= $getCost->passing_score - 13) {
                    $sLow[] = $s;
                } elseif ($L >= $getCost->paid_score) {
                    $sPaid[] = $s;
                }
            }
        }
        $sHigh = collect($sHigh);
        $sHigh = $sHigh->sortByDesc('cost.passing_score')->values();
        $sMiddle = collect($sMiddle);
        $sMiddle = $sMiddle->sortByDesc('cost.passing_score')->values();
        $sLow = collect($sLow);
        $sLow = $sLow->sortByDesc('cost.passing_score')->values();
        $sPaid = collect($sPaid);
        $sPaid = $sPaid->sortByDesc('cost.passing_score')->values();
        $sRes = [$sHigh, $sMiddle, $sLow, $sPaid];
        return view('ent-result', ['sRes' => $sRes, 'score' => $L, 'profs' =>$arrProf, 'map' => $map]);
    }
    public function entResult2($type, $entScore, $profs1, $profs2, $page = 0){
        $array = [];
        $title = '';
        $n = 0;
        $entScore = decrypt($entScore);
        $specs = Specialty::whereIn('subject_id', [$profs1, $profs2])->whereIn('subject_id2', [$profs1, $profs2])->with('cost')->get();
        switch ($type){
            case 1:
                foreach ($specs as $spec){
                    $getCost = $spec->cost;
                    if ($getCost) {
                        if ($entScore >= $getCost->passing_score) {
                            $array[] = $spec;
                            $n++;
                        }
                    }
                }
                $title = 'Шансы поступить на грант - Высокий ('.$n.')';
                break;
            case 2:
                foreach ($specs as $spec){
                    $getCost = $spec->cost;
                    if ($getCost) {
                        if ($entScore >= $getCost->passing_score - 5 && $entScore < $getCost->passing_score) {
                            $array[] = $spec;
                            $n++;
                        }
                    }
                }
                $title = 'Шансы поступить на грант - Средний ('.$n.')';
                break;
            case 3:
                foreach ($specs as $spec){
                    $getCost = $spec->cost;
                    if ($getCost) {
                        if ($entScore >= $getCost->passing_score - 13 && $entScore < $getCost->passing_score -5) {
                            $array[] = $spec;
                            $n++;
                        }
                    }
                }
                $title = 'Шансы поступить на грант - Низкий ('.$n.')';
                break;
            case 4:
                foreach ($specs as $spec){
                    $getCost = $spec->cost;
                    if ($getCost) {
                        if ($entScore >= $getCost->paid_score && $entScore < $getCost->passing_score-13) {
                            $array[] = $spec;
                            $n++;
                        }
                    }
                }
                $title = 'Шансы поступить на платное ('.$n.')';
                break;
            default:
                return redirect()->action('IndexController@index');
        }
        $array = collect($array);
        $array = $array->sortByDesc('cost.passing_score')->values();
        return view('ent-result2', compact('page', 'type', 'profs1', 'profs2'), ['score' => $entScore, 'title' => $title])->with('map', 'Главная , Калькулятор ЕНТ , Результаты , '.$title)->with('array', $array);
    }
    public  function multiRating($type, $id = 1){
        $class = $type;
        if ($type == 1){
            $map = 'Главная , Рейтинг , Рейтинг ВУЗов';
            $ratingName = 'Рейтинг ВУЗов - '.date("Y");
            if ($id){
                $map .= ' , '.Profile::find($id)->name;
                $us = University::whereIn('id', ProfileUniversity::where('profile_id', $id)->pluck('university_id')->toArray())->get();
                $class .= $id;
            }
        }
        elseif($type == 2) {
            $map = 'Главная , Рейтинг , Рейтинг колледжей';
            $ratingName = 'Рейтинг колледжей - '.date("Y");
            if ($id){
                $map .= ' , '.Profile::find($id)->name;
                $us = University::whereIn('id', ProfileUniversity::where('profile_id', $id)->pluck('university_id')->toArray())->get();
                $class .= $id;
            }
        }
       return view('rating.multiprofile-rating', compact('type', 'ratingName'))->with('map', $map)->with('class', $class)->with('us', $us)->with('active', 'rating');
    }
    public function viewCollegeFromList($id, $name){
        $university = University::find($id);
        if ($name == 'college'){
            $map = 'Главная , Навигатор , Список колледжей , '.$university->name_ru.' , О колледже';
        }
        else {
            $map = 'Главная , Навигатор , Список ВУЗов , '.$university->name_ru.' , О ВУЗе';
        }

        $partners = Parner::all();
        return view('college.college-view', compact('map', 'partners'))->with('university', $university)->with('class', 'view')->with('name', $name);
    }
    public function attributesCollegeFromList($id, $name, $nav){
        $university = University::find($id);
        if ($name == 'college'){
            $map = 'Главная , Навигатор , Список колледжей , '.$university->name_ru;
        }
        else {
            $map = 'Главная , Навигатор , Список ВУЗов , '.$university->name_ru;
        }
        switch ($nav){
            case 1:
                $header = 'ДОСТИЖЕНИЯ';
                $data = $university->achievements;
                $class = 'achieve';
                $map .= ' , Достижения';
                break;
            case 2:
                $header = 'СОТРУДНИЧЕСТВО';
                $data = $university->coop;
                $class = 'coop';
                $map .= ' , Сотрудничество';
                break;
            case 3:
                $header = 'РЕЙТИНГ';
                $data = $university->rating;
                $class = 'rating';
                $map .= ' , Рейтинг';
                break;
            case 4:
                $header = 'ДОКУМЕНТЫ ДЛЯ ПОСТУПЛЕНИЯ';
                $data = $university->docs_income;
                $class = 'docs';
                $map .= ' , Документы для поступления';
                break;
        }
        return view('college.college-attributes', compact('map', 'class', 'header', 'data', 'id'))->with('university', $university)->with('name', $name);
    }
    public function discountsCollegeFromList($id, $name){
        $university = University::find($id);
        if ($name == 'college'){
            $map = 'Главная , Навигатор , Список колледжей , '.$university->name_ru.' , Гранты/Скидки';
        }
        else {
            $map = 'Главная , Навигатор , Список ВУЗов , '.$university->name_ru.' , Гранты/Скидки';
        }
        return view('college.college-discounts', compact('map'))->with('university', $university)->with('class', 'discounts')->with('name', $name);
    }
    public function eduCollegeFromList($id, $name){
        $university = University::find($id);
        if ($name == 'college'){
            $map = 'Главная , Навигатор , Список колледжей , '.$university->name_ru.' , Образовательные программы';
        }
        else {
            $map = 'Главная , Навигатор , Список ВУЗов , '.$university->name_ru.' , Образовательные программы';
        }
        return view('college.college-edu', compact('map'))->with('university', $university)->with('class', 'edu')->with('name', $name);
    }
    public function contactsCollegeFromList($id, $name){
        $university = University::find($id);
        if ($name == 'college'){
            $map = 'Главная , Навигатор , Список колледжей , '.$university->name_ru.' , Контакты';
        }
        else {
            $map = 'Главная , Навигатор , Список ВУЗов , '.$university->name_ru.' , Контакты';
        }
        return view('college.college-contacts', compact('map'))->with('university', $university)->with('class', 'contacts')->with('name', $name);
    }
    public function showRegistrationForm(){
        $cs = City::all();
        return view('registration')->with('map', 'Главная , Регистрация')->with('cs', $cs);
    }
    public function changePassword(){
        return view('change-password')->with('map', 'Главная , Сменить пароль');
    }
    public function showCallback(){
        return view('callback')->with('map', 'Главная , Обратная связь');
    }
    public function  showForgotPasswd(){
        return view('forgot-passwd')->with('map', 'Главная , Забыли пароль');
    }
    public function successPayment($m, $sum){
        $user = User::find(Auth::id());
        $user->bill += $sum;
        $user->save();
        return redirect()->route('show-payment', $m);
    }
    public function failPayment($m){
        return redirect()->route('show-payment', $m);
    }
    public function showPayment($m){
        return redirect('/?message='.$m);
    }
}

