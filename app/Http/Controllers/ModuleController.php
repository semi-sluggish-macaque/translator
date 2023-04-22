<?php

namespace App\Http\Controllers;

use App\Models\modules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function show()
    {
        $userId = Auth::id();

        $data = modules::withCount('words')->where('user_id', $userId)->get();
        foreach ($data as $item) {
            $modules[] = [$item->id, $item->module];
        }
        return view('main.create_module', compact('data'));
    }

    public
    function createModule(Request $request)
    {
        $text = $request->input('text');

        $userId = Auth::id();

        $request->validate([
            'text' => 'required|unique:modules,module',
        ]);

        modules::create([
            'module' => $text,
            'user_id' => $userId,
        ]);

        $request->session()->flash('success', 'модуль создан!');

        return redirect()->route('show.module');;
    }
}
