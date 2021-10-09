<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $carts = Cart::with('product')->where('customer_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Cart',
            'cart' => $carts
        ]);
    }

    public function store(Request $request)
    {
        try {
            $item = Cart::where('product_id', $request->product_id)->where('customer_id', $request->customer_id);
            if ($item->count()) {
                // incremenet quantity
                $item->increment('qty');
                $item = $item->first();
                // sum price * quantity
                $price = $request->price * $item->quantity;
                // sum weight
                $weight = $request->weight = $item->quantity;
                $item->update([
                    'price' => $price,
                    'weight' => $weight
                ]);
            } else {
                $item = Cart::create([
                    'product_id' => $request->product_id,
                    'customer_id' => $request->customer_id,
                    'qty' => $request->qty,
                    'price' => $request->price,
                    'weight' => $request->weight,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Success Add To Cart',
                'qty' => $item->quantity,
                'product' => $item->product
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
        
    }

    public function getCartTotal()
    {
        $carts = Cart::with('product')
                ->where('customer_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->sum('price');

        return response()->json([
            'success' => true,
            'message' => 'Total Cart Price',
            'total' => $carts
        ]);
    }

    public function getCartTotalWeight()
    {
        $carts = Cart::with('product')
                ->where('customer_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->sum('weight');

        return response()->json([
            'success' => true,
            'message' => 'Total Cart Weight',
            'total' => $carts
        ]);
    }

    public function removeCart(Request $request)
    {
        Cart::with('product')
            ->whereId($request->cart_id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Remove Item Cart'
        ]);
    }

    public function removeAllCart()
    {
        Cart::with('product')
            ->where('customer_id', auth()->guard('api')->user()->id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Remove All Item In Cart'
        ]);
    }
}
