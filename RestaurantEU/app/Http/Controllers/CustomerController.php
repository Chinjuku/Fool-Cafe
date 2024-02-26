<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class CustomerController extends Controller
{
    function reservation() {
        return view('customer/reservation');
    }

    function reserving(Request $request) {
        $request->validate(
            [
                'name' =>'required',
                'people_num' => 'required',
                'phone_num' =>'required',
                'time' =>'required',
            ],
            [
                'name.required' => 'กรุณากรอกชื่อผู้ใช้ของคุณ',
                'people_num.required' => 'กรุณากรอกจำนวนที่นั่ง',
                'phone_num.required' => 'กรุณากรอกเบอร์โทรศัพท์',
                'time.required' => 'กรุณากรอกเวลาที่จอง',
            ]
        );
        DB::table('reservation')->insert([
            'name' => $request->name,
            'people_num' => $request->people_num,
            'phonenum' => $request->phone_num,
            'time' => $request->time,
            'end_time' => date('H:i:s', strtotime($request->time) + 15 * 60)
        ]);
        // return redirect()->route('login'); // รอเชื่อมหน้าหลังจอง
    }
    function tablepage() {
        $id = Route::current()->parameter('id');
        $gettable = DB::table('table')->where('table_id', $id)->where('isIdle', 0)->first();
        $createOrder = DB::table('order');
        if (!$gettable) {
            return '<h1>busy</h1>';
        }
        $data = [
            'table_id' => $id,
            'isIdle' => 1
        ];
        DB::table('table')->where('table_id', $id)->update($data);
        return view('customer/home');
    }
    // public function storemenu(Request $request)
    // {
    //     $id = Route::current()->parameter('id');
    //     $order = DB::table('order')->insert([
    //         'table_id' => $id,
    //         'order_time' => time()
    //     ]);
    //     $orderdetails = DB::table('orderdetails');
    //     foreach ($request->menus as $menu) {
    //         $order->$orderdetails->create([
    //             'menu_id' => $menu['id'],
    //             'quantity' => $menu['quantity'],
    //             'order_status' => 'in-line',
    //         ]);
    //     }
    //     return response()->json(['message' => 'Order created successfully'], 201);
    // }

}
