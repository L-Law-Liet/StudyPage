<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\Article;
use App\Models\Callback;
use App\Models\City;
use App\Models\CostEducation;
use App\Models\Degree;
use App\Models\Direction;
use App\Models\Faq;
use App\Models\Navigator;
use App\Models\Parner;
use App\Models\Proposal;
use App\Models\Social;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;


class IndexController extends Controller
{
    public function index(Request $request)
    {
        $message = $request->get('message');
        if (preg_replace('#[^/]*$#', '', session()->get('refPay')) == preg_replace('#[^/]*$#', '', url()->current())){
            $message = null;
        }
        if (!session()->get('refPay')){
            session(['refPay' => url()->current()]);
            session()->save();
        }
        setcookie("asd", 'OK', time()+360000);
       // echo '1:'.$_COOKIE["asd"];
       // die;
        $data = [];
        $data['degrees'] = Degree::select('name_ru', 'url', 'id')->get();
        $data['directions'] = Direction::select('name_ru', 'url', 'id')->orderBy('id', 'DESC')->get();
        $data['cities'] = City::where('active', 1)->orderBy('name_ru')->select('name_ru', 'url', 'id')->get();
        $data['faq'] = Faq::skip(0)->take(6)->get();
        $data['cityslider'] = City::where('active', 1)->get();
        $data['partners'] = Parner::all();
        $data['cost_count'] = CostEducation::get()->count();
        $data['message'] = $message;
        return view('index', $data)->with('map', 'Главная');
    }


    public function getCity($id = 0){
        if (!$id){
            $id = City::where('active', 1)->orderBy('name_ru')->pluck('id')->first();
        }
        $data['city'] = City::findOrFail($id);
        $data['cities'] = City::where('active', 1)->orderBy('name_ru')->pluck('name_ru', 'id')->all();

        return view('city.view', $data)->with('map', 'Главная , ВУЗы в городах Казахстана , '.$data['city']->name_ru);
    }

    public function getNavigator($id){

        $data['city'] = Navigator::findOrFail($id);
        $data['cities'] = Navigator::where('active', 1)->orderBy('id', 'desc')->pluck('name_ru', 'id')->all();
        return view('navigator.view', $data);
    }
    public function getNavigator1(){

        $data['city'] = Navigator::orderBy('id', 'desc')->first();
        $data['cities'] = Navigator::where('active', 1)->orderBy('id', 'desc')->pluck('name_ru', 'id')->all();
        return redirect('/navigator/view/'.$data['city']['id']);
    }
    public function getArticle($id){

        $data['article'] = Article::findOrFail($id);
        if ($id == 1){
            $map = 'Добавить колледж/ВУЗ';
        }
        else if ($id == 2) {
            $map = 'О сайте';
        }
        else if ($id == 3) {
            $map = 'Рекламодателям';
        }
        else if ($id == 4) {
            $map = 'Пользовательское соглашение';
        }
        else if ($id == 6) {
            $map = 'Политика конфедициальности';
        }
        else {
            $map = 'Колледжам/ВУЗам';
        }
        return view('article', $data)->with('map', 'Главная , '.$map);
    }

    public function getTest(){


        return view('article');
    }

    public function getCallback(){

        return view('callback')->with('map', 'Главная , Обратная связь');
    }

    public function postCallback(){

        $l =
        $data = Input::all();
        $validator = Callback::validate($data);
        if(!$validator->fails()) { //Если проходит валидацю
            Callback::create($data);
            $mail = Social::findOrFail(8);
            $to_name = 'StudyPage';
            $to_email = $mail->link;
            $data = array('name'=>$data['name'], 'phone' => $data['phone'], 'email' => $data['email'], 'question' => $data['question']);
            Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
                $message->from('info.studypage@gmail.com', 'StudyPage')->to($to_email, $to_name)->subject('Обратная связь с сайта Studypage.net');
            });


            return redirect('callback')->with('success', 'Спасибо за обращение, Ваше письмо принято, мы скоро вам ответим');
        } else{
            return redirect('callback')->withInput()->withErrors(['errors' => $validator->errors()->all()]);
        }
    }

    public function postProposal(){

        $data = Input::all();
        $validator = Proposal::validate($data);
        if(!$validator->fails()) { //Если проходит валидацю
            Proposal::create($data);

            $mail = Social::findOrFail(8);
            $to_name = 'StudPage';
            $to_email = $mail->link;
            $data = array('contact_name'=>$data['contact_name'], 'university_name' => $data['university_name'], 'contact_phone' => $data['contact_phone'], 'email2' => $data['email']);
            Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Обратная связь с сайта Studypage.net');
                $message->from('info.studypage@gmail.com', 'StudyPage');
            });

            return redirect()->back()->with('success', 'Спасибо за обращение, Ваше письмо принято, мы скоро вам ответим');
        } else{
            $L = $validator->errors()->all();
//            dd($L['0']);
            return redirect()->back()->withInput()->withErrors(['errors' => $validator->errors()->all()]);
        }
    }
    public function resetPassword(ForgotPasswordRequest $request){
        $user = User::where('email', $request->get('email'))->first();

        if ($user){
            $to_name = $user->name.' '.$user->surname;
            $to_email = $user->email;
            $password = str_random(8);
            $user->password = Hash::make($password);
            $user->save();
            Mail::send('emails.forgot', ['email' => $user->email, 'password' => $password], function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Восстановление пароля с сайта Studypage.net');
                $message->from('info.studypage@gmail.com', 'StudyPage');
            });
            return redirect()->back()->with('success', 'На указанную электтронную почту было отправлено письмо. Перейдите по ссылке указанный в письме.');
        }
        else {
            session(['forgot' => true]);
            return redirect()->back()->withErrors('Такого пользователя не существует.');
        }
    }
}
