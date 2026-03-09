<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::where('available', true)->get();
        return view('shop.index', compact('products'));
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('shop.cart', compact('cart', 'total'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        }
        else {
            $cart[$product->id] = [
                "name" => $product->name . ' ' . $product->variety,
                "quantity" => 1,
                "price" => $product->price,
                "format" => $product->format,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Producto añadido al carrito!');
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Carrito actualizado');
        }
        return redirect()->route('shop.cart');
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Producto eliminado');
        }
        return redirect()->route('shop.cart');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'El carrito está vacío.');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('shop.checkout', compact('cart', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|in:Transferencia,Bizum'
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'El carrito está vacío.');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'status' => 'Pendiente',
                'total' => $total,
                'ordered_at' => now(),
            ]);

            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'unit_price' => $details['price'],
                    'format' => $details['format']
                ]);
            }

            DB::commit();

            session()->forget('cart');

            // Send Email to Customer
            Mail::to($order->customer_email)->send(new \App\Mail\OrderConfirmed($order));
            
            // Optionally send to Admin too
            // Mail::to(config('mail.from.address'))->send(new \App\Mail\OrderConfirmed($order));

            return redirect()->route('shop.index')->with('success', 'Pedido realizado con éxito! Te hemos enviado un correo de confirmación.');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al procesar tu pedido. Inténtalo de nuevo.')->withInput();
        }
    }
}