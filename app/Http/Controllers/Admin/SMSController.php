<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\personalSponsor;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SMSController extends Controller
{


    public function sendMassagePersonalSponsor(Request $request)
    {
        $msg = $request->msg;
        $name = $request->name;
        $client = new Client();
        if (isset($request->ids)) {
            //multi massage
            $ids = $request->ids;
            $ids = json_decode($ids, true);

            $phone_numbers = '';
            for ($x = 0; $x <= count($ids) - 1; $x++) {
                if ($x == count($ids) - 1) {

                    $phone = personalSponsor::select('phone_number')->where('id', $ids[$x])->get();
                    $phone_numbers .= $phone[0]->phone_number;
                } else {
                    $phone = personalSponsor::select('phone_number')->where('id', $ids[$x])->get();
                    $phone_numbers .= $phone[0]->phone_number . ',';
                }
            }
            $res = $client->get('https://www.nsms.ps/api.php?comm=sendsms&user=nepras-serv&pass=nepras-serv2020&to=' . $phone_numbers . '&message=' . $msg . '&sender=nepras.com');

        } else {

            $phone = personalSponsor::select('phone_number')->where('id', $request->id)->get();
            $msg = $request->msg;
            $name = $request->name;

            $client = new Client();
            $res = $client->get('https://www.nsms.ps/api.php?comm=sendsms&user=nepras-serv&pass="hide"&to=' . $phone[0]->phone_number . '&message=' . $msg . '&sender=nepras.com');
        }

        return response()->json($res->getStatusCode());

    }


    public function sendMassageForEnterpriseSponsor(Request $request)
    {

        //Enterprise Have not  A phone number  , Just  2 telephones

    }
}
