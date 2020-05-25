<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Bill;
use App\Billdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    
    public function homeIndex()
    {
        if (Session::get('login') == FALSE) return view('welcome');
        $users = User::all();
        return view('dashboard', ['users' => $users]);
    }

    public function logout(Request $request) {
        Session::flush();
        $request->session()->regenerate();
        return Redirect::to(".");
    }

    public function sessioncheckcart(Request $request){
        if (Session::get('login') == FALSE){
            return view("signin");
        }
        else{

            $data = DB::table('bills')
                        -> join('users','users.id','=','bills.user_id')
                        -> join('stats','stats.statusid','=','bills.status')
                        ->where('bills.user_id',$request->session()->get('id'))
                        ->where('bills.status',1)
                        -> get();
            $count = $data->count();
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
            return view('/cart', compact("da","count","countda"));
           
        } 
    
    }

    public function deleteproductcart($billdetail)
        {
            Billdetail::destroy($billdetail);
            return Redirect::to("cart");
        }

    public function deleteallcart($currentbillid){
        DB::delete('delete from billdetails where bill_id = ?',[$currentbillid]);
        DB::delete('delete from bills where billid = ?',[$currentbillid]);
        return Redirect::to("cart");
    }

    public function order(Request $request){
        if (Session::get('login') == FALSE){
            return view("signin");
        }
        else{

            // $data = DB::table('bills')
            //             -> join('users','users.id','=','bills.user_id')
            //             // -> join('billdetails','billdetails.bill_id','=','bills.billid')
            //             -> join('stats','stats.statusid','=','bills.status')
            //             ->where('bills.user_id',$request->session()->get('id'))
            //             ->where('bills.status', '!=' , 1)
            //             -> get();

            $data = DB::table('bills')
                        ->join('users','users.id','=','bills.user_id')
                        ->join('stats','stats.statusid','=','bills.status')
                        ->where('bills.user_id', $request->session()->get('id'))
                        ->where('bills.status', '!=' , 1)
                        ->get(["billid",
                        "user_id",
                        "paymentUrl",
                        "status",
                        "bills.created_at",
                        "bills.updated_at" ,
                        "id",
                        "email",
                        "password",
                        "fullName",
                        "phoneNumber",
                        "addressID",
                        "statusid",
                        "statusname"]);
            
            $count = $data->count();
            // if($count != 0){
            //     foreach ($data as $d) {
            //         $currentbillid = $d->billid;
            //         $da = DB::table('billdetails')
            //                 -> join('products','billdetails.product_id','=','products.productid')
            //                 -> join('bills','bills.billid','=','billdetails.bill_id')
            //                 ->where('bill_id',$currentbillid)
            //                 -> get();

            //         $countda = $da->count();

            //     }

        
            //}
            return view('/orderhistory', compact("data","count","datacreated"));
            // return view('/orderhistory', compact("data", "da","count","countda"));
            //dump($data);
            
           
        } 
    }


    public function showhistory($historyid){
        if (Session::get('login') == FALSE){
            return view("signin");
        }
        else{

            

                $da = DB::table('billdetails')
                        -> join('products','billdetails.product_id','=','products.productid')
                        ->where('bill_id',$historyid)
                        -> get();
                $countda = $da->count();
        
            
            return view('/history', compact("da","countda"));
           
        } 
    }


    public function showallproducts(Product $product)
    {
        $data = DB::table('products')
                        -> join('brands','brands.brandid','=','products.brand_id')
                        -> get();
        $count = $data->count();
            // foreach ($data as $dat) {
            //     Session::put('id',$dat->id);
            // }
        return view('/allproducts', compact("data","count"));
    }


    public function showproductapple(Product $product)
    {
        $data = DB::table('products')
                        -> join('brands','brands.brandid','=','products.brand_id')
                        ->where('brandid',1)
                        -> get();
        $count = $data->count();
            
        return view('/apple', compact("data","count"));
    }

    public function showproductsamsung(Product $product)
    {
        $data = DB::table('products')
                        -> join('brands','brands.brandid','=','products.brand_id')
                        ->where('brandid',2)
                        -> get();
        $count = $data->count();
            
        return view('/samsung', compact("data","count"));
    }

    public function showproductoppo(Product $product)
    {
        $data = DB::table('products')
                        -> join('brands','brands.brandid','=','products.brand_id')
                        ->where('brandid',3)
                        -> get();
        $count = $data->count();
            
        return view('/oppo', compact("data","count"));
    }

    public function showproductxiaomi(Product $product)
    {
        $data = DB::table('products')
                        -> join('brands','brands.brandid','=','products.brand_id')
                        ->where('brandid',4)
                        -> get();
        $count = $data->count();
            
        return view('/samsung', compact("data","count"));
    }

    public function showproduct($productid){
        $data = DB::table('products')
                        -> join('brands','brands.brandid','=','products.brand_id')
                        ->where('productid',$productid)
                        -> get();
        $related_data = DB::table('products')
                        -> join('brands','brands.brandid','=','products.brand_id')
                        ->where('brandid',rand(1,4))
                        -> get();
        return view('product', compact("data", "related_data"));
    }

    public function addtocart(Request $request, $productid)
    {

        if (Session::get('login') == FALSE){
            return view("signin");
        }
        else{
        $data = DB::table('bills')
                        -> join('users','users.id','=','bills.user_id')
                        -> join('stats','stats.statusid','=','bills.status')
                        ->where('bills.user_id',$request->session()->get('id'))
                        ->where('bills.status',1)
                        -> get();
        $count = $data->count();
        if ($count == 0) {
            Bill::create([
                'user_id' => $request->session()->get('id'),
                'status' => 1,
            ]);
            $bid = DB::table('bills')
            ->where('user_id',$request->session()->get('id'))
            ->get()->last()->billid;

            $billdetail = new Billdetail;
            $billdetail->bill_id =  $bid;
            $billdetail->product_id = $productid;
            $billdetail->qty =  $request->input('quantity');
            $billdetail->save();
            }
            else{
                // $dataa = DB::table('bills')
                //         -> join('users','users.id','=','bills.user_id')
                //         -> join('stats','stats.statusid','=','bills.status')
                //         ->where('user_id',$request->session()->get('id'))
                //         -> get();
                foreach ($data as $d) {
                    $currentbillid = $d->billid;
                }
                    $billdetail = new Billdetail;
                    $billdetail->bill_id =  $currentbillid;
                    $billdetail->product_id = $productid;
                    $billdetail->qty =  $request->input('quantity');
                    $billdetail->save();

                
                // else{
                //     Bill::create([
                //         'user_id' => $request->session()->get('id'),
                //         'status' => 1,
                //     ]);
                //     $bidd = DB::table('bills')->get()->last()->id;
        
                //     $billdetail = new Billdetail;
                //     $billdetail->bill_id =  $bidd;
                //     $billdetail->product_id = $productid;
                //     $billdetail->qty =  $request->input('quantity');
                //     $billdetail->save();
                //     }
            }

            // $da = DB::table('bills')
            //             -> join('user_id','users.id','=','bills.user_id')
            //             ->where('user_id',$request->session()->get('id'))
            //             -> join('status','stats.statusid','=','bills.status')
            //             ->where('status',1)
            //             -> get();
        
            
        return Redirect::to('/cart');
            }
    }

    public function sessioncheckout(Request $request){
        if (Session::get('login') == FALSE){
            return view("signin");
        }
        else{
            $data = DB::table('bills')
                        -> join('users','users.id','=','bills.user_id')
                        -> join('stats','stats.statusid','=','bills.status')
                        ->where('bills.user_id',$request->session()->get('id'))
                        ->where('bills.status',1)
                        -> get();
            $count = $data->count();
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
            return view('/checkout', compact("da","count","countda"));
        } 
    }

    public function adminlogged()
    {
        if (!Session::get('admlogin')){
            return view('/admin');
        }else{



            return view('/adminloggedin');
        }
        
    }

   





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
