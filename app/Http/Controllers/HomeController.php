<?php

namespace App\Http\Controllers;

use App\Models\modules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Orhanerday\OpenAi\OpenAi;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Facades\Storage;
use App\Models\Words;


class HomeController extends Controller
{

    public function index(Request $request)
    {

        if (Auth::check()) {
            $userId = Auth::id();
            $data = modules::select('id', 'module')->where('user_id', $userId)->get();
            foreach ($data as $item) {
                $answer[] = [$item->id, $item->module];
            }
        } else {
            return redirect()->route('login.create');
        }


//        return view('main.plain_scan', compact('answer'));
        return view('main.array_translation', compact('answer'));

    }


    public function storePicture(Request $request)
    {

        $text = $request->input('data');

        $answer = self::request_to_AI($text, $request);

        if (self::validateDataFormat($answer)) {
            return view('translate', compact('answer'));
        } else {
            return view('errort', compact('answer'));

        }

    }

    public function storePlain(Request $request)
    {

        $text = $request->input('text');

        $answer = self::request_to_AI($text, $request);


        if (self:: validateDataFormat($answer)) {
            return view('translate', compact('answer'));
        } else {
            return view('errort', compact('answer'));

        }

    }

    public function scan(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();
        }
        $data = modules::select('id', 'module')->where('user_id', $userId)->get();
        foreach ($data as $item) {
            $modules[] = [$item->id, $item->module];
        }
        $answer = self::scan_picture($request);
        return view('scaner', compact('answer', 'modules'));
    }

    public function show(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();
        }
        $module_id = $request->input('selectModule');
        $module = modules::select('module')->where('user_id', $userId)->where('id', $module_id)->value('module');
        $request->session()->flash('module_id', $module_id);
        $request->session()->flash('module', $module);
        $answer = [];
        $data = Words::select('english', 'translation')
            ->where('user_id', 1)
            ->where('module_id', 1)
            ->get();
//        $data = Words::select('english', 'translation')
//            ->where('user_id', $userId)
//            ->where('module_id', $module_id)
//            ->get();

        foreach ($data as $item) {
            $answer[] = [$item->english, $item->translation];
        }

        return view('main.show_words', compact('answer'));
    }

    public function clear()
    {
        Words::truncate();
        return redirect()->route('home');

    }

    public function createModule(Request $request)
    {
        $text = $request->input('text');

        if (Auth::check()) {
            $userId = Auth::id();
        }
        $request->validate([
            'text' => 'required|unique:modules,module',
        ]);

        modules::create([
            'module' => $text,
            'user_id' => $userId,
        ]);

        $request->session()->flash('success', 'модуль создан!');

        return redirect()->route('home');

    }

    public function save(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();
        }
        $result = $request->input('data');
        $module_id = $request->session()->get('module_id');
        $module = $request->session()->get('module');

        foreach ($result as $item) {

            Words::create([
                'user_id' => $userId,
                'english' => $item[0] == true ? $item[0] : 'ERROR',
                'translation' => $item[1] == true ? $item[1] : 'ERROR',
                'module_id' => $module_id
            ]);
        }

        return redirect()->route('home');

    }

    public function cards(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();
        }
        $module_id = $request->input('selectModule');
        $module = modules::select('module')->where('user_id', $userId)->where('id', $module_id)->value('module');
        $request->session()->flash('module_id', $module_id);
        $request->session()->flash('module', $module);
        $answer = [];
        $data = Words::select('english', 'translation')
            ->where('user_id', 1)
            ->where('module_id', 1)
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

    protected function request_to_AI($main_text, $request)
    {

        if (Auth::check()) {
            $userId = Auth::id();
        }
        $arr = explode('sep', $main_text);
        $language = $request->input('select2');
        $usage_config = $request->input('select');
        $module_id = $request->input('selectModule');
        $module = modules::select('module')->where('user_id', $userId)->where('id', $module_id)->value('module');
        Session::put('module_id', $module_id);
        Session::put('module', $module);


        $main_result = [];
        foreach ($arr as $text) {


            $message = "Write translation of these words '$text' to $language and usage case with translation to $language to each word. Here is example, how you should output data: Gay - гей. Vasya is gay - Вася гей. ";

            if ($usage_config == 2) {
                $message = "Write translation of these words '$text' to $language  to each word. Output the data exactly as in the example: 'Gay - гей.' , after each translation put '.' ";

            }
            if ($usage_config == 1) {
                $message = "Write translation of these words '$text' to $language and usage case with translation to $language to each word. Output the data exactly as in the example: Gay - гей. Vasya is gay - Вася гей. ";

            }
            if ($usage_config == 3) {
                $message = "Translate '$text' to $language";

            }


            $open_ai_key = env('OPEN_AI_KEY');

            $open_ai = new OpenAi($open_ai_key);


            $complete = $open_ai->chat([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        "role" => "system",
                        "content" => "$message"
                    ],
                ],
                'temperature' => 1.0,
                'max_tokens' => 3000,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
            ]);

            $data = json_decode($complete);


            $answer = $data->choices[0]->message->content;

            $parts = preg_split('/\.\s*/', $answer);

            $parts = array_map('trim', $parts);

            $parts = array_filter($parts);

            $result = [];

            foreach ($parts as $part) {
                // Разделение элемента на две части с использованием дефиса
                $split_part = explode(' - ', $part);

                // Добавление разделенных частей в результат
                $result[] = $split_part;

            }

            $main_result = array_merge($main_result, $result);
        }
        return $main_result;
    }

    protected function scan_picture($request)
    {
        $file = $request->file('file');
        $storedFileName = $request->file('file')->store("public/images");
        $fileName = basename($storedFileName);
        $filePath = "public/images/$fileName";
        $absolutePath = Storage::path($filePath);
        $tesseract = new TesseractOCR($absolutePath);
        $tesseract->executable('C:\Program Files\Tesseract-OCR\tesseract.exe');
        $answer = $tesseract->run();
        return $answer;
    }

    protected function Maxim($data, $die = false)
    {

        echo '<pre>' . print_r($data, 1) . '</pre>';
        if ($die) {
            die;
        }
    }

    protected function validateDataFormat($data)
    {
        // Проверка на то, что данные являются массивом
        if (!is_array($data)) {
            return false;
        }

        // Проход по всем элементам массива
        foreach ($data as $item) {
            // Проверка на то, что элемент является массивом с двумя элементами
            if (!is_array($item) || count($item) !== 2) {
                return false;
            }

            // Проверка на то, что оба значения внутри элемента являются строками
            if (!is_string($item[0]) || !is_string($item[1])) {
                return false;
            }
        }

        // Если все условия выполняются, данные имеют правильный формат
        return true;
    }


}
