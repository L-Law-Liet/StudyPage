<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.07.2018
 * Time: 18:09
 */

namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\ListUn;
use App\Models\RankingSource;
use App\Models\Type;
use App\Models\University;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;

class CollegeController
{
    public function index(){

        $data = [];
        $universities = University::where('hasCollege', 1)->orderBy('id', 'desc');
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
            $data['hasCollege'] = 1;
            University::create($data);
        } else{
            University::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/college?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/college')->with('success', 'Запись успешна сохранена');
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
            return \redirect('admin/college?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/college')->with('errors', 'Запись успешна удалена');
        }
    }
    public function list(){

        $data = [];
        $universities = University::where('hasCollege', 1)->where('description', '<>', null)->orderBy('id', 'desc');
        $data['universities'] = $universities->paginate(20);
        $data['count'] = $data['universities']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.list.index', $data);
    }
    public function getPageView($id){
        $university = University::find($id);
        return view('admin.list.view', compact('university'));
    }

    public function getPageAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['university'] = null;
        if(!is_null($id)){
            $data['university'] = University::findOrFail($id);
        }
        return view('admin.list.add', $data);
    }

    public function postPageAdd($id = null){
        $data = Input::all();
        $data['user_id'] = Auth::user()->id;
        $u = University::findOrFail($id??$data['id']);
        $u->description = $data['description'];
        $u->short_description = $data['short_description'];
        $u->achievements = $data['achievements'];
        $u->coop = $data['coop'];
        $u->rating = $data['rating'];
        $u->grants = $data['grants'];
        $u->learn_program = $data['learn_program'];
        $u->docs_income = $data['docs_income'];
        $u->user_id = $data['user_id'];
        $u->save();
        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/list/college?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/list/college')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getPageDelete($id){

        $university = University::findOrFail($id);
        $university->description = null;
        $university->achievements = null;
        $university->short_description = null;
        $university->coop = null;
        $university->rating = null;
        $university->docs_income = null;
        $university->learn_program = null;
        $university->grants = null;
        $university->save();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/list/college?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/list/college')->with('errors', 'Запись успешна удалена');
        }
    }
}
