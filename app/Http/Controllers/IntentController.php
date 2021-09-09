<?php

namespace App\Http\Controllers;

use App\Models\Intent;
use App\Models\question;
use Illuminate\Http\Request;

class IntentController extends Controller
{

    public function index()
    {
        // get all data
        $result = [];
        $intent = Intent::all();
        $question = [];

        foreach ($intent as $item) {
            $temp = Question::where("intent_id", $item->id)->get();

            $obj = array(
                "id" => $item->id,
                "name" => $item->intentname,
                "data" => $temp,
            );

            array_push($result, $obj);
        }

        //  return $result;
        return view("/form")->with('result', $result);
    }


    public function create(Request $request)
    {
        $intent = new Intent();
        $userPattern = explode(",", $request->userPattern);

        $intent->userPattern = json_encode($userPattern);
        $intent->intentname = $request->intentname;
        $intent->save();

        return redirect("/");
    }

    public function export()
    {
        $intent = Intent::all();

        // break string into list of string
        foreach ($intent as  $item) {
            $list = json_decode($item->userPattern);
            $item->userPattern = $list;
        }
        return [
            "data" => $intent,
        ];
    }
}
