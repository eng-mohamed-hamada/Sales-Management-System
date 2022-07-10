<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class debtes extends Controller
{
    public function get_debtes(){
        
        return view('debtes');
    }
    public function get_table_data($debtes){
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
        <th class="text-center">رقم المورد/الشركه</th>
        </tr>
      </thead>
      <tbody>';
        foreach ($debtes as $debte){
          echo '<tr>
          <td class="hidden-print">
              <a name="delete" class="text-primary text-center" href="debtes/delete/'.$debte->number.'"><i title="حذف" class="fa fa-trash"></i></a>
          </td>
          <td class="hidden-print">
              <a name="edit" class="text-primary text-center" href="/debtes/get/debtes/'.$debte->number.'"><i title="تعديل" class="fa fa-edit"></i></a>
          </td>
           <td class="">'.$debte->description.'</td>
           <td class="">'.$debte->status.'</td>
           <td class="">'.$debte->payment_date.'</td>
           <td class="">'.$debte->amount.'</td>
           <td class="">'.$debte->debte_date.'</td>
           <td class="">'.$debte->supplier_number.'</td>
       </tr>';
         }
         echo '<tr>
         <td colspan="8" class="text-right hidden-print">
           <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
         </td>
       </tr>
       </tbody>
       
     </table>';
    }
    public function add(){
        $data = $this->validate(request(),[
            'supplier_number' => 'required|numeric',
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
        DB::table("debtes")->insert([
          'debte_date'=>Date("Y-m-d"),
          'amount'=>$data['amount'],
          'payment_date'=>$data['payment_date'],
          'description'=>$data['description'],
          'status'=>$status,
          'supplier_number'=>$data['supplier_number']
        ]);
        //get the correct data and adding it in the table
        $debtes = DB::table('debtes')->limit(10)->get();
        $this->get_table_data($debtes);
      //  return "تم اضافة الدين";
    }
    public function Delete($number){
        DB::table('debtes')->where('number', '=', $number)->delete();
        //get the correct data and adding it in the table
        $debtes = DB::table('debtes')->limit(10)->get();
        $this->get_table_data($debtes);
    }

    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> 'required|numeric'
        ]);
        $debtes = DB::table('debtes')
        ->where('supplier_number', '=', $data["search_text"])
        ->get();
        $this->get_table_data($debtes);   
    }
    
    public function get_debtes_data($number){
        $debtes = DB::table('debtes')
        ->where('number', '=', $number)
        ->get();
        foreach($debtes as $debte){
            echo '<div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">تحديث الدين</div>

                <div class="panel-body">
                  <form name="debtes" id="update_data" method="post" action="'.url("/debtes/update/$number").'" enctype="multipart/form-data">
                    <div class="form-group col-xs-12">
                    <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                    </div>  
                      

                      <div class="form-group col-xs-12">
                        <label>المورد/الشركة(صاحب الدين)</label>
                        <select name="supplier_number" class="text-right form-control">
                          ';
                          app("suppliers");
                          echo '
                        </select>
                      </div>
                    
                      
                      <div class="form-group col-sm-6">
                        <label>المبلغ</label>
                        <input name="amount" type="text" class="text-right form-control" value="'.$debte->amount.'">
                      </div>
                      <div class="form-group col-sm-6">
                        <label>تاريخ السداد</label>
                        <input name="payment_date" type="date" class="text-right form-control" value="'.$debte->payment_date.'">
                      </div>
                      <div class="form-group col-xs-12">
                        <label>حالة الدفع</label>
                        <select name="status" class="text-right form-control">
                          <option value="1">تم الدفع</option>
                          <option value="0">لم يتم الدفع</option>
                        </select>                        </div>
                      <div class="form-group col-sm-12">
                          <label>وصف الدين</label>
                          <textarea rows="5" name="description" type="text" class="text-right form-control">'.$debte->description.'</textarea>
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
            'supplier_number' => 'required|numeric',
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

          DB::table("debtes")
          ->where("number", "=", $number)
          ->update([
            'amount'=>$data['amount'],
            'payment_date'=>$data['payment_date'],
            'description'=>$data['description'],
            'status'=>$status,
            'supplier_number'=>$data['supplier_number']
          ]);
            
            //get the correct data and adding it in the table
            $debtes = DB::table('debtes')->limit(10)->get();
            $this->get_table_data($debtes);
    }
}
