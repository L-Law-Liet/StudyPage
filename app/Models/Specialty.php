<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialties';
    protected $fillable = ['cipher', 'name_ru', 'name_kz', 'subdirection_id', 'subject_id', 'subject_id2', 'degree_id', 'education_time', 'sphere_id'];

    public static function filter($specialties, $data){
        foreach ($data as $k => $v) {
            if($v === null || $v === '' || $k === 'page')
                continue;

            $specialties->where($k, 'LIKE', "%".trim($v)."%");
        }
        return $specialties;
    }

    public function relSubdirection(){
        return $this->belongsTo(Subdirection::class, 'subdirection_id', 'id');
    }
    public function relSubject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
    public function relSubject2(){
        return $this->belongsTo(Subject::class, 'subject_id2', 'id');
    }
    public function relDegree(){
        return $this->belongsTo(Degree::class, 'degree_id', 'id');
    }
    public function relSphere(){
        return $this->belongsTo(Sphere::class, 'sphere_id', 'id');
    }

    public function specialisties () {
        return $this->hasMany('App\CostEducation');
    }
    public function getCost(){
        return CostEducation::where('specialty_id', $this->id)->first();
    }
}
