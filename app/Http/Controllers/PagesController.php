<?php

namespace App\Http\Controllers;

use App\CalculatorCost;
use App\GrantsDiscounts;
use App\Models\City;
use App\Models\CostEducation;
use App\Models\Direction;
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

class PagesController extends Controller
{
    public function showCabinet(){
        $cities = City::all();
        return view('cabinet')->with('map', 'Главная , Кабинет')->with('cities', $cities);
    }

    public function showCollege($pages = 0){
        $specialities = Specialty::where('degree_id', 1)->get();
        $specIDs = array_column($specialities->toArray(), 'id');
        $costs = CostEducation::whereIn('specialty_id', $specIDs)->get();
        return view('college')->with('costs', $costs)->with('page', $pages)->with('active', 'college')->with('map', 'Главная , Колледж');
    }
    public function viewCollege($sid, $uid){
        $map = 'Главная , Колледж , Обзор';
        $u = University::find($uid);
        $speciality = Specialty::find($sid);
        $ar['requirement'] = Requirement::where('degree_id', 1)->first();
        $features = [ 'Квалификация' , 'Поступление в колледж', CostEducation::where('specialty_id', $sid)->where('university_id', $uid)->first()->income];
        if ($speciality->degree_id == 2){
            $map = 'Главная , Магистратура , Обзор';
            $ar['requirement'] = Requirement::where('degree_id', 2)->first();
            $features = [ 'Степень обучения' , 'Сфера направления', $speciality->relSphere->name_ru];
        }
        else if ($speciality->degree_id == 3){
            $map = 'Главная , Докторантура , Обзор';
            $ar['requirement'] = Requirement::where('degree_id', 3)->first();
            $features = [ 'Степень обучения' , 'Сфера направления', $speciality->relSphere->name_ru ];
        }
        else if(CostEducation::where('specialty_id', $sid)->where('university_id', $uid)->first()->income == 'После 9 класса'){
            $map = 'Главная , ВУЗ , Обзор';
            $features = [ 'Степень обучения' , 'Поступление в ВУЗ', CostEducation::where('specialty_id', $sid)->where('university_id', $uid)->first()->income, 'Профильный предмет', $speciality->relSubject->name_ru ];
        }
        else if (CostEducation::where('specialty_id', $sid)->where('university_id', $uid)->first()->income == 'После школы'){
            $features = [ 'Степень обучения' , 'Поступление в ВУЗ', CostEducation::where('specialty_id', $sid)->where('university_id', $uid)->first()->income, 'Профессиональные дисциплины', $speciality->relSubdirection->name_ru ];
            $map = 'Главная , Бакалавриат , Обзор';
        }
        if (str_contains(url()->previous(), '/college')) {
            $hrefTitle = 'college';
        }
        else {
            $hrefTitle = 'univer';
        }
        return view('view-college')->with('s', $speciality)->with('u', $u)->with('requirement', $ar['requirement'])->with('map', $map)->with('f', $features)->with('href', $hrefTitle);
    }
    public function viewUniver($id){
//        $u = University::find($id);

        $ar['requirement'] = Requirement::where('degree_id', 1)->first();
        return view('view-univer')->with('requirement', $ar['requirement'])->with('map', 'Главная , Университет , Обзор')/*->with('college', $u)*/;
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
//    public function showMagistr($pages = 0){
//        $specialities = Specialty::where('degree_id', 2)->get();
//        $specIDs = array_column($specialities->toArray(), 'id');
//        $costs = CostEducation::whereIn('specialty_id', $specIDs)->get();
//        return view('magistr')->with('costs', $costs)->with('page', $pages)->with('map', );
//    }
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
        $subdirectionIds = Subdirection::select('id')
            ->where('direction_id', $direction_id)->get()->toArray();
        $s = $s->whereHas('relSpecialty', function ($q) use ($subdirectionIds) {
            $q->whereIn('subdirection_id', $subdirectionIds);
        });
    }
    $S = $s->get();
    return $S;
}
    public function showDoctor($degree, $page, Request $request){
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
        $costs = PagesController::mainFilter($degree, $direction_id, $city_id, $query);
        $directions = Direction::all();
        $subDir = Subdirection::all();
        $sub = Subject::all();
        $sp = Sphere::all();
        $cs = City::all();
        $ts = Type::all();
        $us = University::all();
        $specs = Specialty::all();
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
        return view('doctor', ['dirs' => $directions, 'subDir' => $subDir, 'sub' => $sub, 'sp' => $sp, 'us' => $us, 'specs' => $specs,
            'ts' => $ts, 'cs' => $cs])->with('costs', $costs)->with('page', $page)->with('degree', $degree)
            ->with('query', $query)->with('dir_id', $request->get('direction_id'))->with('city_id', $request->get('city_id'))->with('map', $map);
    }


    public function showFAQSelectProfession(){
        return view('faq.select-prof')->with('active', 'select-prof')->with('map', 'Главная , Навигатор , Вопросы и ответы')->with('navActive', 1);
    }
    public function showFAQGoodUni(){
        return view('faq.good')->with('active', 'good')->with('map', 'Главная , Навигатор , Вопросы и ответы')->with('navActive', 1);
    }
    public function showFAQFutureProfession(){
        return view('faq.future')->with('active', 'future')->with('map', 'Главная , Навигатор , Вопросы и ответы')->with('navActive', 1);
    }
    public function showFAQOpenDoors(){
        return view('faq.open-door')->with('active', 'open-door')->with('map', 'Главная , Навигатор , Вопросы и ответы')->with('navActive', 1);
    }
    public function showFAQToCollege(){
        return view('faq.college')->with('active', 'college')->with('map', 'Главная , Навигатор , Вопросы и ответы')->with('navActive', 1);
    }
    public function showFAQToUni(){
        return view('faq.univer')->with('active', 'univer')->with('map', 'Главная , Навигатор , Вопросы и ответы')->with('navActive', 1);
    }
    public function showFAQEntCalc(){
        return view('faq.calc')->with('active', 'calc')->with('map', 'Главная , Навигатор , Вопросы и ответы')->with('navActive', 1);
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
        return view('ent-calculator', ['ss' => Subject::all()])->with('active', 'ent-calc')->with('map', 'Главная , Калькулятор ЕНТ')->with('error', $error);
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
//
//                    ]);
                    //$epay = EpayController::entResultPayment(CalculatorCost::all('calc_price')->first()->calc_price);
                }
                $L = $request->input('1profPoint') + $request->input('2profPoint') +
                    $request->input('matGr') + $request->input('readGr') + $request->input('historyKZ');
                $arrProf = [$request->input('1profSelect'), $request->input('2profSelect')];

                return redirect()->route('ent-show', ['score' => $L, 'profs1' => $arrProf[0], 'profs2' => $arrProf[1], 'map' => 'Главная , Калькулятор ЕНТ , Результаты']);
        }
        else {
            return redirect()->route('calculator-ent')->with('m1', 'Данная услуга доступна в личном кабинете')->with('active', 'ent-calc')->with('map', 'Главная , Калькулятор ЕНТ');
        }
    }
    public function showENTResult($L, $profs1, $profs2, $map){
        $arrProf = [$profs1, $profs2];
        $specs = Specialty::whereIn('subject_id', $arrProf)->whereIn('subject_id2', $arrProf)->get();
        $sHigh = [];
        $sMiddle = [];
        $sLow = [];
        $sPaid = [];
        foreach ($specs as $s) {
            if ($s->getCost()) {
                if ($L >= $s->getCost()->passing_score) {
                    $sHigh[] = $s;
                } elseif ($L >= $s->getCost()->passing_score - 5) {
                    $sMiddle[] = $s;
                } elseif ($L >= $s->getCost()->passing_score - 13) {
                    $sLow[] = $s;
                } elseif ($L >= $s->getCost()->paid_score) {
                    $sPaid[] = $s;
                }
            }
        }

        usort($sHigh, array('App\Http\Controllers\PagesController', 'L'));
        usort($sMiddle, array('App\Http\Controllers\PagesController', 'L'));
        usort($sLow, array('App\Http\Controllers\PagesController', 'L'));
        usort($sPaid, array('App\Http\Controllers\PagesController', 'L'));
        $sRes = [$sHigh, $sMiddle, $sLow, $sPaid];
        return view('ent-result', ['sRes' => $sRes, 'score' => $L, 'profs' =>$arrProf, 'map' => $map]);
    }
    public static function L($a, $b) {
        if($a->getCost()->passing_score == $b->getCost()->passing_score){ return 0 ; }
        return ($a->getCost()->passing_score > $b->getCost()->passing_score) ? -1 : 1;
    }
    public function entResult2($type, $entScore, $profs1, $profs2){
        $array = [];
        $title = '';
        $n = 0;
        $entScore = decrypt($entScore);
        $profs1 = decrypt($profs1);
        $profs2 = decrypt($profs2);
        $specs = Specialty::whereIn('subject_id', [$profs1, $profs2])->whereIn('subject_id2', [$profs1, $profs2])->get();
        switch ($type){
            case 1:
                foreach ($specs as $spec){
                    if ($spec->getCost()) {
                        if ($entScore >= $spec->getCost()->passing_score) {
                            $array[] = $spec;
                            $n++;
                        }
                    }
                }
                $title = 'Шансы поступить на грант - Высокий ('.$n.')';
                break;
            case 2:
                foreach ($specs as $spec){
                    if ($spec->getCost()) {
                        if ($entScore >= $spec->getCost()->passing_score - 5 && $entScore < $spec->getCost()->passing_score) {
                            $array[] = $spec;
                            $n++;
                        }
                    }
                }
                $title = 'Шансы поступить на грант - Средний ('.$n.')';
                break;
            case 3:
                foreach ($specs as $spec){
                    if ($spec->getCost()) {
                        if ($entScore >= $spec->getCost()->passing_score - 13 && $entScore < $spec->getCost()->passing_score -5) {
                            $array[] = $spec;
                            $n++;
                        }
                    }
                }
                $title = 'Шансы поступить на грант - Низкий ('.$n.')';
                break;
            case 4:
                foreach ($specs as $spec){
                    if ($spec->getCost()) {
                        if ($entScore >= $spec->getCost()->paid_score && $entScore < $spec->getCost()->passing_score-13) {
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
        usort($array, array('App\Http\Controllers\PagesController', 'L'));
        return view('ent-result2', ['score' => $entScore, 'title' => $title])->with('map', 'Главная , Калькулятор ЕНТ , Результаты')->with('array', $array);
    }
    public  function multiRating($type, $id = 0){
        $class = $type;
        if ($type == 1){
            $map = 'Главная , Рейтинг ВУЗов';
            $ratingName = 'Рейтинг ВУЗов - 2020';
            if ($id){
                $map .= ' , '.Profile::find($id)->name;
                $us = University::whereIn('id', ProfileUniversity::where('profile_id', $id)->pluck('university_id')->toArray())->get();
                $class .= $id;
            }
        }
        elseif($type == 2) {
            $map = 'Главная , Рейтинг Колледжей';
            $ratingName = 'Рейтинг Колледжей - 2020';
            if ($id){
                $map .= ' , '.Profile::find($id)->name;
                $us = University::whereIn('id', ProfileUniversity::where('profile_id', $id)->pluck('university_id')->toArray())->get();
                $class .= $id;
            }
        }
        if (!$id){
            $us = University::all();
        }
       return view('rating.multiprofile-rating', compact('type', 'ratingName'))->with('map', $map)->with('class', $class)->with('us', $us)->with('active', 'rating');
    }
    public function viewCollegeFromList($id, $name){
        $university = University::find($id);
        if ($name == 'college'){
            $nav = 'колледже';
        }
        else {
            $nav = 'ВУЗе';
        }
        return view('college.college-view')->with('university', $university)->with('class', 'view')->with('map', 'Главная , Навигатор , Список колледжей , О '.$nav)->with('name', $name);
    }
    public function achievementsCollegeFromList($id, $name){
        $university = University::find($id);
        return view('college.college-achieves')->with('university', $university)->with('class', 'achieve')->with('map', 'Главная , Навигатор , Список колледжей , Достижения')->with('name', $name);
    }
    public function coopCollegeFromList($id, $name){
        $university = University::find($id);
        return view('college.college-coop')->with('university', $university)->with('class', 'coop')->with('map', 'Главная , Навигатор , Список колледжей , Сотрудничество')->with('name', $name);
    }
    public function ratingCollegeFromList($id, $name){
        $university = University::find($id);
        return view('college.college-rating')->with('university', $university)->with('class', 'rating')->with('map', 'Главная , Навигатор , Список колледжей , Рейтинг')->with('name', $name);
    }
    public function discountsCollegeFromList($id, $name){
        $university = University::find($id);
        return view('college.college-discounts')->with('university', $university)->with('class', 'discounts')->with('map', 'Главная , Навигатор , Список колледжей , Гранты/Скидки')->with('name', $name);
    }
    public function eduCollegeFromList($id, $name){
        $university = University::find($id);
        return view('college.college-edu')->with('university', $university)->with('class', 'edu')->with('map', 'Главная , Навигатор , Список колледжей , Образовательные программы')->with('name', $name);
    }
    public function docsCollegeFromList($id, $name){
        $university = University::find($id);
        return view('college.college-docs')->with('university', $university)->with('class', 'docs')->with('map', 'Главная , Навигатор , Список колледжей , Документы для поступления')->with('name', $name);
    }
    public function contactsCollegeFromList($id, $name){
        $university = University::find($id);
        return view('college.college-contacts')->with('university', $university)->with('class', 'contacts')->with('map', 'Главная , Навигатор , Список колледжей , Контакты')->with('name', $name);
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
        return view('forgot-passwd')->with('map', 'Главная , Вход , Забыли пароль');
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

