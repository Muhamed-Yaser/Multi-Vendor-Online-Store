<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Redirect;

class InvalidOrderException extends Exception
{
     /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        // return Redirect::route('front.index')
        //     ->withInput()
        //     ->withErrors([
        //         'message' => $this->getMessage()
        //     ])
        //     ->with('info', $this->getMessage());
    }
}
