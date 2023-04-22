<?php

namespace App\Http\Controllers;

use App\Models\modules;
use App\Models\User;
use App\Models\Words;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WordsController extends Controller
{

    public function show($module_id)
    {
        $userId = Auth::id();

        $module = modules::getUserModule($module_id);

        Session::put('module_id', $module_id);
        Session::put('module', $module[0]->module);

        $answer = [];

        $data = Words::select('english', 'translation', 'id')
            ->where('user_id', $userId)
            ->where('modules_id', $module_id)
            ->get();

        foreach ($data as $item) {
            $answer[] = [$item->english, $item->translation, $item->id];
        }
        return view('main.show_words', compact('answer', 'module'));
    }

    public function save(Request $request)
    {
        $userId = Auth::id();
        $result = $request->input('data');
        $module_id = $request->session()->get('module_id');
        $module = $request->session()->get('module');


        foreach ($result as $item) {

            if (!isset($item[0])) {
                Words::where('id', $item[2])->delete();
                continue;
            }

            Words::updateOrCreate(
                ['id' => $item[2]],
                [
                    'user_id' => $userId,
                    'english' => $item[0],
                    'translation' => $item[1],
                    'modules_id' => $module_id
                ]
            );


        }

        return redirect()->back()->with('success', 'Данные сохранены');

    }

    public function learn($id)
    {
//        $module_id = $id;
//        $module = modules::getUserModule($id);
        $answer = [];
        $data = Words::select('english', 'translation')
            ->where('user_id', Auth::id())
            ->where('modules_id', $id)
            ->get();

//        $data = Words::select('english', 'translation')
//            ->where('user_id', $userId)
//            ->where('module_id', $module_id)
//            ->get();

        foreach ($data as $item) {
            $answer[] = [$item->english, $item->translation];
        }
        $data = $answer;
        return view('main.learn_words', compact('data'));
    }

}
