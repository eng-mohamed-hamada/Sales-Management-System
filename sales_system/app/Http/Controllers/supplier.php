<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class supplier extends Controller
{
    public function get_suppliers(){
        $suppliers = DB::table('suppliers')->limit(10)->get();
        
        return view('suppliers', ['suppliers'=>$suppliers]);
    }
    public function get_table_data($suppliers){
        
        foreach ($suppliers as $supplier){
            echo '<tr>
                <td class="hidden-print">
                    <a name="delete" class="text-primary text-center" href="suppliers/delete/'.$supplier->number.'"><i title="حذف" class="fa fa-trash"></i></a>
                </td>
                <td class="hidden-print">
                    <a name="edit" class="text-primary text-center" href="/suppliers/get/supplier/'.$supplier->number.'"><i title="تعديل" class="fa fa-edit"></i></a>
                </td>
                 <td>'.$supplier->whatsapp_phone.'</td>
                 <td><a href="'.$supplier->facebook_url.'">'.$supplier->facebook_url.'</a></td>
                 <td><a href="'.$supplier->app_url.'">'.$supplier->app_url.'</a></td>
                 <td>'.$supplier->address.'</td>
                 <td>'.$supplier->name.'</td>
                 <td>'.$supplier->phone.'</td>
                 <td>'.$supplier->number.'</td>
             </tr>';
         }
         echo '<tr>
                <td colspan="9" class="text-right hidden-print">
                <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
                </td>
            </tr>';
    }
    public function add(){
        $data = $this->validate(request(),[
            'phone' => 'required|numeric',
            'name' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
            'address' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
            'whatsapp_phone' => ['nullable','numeric'],
            'facebook_url' => ['nullable','url'],
            'app_url' => ['nullable','url'],
        ]);


        
        DB::table("suppliers")->insert([
            'phone' => $data['phone'],
            'name' => $data['name'],
            'address' => $data['address'],
            'whatsapp_phone' => $data['whatsapp_phone'],
            'facebook_url' => $data['facebook_url'],
            'app_url' => $data['app_url'],
        ]);
        //get the correct data and adding it in the table
        $suppliers = DB::table('suppliers')->limit(10)->get();
        $this->get_table_data($suppliers);
    }
    public function Delete($number){
        DB::table('suppliers')->where('number', '=', $number)->delete();
        //get the correct data and adding it in the table
        $suppliers = DB::table('suppliers')->limit(10)->get();
        $this->get_table_data($suppliers);
    }

    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u']
        ]);
        $suppliers = DB::table('suppliers')
        ->where('name', 'like', '%'.$data["search_text"].'%')
        ->orWhere('phone', 'like', '%'.$data["search_text"].'%')
        ->orWhere('address', 'like', '%'.$data["search_text"].'%')
        ->get();
        $this->get_table_data($suppliers);   
    }
    
    public function get_supplier_data($number){
        $suppliers = DB::table('suppliers')
        ->where('number', '=', $number)
        ->get();
        foreach($suppliers as $supplier){
            echo '<div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">تحديث الموردين</div>

                <div class="panel-body">
                    <form name="suppliers" id="update_data" method="post" action="'.url("/suppliers/update/$supplier->number").'" enctype="multipart/form-data">
                      <div class="form-group col-xs-12">
                      <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                      </div>  
                      <div class="form-group col-sm-6 col-md-4">
                          <label>هاتف المورد</label>
                          <input name="phone" type="text" class="text-right form-control" value="'.$supplier->phone.'">
                        </div>
                                               
                        <div class="form-group col-sm-6 col-md-4">
                          <label>اسم المورد</label>
                          <input name="name" type="text" class="text-right form-control" value="'.$supplier->name.'">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <label>عنوان المورد</label>
                            <input name="address" type="text" class="text-right form-control" value="'.$supplier->address.'">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                          <label>رقم هاتف الوتساب</label>
                          <input name="whatsapp_phone" type="text" class="text-right form-control" value="'.$supplier->whatsapp_phone.'">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                          <label>رابط الفيسبوك</label>
                          <input name="facebook_url" type="url" class="text-right form-control" value="'.$supplier->facebook_url.'">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                          <label>رابط الموقع / التطبيق</label>
                          <input name="app_url" type="url" class="text-right form-control" value="'.$supplier->app_url.'">
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
                'phone' => 'required|numeric',
                'name' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
                'address' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
                'whatsapp_phone' => ['nullable','numeric'],
                'facebook_url' => ['nullable','url'],
                'app_url' => ['nullable','url'],
            ]);
           
            
            //updating the supplier data
            DB::table('suppliers')
            ->where('number', '=', $number)
            ->update([
                'phone' => $data['phone'],
                'name' => $data['name'],
                'address' => $data['address'],
                'whatsapp_phone' => $data['whatsapp_phone'],
                'facebook_url' => $data['facebook_url'],
                'app_url' => $data['app_url'],
            ]);

            //get the correct data and adding it in the table
            $suppliers = DB::table('suppliers')->limit(10)->get();
            $this->get_table_data($suppliers);
    }
}
