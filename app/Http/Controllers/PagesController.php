<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use App\Models\University;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function showCabinet(){
        return view('cabinet')->with('map', 'Главная , Кабинет');
    }
    public function showCollege(){
        return view('college')->with('active', 'college')->with('map', 'Главная , Колледж');
    }
    public function viewCollege($id){
//        $u = University::find($id);

        $ar['requirement'] = Requirement::where('degree_id', 1)->first();
        return view('view-college')->with('active', 'college')->with('requirement', $ar['requirement'])->with('map', 'Главная , Колледж , Обзор')/*->with('college', $u)*/;
    }
    public function showUniversityAfterSchool(){
        return view('university-school')->with('active', 'university')->with('map', 'Главная , ВУЗ');
    }
    public function showUniversityAfterCollege(){
        return view('university-college')->with('active', 'university')->with('map', 'Главная , ВУЗ');
    }
    public function showFAQ(){
        return view('faq')->with('map', 'Главная , Вопросы и ответы');
    }
    public function collegeList(){
        return view('college-list')->with('map', 'Главная , Навигатор , Список колледжей');
    }
    public function univerList(){
        return view('univer-list')->with('map', 'Главная , Навигатор , Список ВУЗов');
    }
    public function partnerList(){
        return view('partner-list')->with('map', 'Главная , Навигатор , Партнеры');
    }
    public function entCalculator(){
        return view('ent-calculator')->with('active', 'ent-calc')->with('map', 'Главная , ЕНТ Калькулятор');
    }
    public function entResult(){
        return view('ent-result')->with('map', 'Главная , Навигатор , ЕНТ Калькулятор , Результаты');
    }
    public function entResult2(){
        return view('ent-result2')->with('map', 'Главная , Навигатор , ЕНТ Калькулятор , Результаты');
    }
    public function viewCollegeFromList(){
        return view('college.college-view')->with('class', 'view')->with('map', 'Главная , Навигатор , Список колледжей , О колледже');
    }
    public function achievementsCollegeFromList(){
        return view('college.college-achieves')->with('class', 'achieve')->with('map', 'Главная , Навигатор , Список колледжей , Достижения');
    }
    public function coopCollegeFromList(){
        return view('college.college-coop')->with('class', 'coop')->with('map', 'Главная , Навигатор , Список колледжей , Сотрудничество');
    }
    public function ratingCollegeFromList(){
        return view('college.college-rating')->with('class', 'rating')->with('map', 'Главная , Навигатор , Список колледжей , Рейтинг');
    }
    public function discountsCollegeFromList(){
        return view('college.college-discounts')->with('class', 'discounts')->with('map', 'Главная , Навигатор , Список колледжей , Гранты/Скидки');
    }
    public function eduCollegeFromList(){
        return view('college.college-edu')->with('class', 'edu')->with('map', 'Главная , Навигатор , Список колледжей , Образовательные программы');
    }
    public function docsCollegeFromList(){
        return view('college.college-docs')->with('class', 'docs')->with('map', 'Главная , Навигатор , Список колледжей , Документы для поступления');
    }
    public function contactsCollegeFromList(){
        return view('college.college-contacts')->with('class', 'contacts')->with('map', 'Главная , Навигатор , Список колледжей , Контакты');
    }
    public function showRegistrationForm(){
        return view('registration')->with('map', 'Главная , Регистрация');
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
}
