<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class personalSponsor extends Authenticatable implements JWTSubject

{
    // here I deleted Extend Model  if get any error from relation later
    use HasFactory;
    use Notifiable;

    protected $fillable = ['first_name', 'sec_name', 'third_name', 'last_name', 'governorate_id', 'city_id'
        , 'neighborhood_id', 'nationality_id', 'country_id', 'details', 'phone_number', 'telephone', 'email'
        , 'identification_number', 'identification_number_type'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }

    public function message(){
        return [
            'city_id.required'=>'اختيار المدينة مطلوب',
            'country_id.required'=>'اختيار الدولة مطلوب',
            'details.required'=>'اضافة التفاصيل مطلوبة',
            'email.required'=>'اضافة الايميل مطلوب',
            'email.email'=>'كتابة الايميل بشكل صحيح',
            'first_name.required'=>'اضافة الاسم الاول مطلوب',
            'governorate_id.required'=>'اضافة اسم الحى مطلوب ',
            'identification_number.required'=>'اضافة رقم بطاقة التعريف مطلوب',
            'identification_number_type.required'=>'اختر نوع بطاقة التعريف',
            'last_name.required'=>'الاسم الاخير مطلوب ',
            'nationality_id.required'=>'مطلوب',
            'neighborhood_id.required'=>'مطلوب',
            'phone_number.required'=>'رقم الهاتف المحمول مطلوب',
            'sec_name.required'=>'اسم الاب مطلوب ',
            'third_name.required'=>'اسم الجد مطلوب',
            'telephone.required'=>'رقم الهاتف مطلوب'
        ];


    }


    public function validator(){
        return [
            'city_id'=>'required',
            'country_id'=>'required',
            'details'=>'required',
            'email'=>'required|email|max:255',
            'first_name'=>'required',
            'governorate_id'=>'required',
            'identification_number'=>'required',
            'identification_number_type'=>'required',
            'last_name'=>'required',
            'nationality_id'=>'required',
            'neighborhood_id'=>'required',
            'phone_number'=>'required',
            'sec_name'=>'required',
            'third_name'=>'required',
            'telephone'=>'required'
        ];
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
