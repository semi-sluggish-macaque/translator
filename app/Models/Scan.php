<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;

class Scan extends Model
{


//    public static function scan_picture($request)
//    {
//        $file = $request->file('file');
//        $storedFileName = $request->file('file')->store("public/images");
//        $fileName = basename($storedFileName);
//        $filePath = "public/images/$fileName";
//        $absolutePath = Storage::path($filePath);
//        $tesseract = new TesseractOCR($absolutePath);
//        $tesseract->executable('C:\Program Files\Tesseract-OCR\tesseract.exe');
//        $answer = $tesseract->run();
//        return $answer;
//    }

    public static function scan_picture($request)
    {
        $file = $request->file('file');

        // Получить содержимое файла
        $fileContent = file_get_contents($file->getRealPath());

        // Сохранение изображения во временный файл
        $tempImage = tmpfile();
        fwrite($tempImage, $fileContent);
        $tempImagePath = stream_get_meta_data($tempImage)['uri'];

        // Обработка изображения с помощью Tesseract OCR
        $tesseract = new TesseractOCR($tempImagePath);
        $tesseract->executable('C:\Program Files\Tesseract-OCR\tesseract.exe');
        $answer = $tesseract->run();

        // Закрыть временный файл (он будет автоматически удален)
        fclose($tempImage);

        return $answer;
    }


}
