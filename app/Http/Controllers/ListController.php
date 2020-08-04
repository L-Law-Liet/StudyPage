<?php

namespace App\Http\Controllers;

use App\Models\CostEducation;
use App\Models\ListUn;
use App\Models\Rating;
use App\Models\Subdirection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    public function index()
    {
//        setcookie("asd", 'OK', time()+3600000);
       // echo '1:'.$_COOKIE["asd"];
       // die;
//        $rating= Rating::where('category_id', $categoryId)->orderBy('overall_rating', 'DESC');
//        $data['rating'] = $rating->paginate(100);
//        $data['count'] = $data['rating']->total();
//        $data['ranking'] = RankingSource::first();
//        $data['categories'] = RatingCategory::pluck('name', 'id')->all();

//        $data = ListUn::all()->toArray();
        $rating = Rating::all();
        return view('list.index')->with('rating', $rating)->with('map', 'Главная , Рейтинг');
    }

    public function getFmain ($degree_id = 0, $direction_id = 0, $city_id = 0, $query = null) {
        $s = CostEducation::select(DB::raw('cost_education.*'));
        $s->join('specialties', 'specialties.id', '=', 'cost_education.specialty_id');
        $s->join('universities', 'universities.id', '=', 'cost_education.university_id');
        if ($degree_id != 0) {
            $ar['specialties'] = $s->where('specialties.degree_id', $degree_id);
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
                $L = 'Заочная';
            }
            $s = $s->where('education_form', $L);
        }
        $ar['specialties'] = $s->paginate(10000);
        $ar['count'] = $ar['specialties']->total();

        return number_format($ar['count'], 0, "", " ");
    }
}
