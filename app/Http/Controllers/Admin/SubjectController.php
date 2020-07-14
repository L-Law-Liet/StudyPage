<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.07.2018
 * Time: 18:09
 */

namespace App\Http\Controllers\Admin;


use App\Models\Subject;
use Illuminate\Support\Facades\Input;

class SubjectController
{
    public function index(){

        $data = [];
        $subjects = Subject::orderBy('id', 'desc');
        $data['subjects'] = $subjects->paginate(20);
        $data['count'] = $data['subjects']->total();
        if (isset($_GET['page'])) {
            setcookie("page", $_GET['page'], time()+3600);
        } else {
            setcookie("page", null);
        }
        return view('admin.subject.index', $data);
    }

    public function getAdd($id = null){
        $data = [];
        $data['id'] = $id;
        $data['subject'] = null;
        if(!is_null($id)){
            $data['subject'] = Subject::findOrFail($id);
        }
        return view('admin.subject.add', $data);
    }

    public function postAdd($id = null){
        $data = Input::all();
        if(is_null($id)){
            Subject::create($data);
        } else{
            Subject::findOrFail($id)->update($data);
        }

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/subject?page='.$_COOKIE['page'])->with('success', 'Запись успешна сохранена');
        } else {
            return \redirect('admin/subject')->with('success', 'Запись успешна сохранена');
        }
    }

    public function getView($id){

        $data['subject'] = Subject::findOrFail($id);
        return view('admin.subject.view', $data);
    }

    public function getDelete($id){

        $subject = Subject::findOrFail($id);
        $subject->delete();

        if (!empty($_COOKIE['page'])) {
            return \redirect('admin/subject?page='.$_COOKIE['page'])->with('errors', 'Запись успешна удалена');
        } else {
            return \redirect('admin/subject')->with('errors', 'Запись успешна удалена');
        }
    }

}