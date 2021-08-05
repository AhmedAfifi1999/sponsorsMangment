<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\enterpriseSponsor;
use App\Models\Governorate;
use App\Models\Nationality;
use App\Models\Neighborhood;
use App\Models\personalSponsor;
use Illuminate\Http\Request;

class SearchController extends Controller
{


    public function searchPersonalSponsor(Request $request)
    {

        /*   $governorates = Governorate::all();
           $cities = City::all();
           $countries = Country::all();
           $neighborhoods = Neighborhood::all();
           $nationalities = Nationality::all();
   */

        $sponsors = personalSponsor::with(['country', 'governorate', 'city', 'neighborhood'])->orderBy('created_at', 'desc');

        if (isset($request->city_id))
            $sponsors = $sponsors->where('city_id', $request->city_id);

        if (isset($request->country_id))
            $sponsors = $sponsors->where('country_id', $request->country_id);

        if (isset($request->governorate_id))
            $sponsors = $sponsors->where('governorate_id', $request->governorate_id);

        if (isset($request->nationality_id))
            $sponsors = $sponsors->where('nationality_id', $request->nationality_id);
//Accept name
        if (isset($request->name))
            $sponsors = $sponsors
                ->where('first_name', 'like', '%' . $request->name . '%')
                ->orWhere('sec_name', 'like', '%' . $request->name . '%')
                ->orWhere('third_name', 'like', '%' . $request->name . '%')
                ->orWhere('last_name', 'like', '%' . $request->name . '%');

        $sponsors = $sponsors->get();

        return response()->json([
            'status' => 1,
            'massage' => 'Search is Successfully',
            'data' => $sponsors
        ]);

    }

    public function searchEnterpriseSponsor(Request $request)
    {
        $enterpriseSponsors = enterpriseSponsor::with('country')->orderBy('created_at', 'desc');

        if (isset($request->contact_person))
            $enterpriseSponsors
                ->where('contact_person', 'like', '%' . $request->contact_person . '%');
        if (isset($request->address))
            $enterpriseSponsors
                ->where('address', 'like', '%' . $request->address . '%');
        if (isset($request->first_telephone))
            $enterpriseSponsors
                ->where('first_telephone', 'like', '%' . $request->first_telephone . '%');
        if (isset($request->sec_telephone))
            $enterpriseSponsors
                ->where('sec_telephone', 'like', '%' . $request->sec_telephone . '%');
        if (isset($request->email))
            $enterpriseSponsors
                ->where('email', 'like', '%' . $request->email . '%');
        if (isset($request->country_id))
            $enterpriseSponsors
                ->where('country_id', $request->country_id);
        if (isset($request->name))
            $enterpriseSponsors
                ->where('name', 'like', '%' . $request->name . '%');

        $enterpriseSponsors = $enterpriseSponsors->paginate(10);

        return response()->json([
            'status' => 1,
            'massage' => 'Search is Successfully',
            'data' => $enterpriseSponsors
        ]);


    }


}
