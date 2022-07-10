<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class product extends Controller
{
    public function get_products(){
        $products = DB::table('products')->limit(10)->get();
       
        return view('products', ['products'=>$products]);
    }
    public function get_table_data($products){
        foreach ($products as $product){
            echo '<tr>
                <td class="hidden-print">
                    <a name="delete" class="text-primary text-center" href="products/delete/'.$product->number.'"><i title="حذف" class="fa fa-trash"></i></a>
                </td>
                <td class="hidden-print">
                    <a name="edit" class="text-primary text-center" href="/products/get/product/'.$product->number.'"><i title="تعديل" class="fa fa-edit"></i></a>
                </td>
                <td class="hidden-print">
                  <a name="show_photo" href="'.asset("images/$product->photo").'">الصوره</a>
                </td>
                 <td class="">'.$product->amount.'</td>
                 <td class="">'.$product->sell_price.'</td>
                 <td class="">'.$product->name.'</td>
                 <td class="">'.$product->number.'</td>
             </tr>';
         }
         echo '<tr>
          <td colspan="7" class="text-right hidden-print">
            <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
          </td>
        </tr>';
    }
    public function add(){
        $data = $this->validate(request(),[
            'name' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
            'amount' => 'required|numeric',
            'sell_price' => 'required',
            'category_number' => 'required',
        ]);
        $products_count = DB::table("products")->max("number") + 1;
        $product_number = str_pad("$products_count", 10, "0", STR_PAD_LEFT);
        $photo = request()->file('photo');
        if($photo != ""){
          $name = "product_".$product_number.'.jpg';
          $photo->move(public_path('images'), $name);
        }else{
          $name = "products.png";
        }
        DB::table("products")->insert([
            'number'=>$product_number,
            'name'=>$data['name'],
            'amount'=>$data['amount'],
            'sell_price'=>$data['sell_price'],
            'photo'=>$name,
            'category_number'=>$data['category_number'],
        ]);
        //get the correct data and adding it in the table
        $products = DB::table('products')->limit(10)->get();
        $this->get_table_data($products);
        // return "تم اضافة المنتج";
       
    }
    public function Delete($number){
        $old_name = DB::table("products")->where('number', '=', $number)->value("photo");
        if($old_name != "products.png"){
          unlink(public_path('images/'.$old_name));//deleting the old photo
        }
        DB::table('products')->where('number', '=', $number)->delete();
        //get the correct data and adding it in the table
        $products = DB::table('products')->limit(10)->get();
        $this->get_table_data($products);
    }

    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u']
        ]);
        $products = DB::table('products')
        ->where('name', 'like', '%'.$data["search_text"].'%')
        ->orWhere('sell_price', 'like', '%'.$data["search_text"].'%')
        ->orWhere('number', 'like', '%'.$data["search_text"].'%')
        ->orWhere('amount', 'like', '%'.$data["search_text"].'%')
        ->get();
        $this->get_table_data($products);   
    }
    
    public function get_product_data($number){
        $products = DB::table('products')
        ->where('number', '=', $number)
        ->get();
        foreach($products as $product){
            echo '<div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">تحديث المنتجات</div>

                <div class="panel-body">
                    <form name="products" id="update_data" method="post" action="'.url("/products/update/$product->number").'" enctype="multipart/form-data">
                    <div class="form-group col-xs-12">
                    <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                    </div>  

                      <div class="form-group col-sm-6 col-md-4">
                        <label>اسم المنتج</label>
                        <input name="name" type="text" class="text-right form-control" value="'.$product->name.'">
                      </div>
                      <div class="form-group col-sm-6 col-md-4">
                        <label>سعر البيع</label>
                        <input name="sell_price" type="text" class="text-right form-control" value="'.$product->sell_price.'">
                      </div>
                      <div class="form-group col-sm-6 col-md-4">
                        <label>الكميه</label>
                        <input name="amount" type="text" class="text-right form-control" value="'.$product->amount.'">
                      </div>

                      <div class="form-group col-sm-6 col-md-4">
                        <label>الصوره</label>
                        <input name="photo" type="file" class="text-right form-control">
                      </div>
                      <div class="form-group col-sm-6 col-md-4">
                        <label>القسم</label>
                        <select name="depart_number" class="text-right form-control">
                          ';
                          app("departments");
                    echo '
                        </select>
                      </div>
                      <div class="form-group col-sm-12 col-md-4">
                          <label>ألصنف</label>
                          <select name="category_number" class="text-right form-control">
                            
                          </select>
                        </div>
                        <div class="form-group col-sm-12 hidden-print">
                          <button name="close" type="button" class="btn btn-primary">اغلاق</button>
                          <button name="update" type="button" class="btn btn-primary"><i class="fa fa-edit"></i> تحديث</button>
                        </div>
                        
                      </form>
                </div>
            </div>
        </div>';
        }
    }
    public function update($number){
            //validating the form data
            $data = $this->validate(request(),[
                'name' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
                'sell_price' => 'required',
                'amount' => 'required|numeric',
                'category_number' => 'required',
                ]);
            $old_name = DB::table("products")->where('number', '=', $number)->value("photo");
            if($old_name != "products.png"){
              unlink(public_path('images/'.$old_name));//deleting the old photo
            }
            //the new photo
            $photo = request()->file('photo');
            
            if($photo != ""){
              $name = "product_".$number."_update".'.jpg';
              $photo->move(public_path('images'), $name);
            }else{
              $name = "products.png";
            }

            //updating the product data
            DB::table('products')
            ->where('number', '=', $number)
            ->update([
                'name' => $data['name'],
                'sell_price' => $data['sell_price'],
                'photo' => $name,
                'amount' => $data['amount'],
                'category_number' => $data['category_number'],
            ]);

            //get the correct data and adding it in the table
            $products = DB::table('products')->limit(10)->get();
            $this->get_table_data($products);
    }

    public function get_department_categories(){
      $department_number = request("department_number");
      $categories = DB::table("categories")
      ->where("depart_number", "=", $department_number)
      ->get();
      echo '<option value="" selected disabled>---</option>';
      foreach($categories as $category){
          echo '
              <option value="'.$category->number.'">'.$category->name.'</option>
          ';
      }
  }
  public function get_category_products(){
      $category_number = request("category_number");
      $products = DB::table("products")
      ->where("category_number", "=", $category_number)
      ->get();
      echo '<option value="" selected disabled>---</option>';
      foreach($products as $product){
          echo '
              <option value="'.$product->number.'">'.$product->name.'</option>
          ';
      }
  }
}
