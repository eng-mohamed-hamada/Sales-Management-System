<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class sales extends Controller
{

    public function get_sales(){
        return view('sales');
    }
    public function set_current_bell_number($bell_number){
        DB::table("sales_bells")
        ->update(['status'=>'null']);

        DB::table("sales_bells")
        ->where("number", "=", $bell_number)
        ->update(['status'=>'current']);
    }
    public function get_current_bell_number(){
        $bell_number = DB::table("sales_bells")
        ->where("status", "=", "current")
        ->value("number");
        return $bell_number;
    }
    public function get_sales_bell($sales_bell_number){
        //get the bell data
        $bell_data= DB::table('sales_bells')
        ->where('number', '=', $sales_bell_number)
        ->get();
        if($bell_data == "[]"){
            echo "<h3>لا يوجد فاتوره بهذا الرقم</<h3>";
        }else if($bell_data != "[]"){
            foreach ($bell_data as $mybell){
                echo '<table class="table text-center table-bordered">
                
                <tr>
                  <td rowspan="3" class="text-center">
                    <img src="'.asset("images/products.png").'">
                  </td>
                  <td colspan="2" class="text-right"><span></span>بيع</td>
                  <td colspan="1" class="text-right">نوع الفاتوره</td>

                  <td colspan="2" class="text-right"><span></span>'.$mybell->number.'</td>
                  <td colspan="3" class="text-right">رقم الفاتوره</td>
                </tr>
                <tr>
                  <td colspan="2" class="text-right">'.$mybell->bell_total_price.'</td>
                  <td colspan="1" class="text-right">اجمالى الفاتوره</td>

                  <td colspan="2" class="text-right">'.$mybell->sell_date.'</td>
                  <td colspan="3" class="text-right"><span>تاريخ الفاتوره</span></td>
                </tr>
                <tr>
                  <td colspan="2" class="text-right">'.$mybell->client_phone.'</td>
                  <td colspan="1" class="text-right"><span>هاتف العميل</span></td>

                  <td colspan="2" class="text-right">'.$mybell->client_name.'</td>
                  <td colspan="3" class="text-right"><span>اسم العميل</span></td>
                </tr>
                <tr>
                  <td colspan="9" class="text-right">المشتريات</td>
                </tr>
                <tr>
                  <tr>
                    <td class="hidden-print">حذف</td>
                    <td class="hidden-print">تعديل</td>
                    <td>السعر الكلى</td>
                    <td>الكميه</td>
                    <td colspan="4">اسم المنتج</td>
                    <td>رقم المنتج</td>
                  </tr>
                </tr>';
             }
            //start get the bell products
            $sales = DB::table('sales')
            ->join('products', 'sales.product_number', '=', 'products.number')
            ->where('sales.sales_bell_number', '=', $sales_bell_number)
            ->select('sales.*', 'products.name')
            ->get();
            foreach ($sales as $mysales){
                echo '<tr>
                    <td class="hidden-print">
                        <a name="delete" class="text-primary text-center" href="sales/delete/sales'.$mysales->number.'"><i title="حذف" class="fa fa-trash"></i></a>
                    </td>
                    <td class="hidden-print">
                        <a name="edit" class="text-primary text-center" href="/sales/get/sales/'.$mysales->number.'"><i title="تعديل" class="fa fa-edit"></i></a>
                    </td>
                     <td>'.$mysales->product_total_price.'</td>
                     <td>'.$mysales->amount.'</td>
                     <td colspan="4">'.$mysales->name.'</td>
                     <td>'.$mysales->product_number.'</td>
                 </tr>';
             }
             //end get the bell products
             echo '<tr>
                <td colspan="9" class="text-right hidden-print">
                    <a name="delete" class="btn btn-primary text-center" href="sales/delete/bell'.$sales_bell_number.'">حذف الفاتوره</a>
                    <button name="print_table" type="button" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
                </td>
                </tr>
            </table>';
            $this->set_current_bell_number($sales_bell_number);
        }
        
    }
   public function create_sales_bell(){
        //create the purchase bell
        $bells_count = DB::table("sales_bells")->max("number") + 1;
        $sales_bell_number = str_pad("$bells_count", 10, "0", STR_PAD_LEFT);
        DB::table("sales_bells")->insert([
            'number'=>$sales_bell_number,
            'sell_date'=>Date("Y-m-d"),
            'client_name'=>request("client_name"),
            'client_phone'=>request("client_phone")
        ]);
        $this->get_sales_bell($sales_bell_number);
        // return "تم انشاء فاتورة البيع";
   }
    public function add_bell_product(){
        $data = $this->validate(request(),[
            "product_number"=>"required",
            "amount"=>'required|numeric',
        ]);
        $sales_bell_number = $this->get_current_bell_number();
        $products_amount = DB::table("products")
        ->where("number", "=", $data['product_number'])
        ->value("amount");


        //start get product price
        $product_total_price = DB::table("products")
        ->where("number", "=", $data['product_number'])
        ->value("sell_price")*$data['amount'];
        //end get product price
        //check the avaliable product's amount
        if($products_amount >=$data['amount']){
            DB::table("sales")->insert([
                'amount'=>$data['amount'],
                'product_total_price'=>$product_total_price,
                'product_number'=>$data['product_number'],
                'sales_bell_number'=>$sales_bell_number
            ]);
            DB::table("products")
            ->where("number", "=", $data['product_number'])
            ->decrement("amount", $data['amount']);
            DB::table("sales_bells")
            ->where("number", "=", $sales_bell_number)
            ->increment("bell_total_price", $product_total_price);
            $this->get_sales_bell($sales_bell_number);
            // return "تم اضافة المنتج الى الفاتوره";
        }else{
            return "amount_not_avaliable";
        }
        
    }
    public function Delete_bell($number){
        DB::table('sales_bells')->where('number', '=', $number)->delete();
    }
    public function Delete_sales($number){
        $sales  = DB::table("sales")
        ->where("number", "=", $number)
        ->get();
        foreach($sales as $mysales){
            DB::table("products")
            ->where("number", "=", $mysales->product_number)
            ->increment("amount", $mysales->amount);
            DB::table("sales_bells")
            ->where("number", "=", $mysales->sales_bell_number)
            ->decrement("bell_total_price", $mysales->product_total_price);
            DB::table('sales')->where('number', '=', $number)->delete();
            //get the correct data and adding it in the table
            $this->get_sales_bell($mysales->sales_bell_number);
        }
        
    }

    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> 'required|numeric'
        ]);
        $sales_bell_number = str_pad($data['search_text'], 10, "0", STR_PAD_LEFT);
        $this->get_sales_bell($sales_bell_number);
    }
    
    public function get_sales_data($number){
        $sales = DB::table('sales')
        ->where('number', '=', $number)
        ->get();
        foreach($sales as $mysales){
            echo '<div class="text-right col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">تحديث</div>

                        <div class="panel-body">
                            
                            <form name="sales" id="update_data" method="post" action="'.url("/sales/update/sales/$mysales->number").'" enctype="multipart/form-data">
                                <div class="form-group col-xs-12">
                                <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                                </div>  
                                
                                <div class="form-group">
                                    <label>الكميه</label>
                                    <input name="amount" type="text" class="text-right form-control" value="'.$mysales->amount.'">
                                </div>
                                
                                <div class="form-group col-sm-12 hidden-print">
                                    <button name="close" type="button" class="btn btn-primary">اغلاق</button>
                                    <button name="update" type="button" class="btn btn-primary"><i class="fa fa-save"></i> تحديث</button>
                                </div>
                                </form>
                        </div>
                    </div>
   </div>';
        }
       
    }
    public function update_sales($number){
            //validating the form data
            $data = $this->validate(request(),[
                'amount' => 'required|numeric',
                ]);
            $sales = DB::table("sales")
            ->where("number", "=", $number)
            ->get();
            foreach($sales as $mysales){
                
                //updating the sales data

                $products_amount = DB::table("products")
                ->where("number", "=", $mysales->product_number)
                ->value("amount");
                //start calculate amount price
                $product_total_price = DB::table("products")
                ->where("number", "=", $mysales->product_number)
                ->value("sell_price")*$data['amount'];
                //end calaculate amount price
                //check the avaliable product's amount
                if($products_amount >=$data['amount']){
                    DB::table("products")
                    ->where("number", "=", $mysales->product_number)
                    ->increment("amount", $mysales->amount);
                    DB::table('sales')
                    ->where('number', '=', $number)
                    ->update([
                        'product_total_price' => $product_total_price,
                        'amount' => $data['amount'],
                    ]);
                    DB::table("products")
                    ->where("number", "=", $mysales->product_number)
                    ->decrement("amount", $data['amount']);
                    $bell_total_price = DB::table('sales')
                    ->where("sales_bell_number", "=", $mysales->sales_bell_number)
                    ->sum("product_total_price");
                    DB::table("sales_bells")
                    ->where("number", "=", $mysales->sales_bell_number)
                    ->update(["bell_total_price" => $bell_total_price]);
                    
                    $this->get_sales_bell($mysales->sales_bell_number);
                }else{
                    return "amount_not_avaliable";
                }
            }

    }
    
}
