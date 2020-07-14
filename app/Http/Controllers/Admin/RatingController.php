<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\RankingSource;
use App\Models\Rating;
use App\Models\RatingCategory;
use Illuminate\Support\Facades\Input;

class RatingController
{
    public function index(){

        $data = [];
        $rating = Rating::orderBy('id', 'desc');
        $data['rating'] = $rating->paginate(20);
        $data['count'] = $data['rating']->total();
        $data['ranking'] = RankingSource::first();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.rating.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['rating'] = null;
        $data['cities'] = City::where('active', 1)->pluck('name_ru', 'id')->all();
        $data['categories'] = RatingCategory::pluck('name', 'id')->all();
        if(!is_null($id)){
            $data['rating'] = Rating::findOrFail($id);
        }
        return view('admin.rating.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($data['university_id']) || empty($data['university_id'])){
            return redirect()->back()->withInput()->withErrors(['errors' => 'Выберите университет']);
        }
        if(is_null($id)){
            $validator = Rating::validate($data);
            if(!$validator->fails()) { //Если проходит валидацю
                Rating::create($data);
                return \redirect('admin/rating')->with('success', 'Запись успешна сохранена');
            } else{
                return redirect()->back()->withInput()->withErrors(['errors' => $validator->errors()->all()]);
            }
        } else{
            Rating::findOrFail($id)->update($data);
            return \redirect('admin/rating')->with('success', 'Запись успешна сохранена');
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

        $data['rating'] = Rating::findOrFail($id);
        return view('admin.rating.view', $data);
    }

    public function getDelete($id){

        $rating = Rating::findOrFail($id);
        $rating->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/rating?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/rating')->with('errors', 'Запись успешна удалена');
        }
    }

}