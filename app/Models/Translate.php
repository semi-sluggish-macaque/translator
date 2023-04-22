<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{


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
