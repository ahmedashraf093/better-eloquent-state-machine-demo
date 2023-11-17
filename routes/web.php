<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $orders = \App\Models\SalesOrder::all();
    $users = \App\Models\User::all();
    $firstOrder = $orders->first();

    return view('order-details', compact('orders', 'users', 'firstOrder'));
});


Route::post('/updateorder', function (Request $request) {
    $order = \App\Models\SalesOrder::find($request->order_id);

    $order->status()->transitionTo($request->status, ["comments" => $request->comments]);

    return redirect()->back();
})->name('order.update');
