<?php

namespace App\Http\Controllers;

use App\Models\AI;
use App\Models\modules;
use App\Models\Translate;
use App\Models\User;
use App\Models\Words;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TranslateController extends Controller
{
    public function index()
    {
        $data = modules::getUserModules();

        foreach ($data as $item) {
            $answer[] = [$item->id, $item->module];
        }


        return view('main.array_translation', compact('answer'));

    }

    public function translate(Request $request)
    {

        $text = $request->input('data');

        $answer = AI::request_to_AI($text, $request);


        if (Translate::validateDataFormat($answer)) {
            if ($request->input('select') == 3) {
                return view('main.show_text_translation', compact('answer'));
            }
            return view('main.show_translation', compact('answer'));
        } else {
            return view('main.error_translation', compact('answer'));

        }

    }

    public function save(Request $request)
    {
        $userId = Auth::id();
        $result = $request->input('data');

        $module_id = $request->session()->get('module_id');
        $module = $request->session()->get('module');

        foreach ($result as $item) {

            Words::create([
                'user_id' => $userId,
                'english' => $item[0],
                'translation' => $item[1],
                'modules_id' => $module_id
            ]);
        }

//        return redirect()->back()->with('success', 'Данные сохранены');
        return redirect()->route('show.module');

    }
}
