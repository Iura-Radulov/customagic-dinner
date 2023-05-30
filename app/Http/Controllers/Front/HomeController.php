<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
        $today = date("Y-m-d");
$userCard = DB::table('user_card')->where('number', $number)->first();
if(isset($userCard->id)) {
    $user = DB::table('users')->where('id', $userCard->user_id)->first();
    $division = DB::table('divisions')->where('id', $user->division_id)->first();
    $menuType = DB::table('menu_type')->where('id', $userCard->menu_id)->first();
}


$userList = DB::table('user_list')->where('date_from', '<=', $today)->where('date_to', '>=', $today)->get();


if(isset($user->id)) {
    if(!empty($userList)) {
        foreach ($userList as $item ) {

            if ( DB::table('list_user')->where('list_id', $item->id)->where('user_id', $user->id)->exists()) {
                $order = new Order();
                $order->user_name = $user->name;
                $order->division = $division->name;
                $order->menu_type = $menuType->name;
                $order->price = $menuType->value;
                $order->save();
                return redirect("/")->with('message-success', 'Вы успешно оформили заказ') ;
            }
            else return redirect("/")->with('message-error', 'Вас нет в списке');
        }
    }
} else return redirect("/")->with('message-error', 'У вас нет карты');




//        return redirect('/users');
    }
}
