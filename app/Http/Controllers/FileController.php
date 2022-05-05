<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    // 参考: https://laraweb.net/tutorial/2707/
    function upload(Request $request)
    {
        $result = $request->file('file')->store('localStore');
        return ["result" => $result];
    }
}
