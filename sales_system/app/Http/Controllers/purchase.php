<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class purchase extends Controller
{

    public function get_purchases(){
        return view('purchases');
    }
    public function set_current_bell_number($bell_number){
        DB::table("purchase_bells")
        ->update(['status'=>'null']);

        DB::table("purchase_bells")
        ->where("number", "=", $bell_number)
        ->update(['status'=>'current']);
    }
    public function get_current_bell_number(){
        $bell_number = DB::table("purchase_bells")
        ->where("status", "=", "current")
        ->value("number");
        return $bell_number;
    }
    public function get_purchase_bell($purchase_bell_number){
        //get the bell data
        $bell_data= DB::table('purchase_bells')
        ->join("suppliers", 'suppliers.number', '=', 'purchase_bells.supplier_number')
        ->where('purchase_bells.number', '=', $purchase_bell_number)
        ->select('purchase_bells.*', 'suppliers.name')
        ->get();
        if($bell_data == "[]"){
            echo "<h3>لا يوجد فاتوره بهذا الرقم</<h3>";
        }else if($bell_data != "[]"){
            foreach ($bell_data as $mybell){
                echo '<table class="table text-center table-bordered">
                <tr>
                <td colspan="7" class="text-center">فاتوره شراء</td>
                </tr>
                <tr>
                  <td rowspan="3" class="text-center">
                    <img src="'.asset("images/products.png").'">
                  </td>
                  <td colspan="6" class="text-right"><span>رقم الفاتوره: </span>'.$mybell->number.'</td>
                </tr>
                <tr>
                  <td colspan="6" class="text-right"><span>تاريخ الفاتوره: </span>'.$mybell->purchase_date.'</td>
                </tr>
                <tr>
                  <td colspan="3" class="text-right"><span>إجمالى الفاتوره: </span> '.$mybell->bell_total_price.' جنيه</td>
                  <td colspan="3" class="text-right"><span>المور/الشركه: </span>'.$mybell->name.'</td>
                </tr>
                <tr>
                  <td colspan="7" class="text-right">المشتريات</td>
                </tr>
                <tr>
                  <tr>
                    <td class="hidden-print">حذف</td>
                    <td class="hidden-print">تعديل</td>
                    <td>السعر الكلى</td>
                    <td>الكميه</td>
                    <td colspan="2">اسم المنتج</td>
                    <td>رقم المنتج</td>
                  </tr>
                </tr>';
             }
            //start get the bell products
            $purchases = DB::table('purchases')
            ->join('products', 'purchases.product_number', '=', 'products.number')
            ->where('purchases.purchase_bell_number', '=', $purchase_bell_number)
            ->select('purchases.*', 'products.name')
            ->get();
            foreach ($purchases as $purchase){
                
                echo '<tr>
                    <td class="hidden-print">
                        <a name="delete" class="text-primary text-center" href="purchases/delete/purchase'.$purchase->number.'"><i title="حذف" class="fa fa-trash"></i></a>
                    </td>
                    <td class="hidden-print">
                        <a name="edit" class="text-primary text-center" href="/purchases/get/purchase/'.$purchase->number.'"><i title="تعديل" class="fa fa-edit"></i></a>
                    </td>
                     <td class="">'.$purchase->product_total_price.'</td>
                     <td class="">'.$purchase->amount.'</td>
                     <td colspan="2" class="">'.$purchase->name.'</td>
                     <td class="">'.$purchase->product_number.'</td>
                 </tr>';
             }
             //end get the bell products
             echo '<tr>
                <td colspan="7" class="text-right hidden-print">
                    <button name="print_table" type="button" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
                </td>
                </tr>
            </table>';
            $this->set_current_bell_number($purchase_bell_number);
        }
        
    }
   public function create_purchase_bell(){
        //create the purchase bell
        $bells_count = DB::table("purchase_bells")->max("number") + 1;
        $purchase_bell_number = str_pad("$bells_count", 10, "0", STR_PAD_LEFT);
        DB::table("purchase_bells")->insert([
            'number'=>$purchase_bell_number,
            'purchase_date'=>Date("Y-m-d"),
            'supplier_number'=>request("supplier_number")
        ]);
        $this->get_purchase_bell($purchase_bell_number);
        // return "تم انشاء فاتورة الشراء";
   }
    public function add_bell_product(){
        $data = $this->validate(request(),[
            "product_number"=>"required",
            "product_total_price"=>'required',
            "amount"=>'required|numeric',
        ]);
        $purchase_bell_number = $this->get_current_bell_number();
        
        DB::table("purchases")->insert([
            'amount'=>$data['amount'],
            'product_total_price'=>$data['product_total_price'],
            'product_number'=>$data['product_number'],
            'purchase_bell_number'=>$purchase_bell_number
        ]);

        
        
        DB::table("products")
        ->where("number", "=", $data['product_number'])
        ->increment("amount", $data['amount']);
        DB::table("purchase_bells")
        ->where("number", "=", $purchase_bell_number)
        ->increment("bell_total_price", $data['product_total_price']);
        $this->get_purchase_bell($purchase_bell_number);
        // return "تم اضافة المنتج الى الفاتوره";
    }
    
    public function Delete_purchase($number){
        $purchases  = DB::table("purchases")
        ->where("number", "=", $number)
        ->get();
        foreach($purchases as $purchase){
            DB::table("products")
            ->where("number", "=", $purchase->product_number)
            ->decrement("amount", $purchase->amount);
            DB::table("purchase_bells")
            ->where("number", "=", $purchase->purchase_bell_number)
            ->decrement("bell_total_price", $purchase->product_total_price);
            DB::table('purchases')->where('number', '=', $number)->delete();
            //get the correct data and adding it in the table
            $this->get_purchase_bell($purchase->purchase_bell_number);
        }
        
    }

    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> 'required|numeric'
        ]);
        $purchase_bell_number = str_pad($data['search_text'], 10, "0", STR_PAD_LEFT);
        $this->get_purchase_bell($purchase_bell_number);
    }
    
    public function get_purchase_data($number){
        $purchases = DB::table('purchases')
        ->where('number', '=', $number)
        ->get();
        foreach($purchases as $purchase){
            echo '<div class="text-right col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">تحديث</div>

                        <div class="panel-body">
                            
                            <form name="purchases" id="update_data" method="post" action="'.url("/purchases/update/purchase/$purchase->number").'" enctype="multipart/form-data">
                                <div class="form-group col-xs-12">
                                <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                                </div>  
                                
                                <div class="form-group col-sm-6 col-md-4">
                                    <label>الكميه</label>
                                    <input name="amount" type="text" class="text-right form-control" value="'.$purchase->amount.'">
                                </div>
                                <div class="form-group col-sm-6 col-md-4">
                                    <label>سعر الكميه</label>
                                    <input name="product_total_price" type="text" class="text-right form-control" value="'.$purchase->product_total_price.'">
                                </div>
                                <div class="form-group col-sm-12 hidden-print">
                                    <button name="update" type="button" class="btn btn-primary"><i class="fa fa-save"></i> تحديث</button>
                                </div>
                                </form>
                        </div>
                    </div>
   </div>';
        }
       
    }
    public function update_purchase($number){
            //validating the form data
            $data = $this->validate(request(),[
                'product_total_price' => 'required',
                'amount' => 'required|numeric',
                ]);
            
            $purchases = DB::table("purchases")
            ->where("number", "=", $number)
            ->get();
            foreach($purchases as $purchase){
                DB::table("products")
                ->where("number", "=", $purchase->product_number)
                ->decrement("amount", $purchase->amount);
                //updating the purchase data
                DB::table('purchases')
                ->where('number', '=', $number)
                ->update([
                    'product_total_price' => $data['product_total_price'],
                    'amount' => $data['amount'],
                ]);
                DB::table("products")
                ->where("number", "=", $purchase->product_number)
                ->increment("amount", $data['amount']);
                $bell_total_price = DB::table('purchases')
                ->where("purchase_bell_number", "=", $purchase->purchase_bell_number)
                ->sum("product_total_price");
                DB::table("purchase_bells")
                ->where("number", "=", $purchase->purchase_bell_number)
                ->update(["bell_total_price" => $bell_total_price]);
                
                $this->get_purchase_bell($purchase->purchase_bell_number);
            }

    }
    
}
