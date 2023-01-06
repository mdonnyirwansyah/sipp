<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();

        return view('main.order.index', compact('orders'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_data()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();$data = [];

        foreach ($orders as $index => $order) {
            $data[$index] = [
                'date' => $order->created_at->format('Y-m-d'),
                'order_id' => $order->id,
                'order_name' => 'Baliho '.$order->size,
                'customer_name' => $order->customer->name,
                'price' => 'Rp '.number_format($order->price, 2),
                'status' => $order->status,
                'payment_status' => $order->payment_status
            ];
        }

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            return '
                <div class="d-flex align-items-center justify-content-sm-center justify-content-start">
                    <a href="'. route("data-order.edit", $data['order_id']) .'" class="btn btn-outline-info btn-xs mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
                        <i class="fa fa-pen"></i>
                    </a>
                    <button id="'. $data['order_id']. '" route="'. route("data-order.destroy", $data['order_id']) .'" onclick="handleDelete('. $data['order_id'] .')" type="button" class="btn btn-outline-danger btn-xs ml-1" data-toggle="tooltip" data-placement="top" title="Hapus">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate( [
            'desain' => 'required',
            'ukuran' => 'required',
            'keterangan' => 'required',
            'harga' => 'required',
            'status_pembayaran' => 'required',
            'nama' => 'required',
            'telepon' => 'required',
        ]);

        DB::transaction(function () use($request) {
            $date = Carbon::now()->toArray();
            $order_id = $date['timestamp'];

            $customer = Customer::create([
                'name' => $request->nama,
                'phone' => $request->telepon
            ]);

            if ($request->desain) {
                $file = md5($request->desain.microtime().'.'.$request->desain->extension());
                Storage::putFileAs('public/design', $request->desain, $file);
            }

            Order::create([
                'id' => $order_id,
                'customer_id' => $customer->id,
                'design' => $file,
                'size' => $request->ukuran,
                'description' => $request->keterangan,
                'price' => $request->harga,
                'status' => 'Pesanan Dibuat',
                'payment_status' => $request->status_pembayaran
            ]);
        });

        return redirect()->route('data-order.index')->with('success', 'Data baru berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = "Data tidak ditemukan.";

        if ($request->id) {
            $order = Order::find($request->id);
            if (!$order) {
                return response()->json(['error' => $data], 200);
            }
            $data = [
                'id' => $order->id,
                'date' => $order->created_at->format('D, d M Y'),
                'design' => $order->design,
                'size' => $order->size,
                'description' => $order->description,
                'price' => $order->price,
                'status' => $order->status,
                'payment_status' => $order->payment_status,
                'customer_info' => [
                    'name' => $order->customer->name,
                    'phone' => $order->customer->phone
                ],
                'routes' => [
                    'update_status' => route('update.update-status', $order),
                    'update_payment_status' => route('update.update-payment-status', $order)
                ]
            ];

            return response()->json(['success' => $data], 200);
        } else {
            return response()->json(['error' => $data], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('main.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate( [
            'ukuran' => 'required',
            'keterangan' => 'required',
            'harga' => 'required',
            'status_pembayaran' => 'required',
            'nama' => 'required',
            'telepon' => 'required',
        ]);

        DB::transaction(function () use($request, $order) {
            $customer = Customer::find($order->customer_id);
            $customer->update([
                'name' => $request->nama,
                'phone' => $request->telepon
            ]);

            if ($request->desain) {
                $file = md5($request->desain.microtime().'.'.$request->desain->extension());
                Storage::delete('public/design/'.$order->design);
                Storage::putFileAs('public/design', $request->desain, $file);
            }

            $customer->order->update([
                'design' => $request->desain ? $file : $order->design,
                'size' => $request->ukuran,
                'description' => $request->keterangan,
                'price' => $request->harga,
                'payment_status' => $request->status_pembayaran
            ]);
        });

        return redirect()->route('data-order.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status()
    {
        return view('main.update.status');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment_status()
    {
        return view('main.update.payment-status');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update_status(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status
        ]);

        return response()->json(['success' => 'Status berhasil diubah!'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update_payment_status(Request $request, Order $order)
    {
        $order->update([
            'payment_status' => $request->payment_status
        ]);

        return response()->json(['success' => 'Status Pembayaran berhasil diubah!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        DB::transaction(function () use($order) {
            Storage::delete('public/design/'.$order->design);
            $order->customer->delete();
        });

        $data = ['success' => 'Data berhasil dihapus!'];

        return response()->json($data, 200);
    }
}
