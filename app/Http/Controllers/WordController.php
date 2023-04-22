<?php

namespace App\Http\Controllers;


use App\Models\Words;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class WordController extends Controller
{
    public function download_doc(Request $request)
    {

        {
            $module_id = $request->session()->get('module_id');
            $module = $request->session()->get('module');
            $data = $request->input('data');

            $phpWord = new PhpWord();

            $section = $phpWord->addSection();
            if (is_array($data)) {
                foreach ($data as $item) {
//                    $section->addText($item->english . ' - ' . $item->translation);
                    $section->addText($item[0] . ' - ' . $item[1]);
                }
            } else {
                $data = htmlspecialchars_decode(str_replace('&#13;&#10;', PHP_EOL, $data));
                $lines = explode(PHP_EOL, $data);
                foreach ($lines as $line) {
                    $section->addText($line);
                }
            }

            if (!$module) {
                $module = 'name';
            }

            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save(storage_path("app/myfolder/$module.doc"));
            $headers = [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ];
            return response()->download(storage_path("app/myfolder/$module.doc"), "$module.doc", $headers);
        }

    }

    protected
    function Maxim($data, $die = false)
    {

        echo '<pre>' . print_r($data, 1) . '</pre>';
        if ($die) {
            die;
        }
    }

}
