<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Bill;
use App\Billdetail;
use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Response;
use Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Http;



class AuthController extends Controller
{

    public function allproducts(){
        $data = DB::table('products')
                        -> join('brands','brands.brandid','=','products.brand_id')
                        -> get();
        $count = $data->count();
        if($count==0){
            return response()->json([
                'message' => 'Product Not Found',
                'count' => $count,
                401
                ]);
        }
        // return response()->json($data);
        return response()->json([
            'data' => $data,
            'count' => $count
            
            ]);
    }

    public function apple(){
        $data = DB::table('products')
                        -> join('brands','brands.brandid','=','products.brand_id')
                        ->where('brandid',1)
                        -> get();
        $count = $data->count();
        if($count==0){
            return response()->json([
                'message' => 'Product Not Found',
                'count' => $count,
                401
                ]);
        }
        // return response()->json($data);
        return response()->json([
            'data' => $data,
            'count' => $count
            
            ]);
    }

    public function samsung(){
        $data = DB::table('products')
                        -> join('brands','brands.brandid','=','products.brand_id')
                        ->where('brandid',2)
                        -> get();
        $count = $data->count();
        if($count==0){
            return response()->json([
                'message' => 'Product Not Found',
                'count' => $count,
                401
                ]);
        }
        // return response()->json($data);
        return response()->json([
            'data' => $data,
            'count' => $count
            
            ]);
    }

    public function oppo(){
        $data = DB::table('products')
                        -> join('brands','brands.brandid','=','products.brand_id')
                        ->where('brandid',3)
                        -> get();
        $count = $data->count();
        if($count==0){
            return response()->json([
                'message' => 'Product Not Found',
                'count' => $count,
                401
                ]);
        }
        // return response()->json($data);
        return response()->json([
            'data' => $data,
            'count' => $count
            
            ]);
    }

    public function xiaomi(){
        $data = DB::table('products')
                        -> join('brands','brands.brandid','=','products.brand_id')
                        ->where('brandid',4)
                        -> get();
        $count = $data->count();
        if($count==0){
            return response()->json([
                'message' => 'Product Not Found',
                'count' => $count,
                401
                ]);
        }
        // return response()->json($data);
        return response()->json([
            'data' => $data,
            'count' => $count
            
            ]);
    }

    public function product(Request $request){
        $data = DB::table('products')
                        -> join('brands','brands.brandid','=','products.brand_id')
                        ->where('productid',$request->productid)
                        -> get();

        $related_data = DB::table('products')
        -> join('brands','brands.brandid','=','products.brand_id')
        ->where('brandid',rand(1,4))
        -> get();

        return response()->json([
            'data' => $data,
            'related_data' => $related_data
            
            ]);

    }

    public function addtocart(Request $request){
        $data = DB::table('bills')
                        -> join('stats','stats.statusid','=','bills.status')
                        ->where('bills.user_id',$request->id)
                        ->where('bills.status',1)
                        -> get();
        $count = $data->count();
        if ($count == 0) {
            Bill::create([
                'user_id' => $request->id,
                'status' => 1,
            ]);
            $bid = DB::table('bills')
            ->where('user_id',$request->id)
            ->get()->last()->billid;

            $billdetail = new Billdetail;
            $billdetail->bill_id =  $bid;
            $billdetail->product_id = $request->productid;
            $billdetail->qty =  $request->quantity;
            $billdetail->save();
            }
            else{

                foreach ($data as $d) {
                    $currentbillid = $d->billid;
                }
                    $billdetail = new Billdetail;
                    $billdetail->bill_id =  $currentbillid;
                    $billdetail->product_id = $request->productid;
                    $billdetail->qty =  $request->quantity;
                    $billdetail->save();

            }

            return response()->json(['message' => 'Product Added to Cart']);
    }

