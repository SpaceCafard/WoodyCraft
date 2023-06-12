<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Panier;
use App\Models\Order;
use App\Models\Commande;
use App\Models\Delivery;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showOrder()
    {
        if(Auth::id())
        {
            $user=auth()->user();
            $count = Panier::where('name', $user->name)->count();
            $paniers = Panier::where('name', $user->name)->get();
            if($count > 0)
            {

                $payments = Payment::all();
                return view('panier.order', compact('payments','paniers','user','count'));
            }
            else{
                return redirect('/showPanier')->with('info', 'Votre panier est vide');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function addOrder(Request $request,$id="")
    {

        if(Auth::id())
        {
            $user=auth()->user();

            $request->validate([

                'total' => 'required' ,
                'firstname' => 'required|min:3' ,
                'lastname' => 'required' ,
                'add1' => 'required' ,
                'add2',
                'city' => 'required' ,
                'postcode' => 'required' ,
                'phone' => 'required' ,
                'email' => 'required' ,
                'nameCarte' => 'required' ,
                'numero' => 'required' ,
                'cvv' => 'required'

            ]);


            $payment = new payment([
                'nameCarte' => $request->get('nameCarte'),
                'numero' => $request->get('numero'),
                'cvv' => $request->get('cvv'),
            ]);

            $payment->save();
            $paymentId = Payment::latest()->first()->id;

            $deliveryadd = new Delivery([
                'firstname' => $request->get('firstname'),
                'lastname' => $request->get('lastname'),
                'add1' => $request->get('add1'),
                'add2' => $request->get('add2'),
                'city' => $request->get('city'),
                'postcode' => $request->get('postcode'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email')
            ]);


            $deliveryadd->save();
            $idDelivery = Delivery::latest()->first()->id;

            $order=new Order;
            $order->customer_id=$user->customer_id;
            $order->delivery_id=$idDelivery;
            $order->payment_id=$paymentId;
            $order->status=0;
            $order->total=$request->total;

            $order->save();

            $idOrder = Order::latest()->first()->id;





            $paniers = Panier::where('name', $user->name)->get();
            $products= Product::all();

            foreach ($paniers as $panier)
            {
                foreach ($products as $product)
                {
                    if($panier->product_id == $product->id)
                    {
                        $product->stock=$product->stock-$panier->quantity;
                        $product->update();
                    }
                }
                $commande = new commande;
                $commande->name=$panier->name;
                $commande->product_id=$panier->product_id;
                $commande->quantity=$panier->quantity;
                $commande->order_id = $idOrder;
                $commande->product->quantity=$commande->product->quantity-$commande->quantity;
                $commande->save();

            }
            $paniers = Panier::where('name', $user->name);
            $paniers->delete();

            return redirect('/showPanier')->with('info', 'Commande Passée ');
        }
        else
        {
            return redirect('login');
        }

    }

    public function listOrder(){
        if(Auth::id())
        {
            $user=auth()->user();
            $count = Panier::where('name', $user->name)->count();
            $orders = Order::where('customer_id', $user->customer_id)->oldest('status')->get();
            $count2 = Order::where('customer_id', $user->customer_id)->oldest('status')->count();
            $count3 = Order::where('customer_id', $user->customer_id)->where('status', 3)->oldest('status')->count();

            return view('panier.listOrder', compact('orders','count','user','count2','count3'));

        }
        else{
            return redirect('login');
        }

    }
    public function listOrderAdmin(){
        if(Auth::id())
        {
            $user=auth()->user();
            $orders = Order::oldest('status')->get();
            $customer = Customer::all();

            return view('admin.listOrderAdmin', compact('orders','customer','user'));

        }
        else{
            return redirect('login');
        }

    }

    public function orderStatus(Request $request, $id="")
    {
        $orders = Order::query()->findOrFail($id);
        $orders->status = $request->get('status');

        $orders->update();

        return redirect('/order/list/admin')->with('info', 'Commande Mis à jour');
    }


}
