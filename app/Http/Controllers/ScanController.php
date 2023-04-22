<?php

namespace App\Http\Controllers;

use App\Models\modules;
use App\Models\Scan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;

class ScanController extends Controller
{
    public function index()
    {


        $data = modules::getUserModules();

        foreach ($data as $item) {
            $answer[] = [$item->id, $item->module];
        }


        return view('main.translate_scan', compact('answer'));

    }

    public function scan(Request $request)
    {
        $data = modules::getUserModules();
        foreach ($data as $item) {
            $modules[] = [$item->id, $item->module];
        }
        $answer = Scan::scan_picture($request);

        $data_formatted = str_replace(["\r\n", "\n", "\r"], '&#13;&#10;', htmlspecialchars(print_r($answer, 1)));
        return view('main.translate_scan_result', compact('data_formatted', 'modules'));
    }

//    public function upload(Request $request)
//    {
//
//
//        $request->validate([
//            'image' => 'required|image|max:2048', // Валидация: обязательный, тип изображение, максимальный размер 2 МБ
//        ]);
//
//
//        $image = $request->file('image');
//
//
////        $storedFileName = $request->file('image')->store("public/images");
//
//
//        $imageName = time() . '_' . $image->getClientOriginalName();
//
//        $path = $image->storeAs('public/images', $imageName); // Сохранение изображения в папке 'public/images'
//
//        return redirect()->home();
//        return response()->json([
//            'message' => 'Image uploaded successfully',
//            'image_name' => $imageName,
//            'path' => $path,
//        ]);
//    }


    public function upload(Request $request)
    {
        $request->validate([
            'pastedImage' => 'required|string',
        ]);

        $imageData = $request->input('pastedImage');

        // Удалить начальную часть строки "data:image/png;base64,"
        $imageData = substr($imageData, strpos($imageData, ",") + 1);

        // Преобразовать base64-строку в изображение
        $decodedImageData = base64_decode($imageData);

        // Сохранение изображения во временный файл
        $tempImage = tmpfile();
        fwrite($tempImage, $decodedImageData);
        $tempImagePath = stream_get_meta_data($tempImage)['uri'];

        // Обработка изображения с помощью Tesseract OCR
        $tesseract = new TesseractOCR($tempImagePath);
        $tesseract->executable('C:\Program Files\Tesseract-OCR\tesseract.exe');
        $answer = $tesseract->run();

        // Закрыть временный файл (он будет автоматически удален)
        fclose($tempImage);

        $data = modules::getUserModules();
        foreach ($data as $item) {
            $modules[] = [$item->id, $item->module];
        }

        $data_formatted = str_replace(["\r\n", "\n", "\r"], '&#13;&#10;', htmlspecialchars(print_r($answer, 1)));
        return view('main.translate_scan_result', compact('data_formatted', 'modules'));
    }


}
