<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();
        $data = [];

        foreach ($orders as $index => $order) {
            $data[$index] = [
                'date' => $order->created_at->format('Y-m-d'),
                'order_id' => $order->id,
                'order_name' => 'Baliho '.$order->size,
                'customer_name' => $order->customer->name,
                'price' => 'Rp '.number_format($order->price, 2)
            ];
        }

        return view('main.report.index', compact('data'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();
        $data = [];

        foreach ($orders as $index => $order) {
            $data[$index] = [
                'date' => $order->created_at->format('Y-m-d'),
                'order_id' => $order->id,
                'order_name' => 'Baliho '.$order->size,
                'customer_name' => $order->customer->name,
                'price' => 'Rp '.number_format($order->price, 2)
            ];
        }


        $pdf = Pdf::loadView('main.report.print', compact('data'))
        ->setPaper('a4');

        return $pdf->stream('report');
    }
}
