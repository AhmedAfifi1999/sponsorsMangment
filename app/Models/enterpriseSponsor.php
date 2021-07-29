<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enterpriseSponsor extends Model
{
    use HasFactory;
    protected $fillable=['name','contact_person','address','first_telephone','country_id','sec_telephone','email'];


    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function validator(){
        return [
            'name'=>'required',
            'contact_person'=>'required',
            'address'=>'required',
            'first_telephone'=>'required',
            'sec_telephone'=>'required',
            'email'=>'required|email|max:255',
            'country_id'=>'required',

        ];
    }
    public function message(){
        return [
            'name.required'=>'اسم الشركة مطلوب',
            'country_id.required'=>'دولة الاقامة مطلوبة',
            'contact_person.required'=>'اسم مسؤول الاتصالات مطلوب',
            'address.required'=>'العنوان مطلوب',
            'first_telephone.required'=>'رقم الهاتف 1 مطلوب',
            'sec_telephone.required'=>'رقم الهاتف 2 مطلوب',
            'email.required'=>'الايميل مطلوب',
            'email.email'=>'الرجاء كتابة الايميل بشكل صحيح',
        ];
    }



}
