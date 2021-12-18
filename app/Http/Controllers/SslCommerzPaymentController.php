<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Cart;
use App\Order_item;
use App\Shipping;
use Illuminate\Support\Facades\Session;


class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();



        # CUSTOMER INFORMATION
        $post_data['cus_name'] = Auth::user()->name;
        $post_data['cus_email'] = Auth::user()->email;

        # Orders INFORMATION
        // user_id,
        $post_data['tran_id'] = mt_rand(10000000,99999999); // tran_id must be unique
        $post_data['total_amount'] = $request->total; # You cant not pay less than 10
        $post_data['subtotal'] = $request->subtotal;
        $post_data['coupon_discount'] = $request->coupon_discount;
        $post_data['payment_type'] = $request->payment_type;

        # SHIPMENT INFORMATION
        $post_data['ship_fname'] = $request->shipping_first_name;
        $post_data['ship_lname'] = $request->shipping_last_name;
        $post_data['ship_email'] = $request-> shipping_email;
        $post_data['ship_add1'] = $request->shipping_address;
        // $post_data['ship_add2'] = "Dhaka";
        // $post_data['ship_city'] = $request->shipping_first_name;
        $post_data['ship_state'] = $request->shipping_state;
        $post_data['ship_postcode'] = $request->post_code;
        $post_data['ship_phone'] = $request->shipping_phone;

        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        // # OPTIONAL PARAMETERS
        // $post_data['value_a'] = "ref001";
        // $post_data['value_b'] = "ref002";
        // $post_data['value_c'] = "ref003";
        // $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $order_id = DB::table('orders')
            ->where('invoice_no', $post_data['tran_id'])
            ->updateOrInsert([
                'user_id' =>Auth::id(),
                'total' => $post_data['total_amount'],
                'invoice_no' => $post_data['tran_id'],
                'subtotal' => $post_data['subtotal'],
                'coupon_discount' =>$post_data['coupon_discount'],
                'payment_type' => $post_data['payment_type'],
                'created_at'=>Carbon::now(),
            ]);

            $carts=Cart::where('user_ip',request()->ip())->latest()->get();
            foreach($carts as $cart){
                Order_item::insert([
                    'order_id'=>$order_id,
                    'product_id'=>$cart->product_id,
                    // 'product_name'=>$cart->product->product_name,
                    'product_qty' =>$cart->product_qty,
                    'created_at'=>Carbon::now(),
                ]);
            }

            Shipping::insert([
                'order_id'=>$order_id,
                'shipping_first_name'=>$post_data['ship_fname'],
                'shipping_last_name'=>$post_data['ship_lname'],
                'shipping_email'=>$post_data['ship_email'],
                'shipping_phone'=>$post_data['ship_phone'],
                'shipping_address'=>$post_data['ship_add1'],
                'shipping_state'=> $post_data['ship_state'],
                'post_code'=>$post_data['ship_postcode'],
                'created_at'=>Carbon::now(),
            ]);

            if(Session::has('coupon')){
                Session::forget('coupon');
            }
            Cart::where('user_ip',request()->ip())->delete();

            // return Redirect()->to('order/success')->with('success','Store Order Data Successfully');

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('invoice_no');
        $total = $request->input('total');
        $subtotal = $request->input('subtotal');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('invoice_no', $tran_id)
            ->select('invoice_no', 'status', 'subtotal', 'total')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $total, $subtotal);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('invoice_no', $tran_id)
                    ->update(['status' => 'Processing']);

                echo "<br >Transaction is successfully Completed";
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('invoice_no', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('invoice_no');

        $order_detials = DB::table('orders')
            ->where('invoice_no', $tran_id)
            ->select('invoice_no', 'status', 'subtotal', 'total')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('invoice_no', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('invoice_no');

        $order_detials = DB::table('orders')
            ->where('invoice_no', $tran_id)
            ->select('invoice_no', 'status', 'subtotal', 'total')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('invoice_no', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('invoice_no')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('invoice_no');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('invoice_no', $tran_id)
                ->select('invoice_no', 'status', 'subtotal', 'total')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->total, $order_details->subtotal);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('invoice_no', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('invoice_no', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