    public function seecart(Request $request){
        $data = DB::table('bills')

                        -> join('stats','stats.statusid','=','bills.status')
                        ->where('bills.user_id',$request->id)
                        ->where('bills.status',1)
                        -> get();
            $count = $data->count();
            $da = 0;
            $countda = 0;
            if($count != 0){
                foreach ($data as $d) {
                    $currentbillid = $d->billid;
                }

                $da = DB::table('billdetails')
                        -> join('products','billdetails.product_id','=','products.productid')
                        ->where('bill_id',$currentbillid)
                        -> get();
                $countda = $da->count();
        
            }

            return response()->json([
                'da' => $da,
                'count' => $count,
                'countda' => $countda
                
                ]);
    }

    public function seecheckout(Request $request){
        $data = DB::table('bills')
                        -> join('stats','stats.statusid','=','bills.status')
                        ->where('bills.user_id',$request->id)
                        ->where('bills.status',1)
                        -> get();
            $count = $data->count();
            $da = 0;
            $countda = 0;
            if($count != 0){
                foreach ($data as $d) {
                    $currentbillid = $d->billid;
                }

                $da = DB::table('billdetails')
                        -> join('products','billdetails.product_id','=','products.productid')
                        ->where('bill_id',$currentbillid)
                        -> get();
                $countda = $da->count();
        
            }

            return response()->json([
                'da' => $da,
                'count' => $count,
                'countda' => $countda
                
                ]);
    }

    public function checkoutorder(Request $request){
        $data = [
            'status' => 2,
        ];
        Bill::where('billid',$request->billid)->update($data);

        return response()->json(['message' => 'Order Created']);

    }

    public function deleteproductcart(Request $request){
        Billdetail::destroy($request->billdetail);
        return response()->json(['message' => 'Product Deleted from Cart']);
    }

    public function deleteallproductcart(Request $request){
        DB::delete('delete from billdetails where bill_id = ?',[$request->currentbillid]);
        DB::delete('delete from bills where billid = ?',[$request->currentbillid]);
        return response()->json(['message' => 'Product Deleted from Cart']);
    }

    public function vieworder(Request $request){
        $data = DB::table('bills')
                        ->join('stats','stats.statusid','=','bills.status')
                        ->where('bills.user_id', $request->id)
                        ->where('bills.status', '!=' , 1)
                        ->get(["billid",
                        "user_id",
                        "status",
                        "bills.created_at",
                        "bills.updated_at" ,
                        "statusid",
                        "statusname"]);
            
            $count = $data->count();
            return response()->json([
                'data' => $data,
                'count' => $count,
                
                ]);
    }

    public function showhistory(Request $request){
        $da = DB::table('billdetails')
                        -> join('products','billdetails.product_id','=','products.productid')
                        ->where('bill_id',$request->historyid)
                        -> get();
                $countda = $da->count();
                return response()->json([
                    'da' => $da,
                    'countda' => $countda,
                    
                    ]);
    }

    public function getbrand(Request $request){
        $databrand = DB::table('brands')->get();
        return response()->json([
            'databrand' => $databrand
            ]);
    }

    public function adminaddproduct(Request $request){
        Product::create([
            'productName' => $request->productname, 
            'price' => $request->productprice,
            'imgUrl' => $request->image_url ,
            'brand_id' => $request->productbrand, 
            'description'=> $request->productdesc
        ]);
        return response()->json(['message' => 'A new product has been added to the cart']);
    }

    public function updateadminstatusdelivered(Request $request){
        $data = [
            'status' => 3,
        ];
        Bill::where('billid',$request->billid)->update($data);

        return response()->json(['message' => 'Order Delivered']);

    }
    public function updateadminstatusfinished(Request $request){
        $data = [
            'status' => 4,
        ];
        Bill::where('billid',$request->billid)->update($data);

        return response()->json(['message' => 'Order Finished']);

    }

