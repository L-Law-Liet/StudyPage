<?php

namespace App\Http\Controllers;

use App\Models\CostEducation;
use App\Models\ListUn;
use App\Models\Subdirection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    public function index()
    {
        setcookie("asd", 'OK', time()+3600000);
       // echo '1:'.$_COOKIE["asd"];
       // die;
        /*$rating= Rating::where('category_id', $categoryId)->orderBy('overall_rating', 'DESC');
        $data['rating'] = $rating->paginate(100);
        $data['count'] = $data['rating']->total();
        $data['ranking'] = RankingSource::first();
        //$data['categories'] = RatingCategory::pluck('name', 'id')->all();*/

        $data = ListUn::all()->toArray();
        return view('list.index', ['data' => $data])->with('map', 'Главная , Рейтинг');
    }

    public function getFmain ($degree_id = 0, $direction_id = 0, $city_id = 0, $query = null) {


        $s = CostEducation::select(DB::raw('cost_education.*'));
        $s->join('specialties', 'specialties.id', '=', 'cost_education.specialty_id');
        $s->join('universities', 'universities.id', '=', 'cost_education.university_id');

        if ($degree_id != 0) {
            $ar['specialties'] = $s->where('degree_id', $degree_id);
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

        $ar['specialties'] = $s->paginate(10000);
        $ar['count'] = $ar['specialties']->total();

        return $ar['count'];
    }
}
