<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function show()
    {
        return view('pages.home', [
            'user' =>''
        ]);
    }
    public function check(Request $request)
    {
        $number = $request->input('number');

$user = DB::table('user_card')->where('number', $number);
$lastList = DB::table('user_list')->orderby('id', 'desc')->first();
dd($lastList);
        // Store the user...

//        return redirect('/users');
    }
}