    public function adminvieworder(Request $request){
        // $data = DB::table('bills')
        //                 -> join('users','users.id','=','bills.user_id')
        //                 -> join('addresses','addresses.addressid','=','users.addressID')
        //                 -> join('stats','stats.statusid','=','bills.status')
        //                 ->where('bills.status',2)
        //                 ->get(["bills.billid",
        //                 "bills.user_id",
        //                 "bills.status",
        //                 "bills.created_at",
        //                 "bills.updated_at" ,
        //                 "users.id",
        //                 "users.email",
        //                 "users.fullName",
        //                 "users.phoneNumber",
        //                 "users.addressID",
        //                 "stats.statusid",
        //                 "stats.statusname",
        //                 "addresses.province",
        //                 "addresses.city",
        //                 "addresses.address",
        //                 "addresses.postalCode",
        //                 "addresses.notes"]);

        $data = DB::table('bills')
                        -> join('stats','stats.statusid','=','bills.status')
                        ->where('bills.status',2)
                        ->get(["billid",
                        "user_id",
                        "status",
                        "bills.created_at",
                        "bills.updated_at" ,
                        "statusid",
                        "statusname"]);

        $datadelivered = DB::table('bills')
        -> join('stats','stats.statusid','=','bills.status')
        ->where('bills.status',3)
        ->get(["billid",
        "user_id",
        "status",
        "bills.created_at",
        "bills.updated_at" ,
        "statusid",
        "statusname"]);

        $datafinished = DB::table('bills')
        -> join('stats','stats.statusid','=','bills.status')
        ->where('bills.status',4)
        ->get(["billid",
        "user_id",
        "status",
        "bills.created_at",
        "bills.updated_at" ,
        "statusid",
        "statusname"]);

           

            // $datadelivered = DB::table('bills')
            //             -> join('users','users.id','=','bills.user_id')
            //             -> join('addresses','addresses.addressid','=','users.addressID')
            //             -> join('stats','stats.statusid','=','bills.status')
            //             ->where('bills.status',3)
            //             ->get(["bills.billid",
            //             "bills.user_id",
            //             "bills.status",
            //             "bills.created_at",
            //             "bills.updated_at" ,
            //             "users.id",
            //             "users.email",
            //             "users.fullName",
            //             "users.phoneNumber",
            //             "users.addressID",
            //             "stats.statusid",
            //             "stats.statusname",
            //             "addresses.province",
            //             "addresses.city",
            //             "addresses.address",
            //             "addresses.postalCode",
            //             "addresses.notes"]);

            

            // $datafinished = DB::table('bills')
            //             -> join('users','users.id','=','bills.user_id')
            //             -> join('addresses','addresses.addressid','=','users.addressID')
            //             -> join('stats','stats.statusid','=','bills.status')
            //             ->where('bills.status',4)
            //             ->get(["bills.billid",
            //             "bills.user_id",
            //             "bills.status",
            //             "bills.created_at",
            //             "bills.updated_at" ,
            //             "users.id",
            //             "users.email",
            //             "users.fullName",
            //             "users.phoneNumber",
            //             "users.addressID",
            //             "stats.statusid",
            //             "stats.statusname",
            //             "addresses.province",
            //             "addresses.city",
            //             "addresses.address",
            //             "addresses.postalCode",
            //             "addresses.notes"]);
            return response()->json([
                'data' => $data,
                'datadelivered' => $datadelivered,
                'datafinished' => $datafinished
                ]);
                
    }

    public function getproduct(){
        $data = DB::table('products')->get();
        return response()->json([
            'data' => $data
            ]);
    }

    public function deletep(Request $request){
        Product::destroy($request->productid);
        return response()->json(['message' => 'Product Deleted']);
    }

    public function getproductbyid(Request $request){
        $data = DB::table('products')
        ->where('productid',$request->productid)->get();
        return response()->json([
            'data' => $data
            ]);
    }

    public function admineditproduct(Request $request){

        $data = [
            'productName' => $request->productname, 
            'price' => $request->productprice,
            'imgUrl' => $request->image_url ,
            'brand_id' => $request->productbrand, 
            'description'=> $request->productdesc
        ];
        Product::where('productid',$request->pid)->update($data);
        return response()->json(['message' => 'Product Edited']);
    }


}
