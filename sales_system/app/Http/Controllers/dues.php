<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class dues extends Controller
{
    public function get_dues(){
        
        return view('dues');
    }
    public function get_table_data($dues){
      echo '<table class="table text-center table-bordered table-striped table-hover table-condensed">
      <!-- On cells (`td` or `th`) -->
      <thead>
        <tr>
        <th class="text-center hidden-print">حذف</th>
        <th class="text-center hidden-print">تعديل</th>
        <th class="text-center">الوصف</th>
        <th class="text-center">حالة الدفع</th>
        <th class="text-center">تاريخ السداد</th>
        <th class="text-center">المبلغ</th>
        <th class="text-center">تاريخ الدين</th>
        <th class="text-center">العنوان</th>
        <th class="text-center">الهاتف</th>
        <th class="text-center">الاسم</th>
        <th class="text-center">الرقم القومى</th>
        </tr>
      </thead>
      <tbody>';
        foreach ($dues as $due){
          echo '<tr>
          <td class="hidden-print">
              <a name="delete" class="text-primary text-center" href="dues/delete/'.$due->number.'"><i title="حذف" class="fa fa-trash"></i></a>
          </td>
          <td class="hidden-print">
              <a name="edit" class="text-primary text-center" href="/dues/get/dues/'.$due->number.'"><i title="تعديل" class="fa fa-edit"></i></a>
          </td>
           <td class="">'.$due->description.'</td>
           <td class="">'.$due->status.'</td>
           <td class="">'.$due->payment_date.'</td>
           <td class="">'.$due->amount.'</td>
           <td class="">'.$due->debte_date.'</td>
           <td class="">'.$due->address.'</td>
           <td class="">'.$due->phone.'</td>
           <td class="">'.$due->name.'</td>
           <td class="">'.$due->national_number.'</td>
       </tr>';
         }
         echo '<tr>
         <td colspan="11" class="text-right hidden-print">
           <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
         </td>
       </tr>
       </tbody>
       
     </table>';
    }
    public function add(){
        $data = $this->validate(request(),[
            'national_number' => 'required|digits:14',
            'name' => ['required','string','regex:/^(([a-zA-Z]+|[ا-ي])+\s?)+$/u'],
            'phone' => 'required|numeric',
            'address' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
            'payment_date' => 'required|date',
            'amount' => 'required|numeric',
            'status' => 'required',
            'description' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
        ]);

        //check debet status
        if($data["status"] == "1"){
          $status = "تم الدفع";
        }else{
          $status = "لم يتم الدفع";
        }
        DB::table("dues")->insert([
          'national_number'=>$data['national_number'],
          'name'=>$data['name'],
          'address'=>$data['address'],
          'phone'=>$data['phone'],
          'debte_date'=>Date("Y-m-d"),
          'amount'=>$data['amount'],
          'payment_date'=>$data['payment_date'],
          'description'=>$data['description'],
          'status'=>$status
          
        ]);
        //get the correct data and adding it in the table
        $dues = DB::table('dues')->limit(10)->get();
        $this->get_table_data($dues);
      //  return "تم اضافة الدين";
    }
    public function Delete($number){
        DB::table('dues')->where('number', '=', $number)->delete();
        //get the correct data and adding it in the table
        $dues = DB::table('dues')->limit(10)->get();
        $this->get_table_data($dues);
    }

    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> 'required|numeric'
        ]);
        $dues = DB::table('dues')
        ->where('national_number', '=', $data["search_text"])
        ->orWhere('name', 'like', '%'.$data["search_text"].'%')
        ->where('phone', '=', $data["search_text"])
        ->where('address', 'like', '%'.$data["search_text"].'%')
        ->get();
        $this->get_table_data($dues);   
    }
    
    public function get_dues_data($number){
        $dues = DB::table('dues')
        ->where('number', '=', $number)
        ->get();
        foreach($dues as $due){
            echo '<div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">تحديث المستحقات</div>

                <div class="panel-body">
                  <form name="dues" id="update_data" method="post" action="'.url("/dues/update/$number").'" enctype="multipart/form-data">
                    <div class="form-group col-xs-12">
                    <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                    </div>  
                      

                    <div class="form-group  col-sm-12">
                        <label>الرقم القومى للعميل</label>
                        <input name="national_number" type="text" class="text-right form-control" value="'.$due->national_number.'">
                    </div>
                    <div class="form-group  col-sm-12">
                        <label>اسم العميل</label>
                        <input name="name" type="text" class="text-right form-control" value="'.$due->name.'">
                    </div>
                
                    <div class="form-group  col-sm-12">
                        <label>هاتف العميل</label>
                        <input name="phone" type="tel" class="text-right form-control" value="'.$due->phone.'">
                    </div>
                    <div class="form-group  col-sm-12">
                        <label>عنوان العميل</label>
                        <input name="address" type="text" class="text-right form-control" value="'.$due->address.'">
                    </div>
                    
                      
                      <div class="form-group col-sm-6">
                        <label>المبلغ</label>
                        <input name="amount" type="text" class="text-right form-control" value="'.$due->amount.'">
                      </div>
                      <div class="form-group col-sm-6">
                        <label>تاريخ السداد</label>
                        <input name="payment_date" type="date" class="text-right form-control" value="'.$due->payment_date.'">
                      </div>
                      <div class="form-group col-xs-12">
                        <label>حالة الدفع</label>
                        <select name="status" class="text-right form-control">
                          <option value="1">تم الدفع</option>
                          <option value="0">لم يتم الدفع</option>
                        </select>                        </div>
                      <div class="form-group col-sm-12">
                          <label>الوصف</label>
                          <textarea rows="5" name="description" type="text" class="text-right form-control">'.$due->description.'</textarea>
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
    public function update($number){
          //validating the form data
          $data = $this->validate(request(),[
            'national_number' => 'required|digits:14',
            'name' => ['required','string','regex:/^(([a-zA-Z]+|[ا-ي])+\s?)+$/u'],
            'phone' => 'required|numeric',
            'address' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
            'payment_date' => 'required|date',
            'amount' => 'required|numeric',
            'status' => 'required',
            'description' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
          ]);
  
          //check debet status
          if($data["status"] == "1"){
            $status = "تم الدفع";
          }else{
            $status = "لم يتم الدفع";
          }

          DB::table("dues")
          ->where("number", "=", $number)
          ->update([
            'national_number'=>$data['national_number'],
            'name'=>$data['name'],
            'phone'=>$data['phone'],
            'address'=>$data['address'],
            'amount'=>$data['amount'],
            'payment_date'=>$data['payment_date'],
            'description'=>$data['description'],
            'status'=>$status
          ]);
            
            //get the correct data and adding it in the table
            $dues = DB::table('dues')->limit(10)->get();
            $this->get_table_data($dues);
    }
}
