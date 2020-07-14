<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.07.2018
 * Time: 18:09
 */

namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Type;
use App\Models\University;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;

class UniversityController
{
    public function index(){

        $data = [];
        $universities = University::orderBy('id', 'desc');
        $data['universities'] = $universities->paginate(20);
        $data['count'] = $data['universities']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.university.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['cities'] = City::where('active', 1)->pluck('name_ru', 'id')->all();
        $data['types'] = Type::pluck('name_ru', 'id')->all();
        $data['university'] = null;
        if(!is_null($id)){
            $data['university'] = University::findOrFail($id);
        }
        return view('admin.university.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        $data['user_id'] = Auth::user()->id;
        if(is_null($id)){
            University::create($data);
        } else{
            University::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/university?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/university')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['university'] = University::findOrFail($id);
        $data['city'] = City::findOrFail($data['university']->city_id);
        return view('admin.university.view', $data);
    }

    public function getDelete($id){

        $university = University::findOrFail($id);
        $university->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/university?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/university')->with('errors', 'Запись успешна удалена');
        }
    }

}