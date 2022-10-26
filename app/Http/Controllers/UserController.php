<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index()
    {
        if (Auth::user()->role == 'user') {
            $product = Product::all();
        } else {
            $product = TransactionHeader::with('user')->with(['transactionDetail.product' => function ($query) {
                $query->distinct('product_code');
            }])->paginate(10);
        }
        return view('home', compact('product'));
    }

    public function checkout(Request $request)
    {
        $productId = $request->id;

        $total = 0;

        $transactionHeaderId = TransactionHeader::orderBy('created_at', 'desc')->first();
        if ($transactionHeaderId) {
            $codeHeaderId = $transactionHeaderId->id + 1;
            switch (strlen($transactionHeaderId->id)) {
                case 1:
                    $codeHeader = '00' . $codeHeaderId;
                    break;
                case 2:
                    $codeHeader = '0' . $codeHeaderId;
                    break;

                default:
                    $codeHeader = $codeHeaderId;
                    break;
            }
        }


        $transactionHeader = TransactionHeader::create([
            'user_id' => Auth::user()->id,
            'document_code' => 'TRX',
            'document_number' =>$transactionHeaderId ? $codeHeader : '001',
            'total' =>  $total,
            'date' => date('Y-m-d')
        ]);



        foreach ($productId as $key => $value) {

            $product = Product::find($value);
            $transaction = TransactionDetail::create([
                'transaction_id' => $transactionHeader->id,
                'document_code' => 'TRX',
                'document_number' => '0',
                'product_code' => $product->product_code,
                'price' => $request->price[$key],
                'quantity' => $request->qty[$key],
                'unit' => 'PCS',
                'sub_total' => $request->price[$key] * $request->qty[$key],
                'currency' => 'IDR'
            ]);

            switch (strlen($transaction->id)) {
                case 1:
                    $code = '00' . $transaction->id;
                    break;
                case 2:
                    $code = '0' . $transaction->id;
                    break;

                default:
                    $code = $transaction->id;
                    break;
            }
            $transaction->document_number = $code;
            $transaction->save();
            $total += $transaction->sub_total;
        }

        $transactionHeader->total = $total;
        $transactionHeader->save();

        Session::flash('success', 'Berhasil transaksi');
        return redirect()->route('home');
    }

    public function cart()
    {
        return view('user.cart');
    }
}
