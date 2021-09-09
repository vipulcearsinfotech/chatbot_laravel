<?php

namespace App\Http\Controllers;

use App\Models\question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Request $request)
    {
        $question = new Question();
        $optionPattern = explode(",", $request->options);
        $question->intent_id = $request->intent_id;
        $question->sortid = $request->sortid;
        $question->question = $request->question;
        $question->datatype = $request->datatype;
        $question->options = json_encode($optionPattern);

        $question->save();
        return redirect("/");
    }


    public function show(Request $request)
    {
        $result = Question::where('intent_id', $request->id)->get();
        foreach ($result as $item) {
            $list = json_decode($item->options);
            $item->options = $list;
        }
        return [
            "data" => $result,
        ];
    }
}
