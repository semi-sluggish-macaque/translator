<?php

namespace App\Exceptions;

use Exception;

class ViewExceptionHandler extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        // Если возникла ошибка при рендеринге первого представления, вернуть второе представление
        return response()->view('errort', [
            'error' => 'Произошла ошибка в первом виде: ' . $this->getMessage(),
        ]);
    }
}
