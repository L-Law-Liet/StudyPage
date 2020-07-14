<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\ListUn;
use App\Models\RankingSource;
use App\Models\Rating;
use App\Models\RatingCategory;
use Illuminate\Support\Facades\Input;

class ListController
{
    public function index(){

        $data = [];
        $rating = ListUn::orderBy('id', 'desc');
        $data['rating'] = $rating->paginate(20);
        $data['count'] = $data['rating']->total();
        $data['ranking'] = RankingSource::first();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.list.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['rating'] = null;
        if(!is_null($id)){
            $data['rating'] = ListUn::findOrFail($id);
        }
        return view('admin.list.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();

        if(is_null($id)){
            $validator = ListUn::validate($data);
            if(!$validator->fails()) { //Если проходит валидацю
                ListUn::create($data);
                return \redirect('admin/list')->with('success', 'Запись успешна сохранена');
            } else{
                return redirect()->back()->withInput()->withErrors(['errors' => $validator->errors()->all()]);
            }
        } else{
            ListUn::findOrFail($id)->update($data);
            return \redirect('admin/list')->with('success', 'Запись успешна сохранена');
        }
    }

    public function postSource($id = null){
        $data = Input::all();
        if(is_null($id)){
            RankingSource::create($data);
        } else{
            RankingSource::findOrFail($id)->update($data);
        }
        return redirect('admin/rating');
    }

    public function getView($id){

        $data['rating'] = ListUn::findOrFail($id);
        return view('admin.list.view', $data);
    }

    public function getDelete($id){

        $rating = ListUn::findOrFail($id);
        $rating->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/list?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/list')->with('errors', 'Запись успешна удалена');
        }
    }

}