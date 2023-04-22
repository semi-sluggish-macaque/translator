<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Orhanerday\OpenAi\OpenAi;

class AI extends Model
{


    protected function request_to_AI($main_text, $request)
    {
        $userId = Auth::id();
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
//                $message = "Translate '$text' to $language Output the data exactly as in the example: text on english - translated text";
                $message = "Write translation of this '$text' to $language. ";

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

            if ($usage_config == 3) {
                $res[0][0] = $text;
                $res[0][1] = $answer;
                return $res;
            }

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

    protected function Maxim($data, $die = false)
    {

        echo '<pre>' . print_r($data, 1) . '</pre>';
        if ($die) {
            die;
        }
    }
}
