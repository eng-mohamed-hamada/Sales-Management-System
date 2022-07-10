<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class cost extends Controller
{
    public function get_costs(){
        $costs = DB::table('costs')->limit(10)->get();

        return view('costs', ['costs'=>$costs]);
    }
    public function get_table_data($costs){
        foreach ($costs as $cost){
            echo '<tr>
                <td class="hidden-print">
                    <a name="delete" class="text-primary text-center" href="'.url("costs/delete/".$cost->number).'"><i title="حذف" class="fa fa-trash"></i></a>
                </td>
                <td class="hidden-print">
                    <a name="edit" class="text-primary text-center" href="'.url("/costs/get/cost/".$cost->number).'"><i title="تعديل" class="fa fa-edit"></i></a>
                </td>
                 <td class="">'.$cost->status.'</td>
                 <td class="">'.$cost->description.'</td>
                 <td class="">'.$cost->amount.'</td>
                 <td class="">'.$cost->cost_date.'</td>
                 <td class="">'.$cost->number.'</td>
             </tr>';
         }
         echo '<tr colspan="7">
            <td colspan="8" class="text-right hidden-print">
            <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
            </td>
        </tr>';
    }
    public function add(){
        $data = $this->validate(request(),[
            'amount' => 'required|numeric',
            'description' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
            'status' => 'required',
        ]);
        if($data['status']=="1"){
            $status = "تم الدفع";
        }else{
            $status = "لم يتم الدفع";
        }
        DB::table("costs")->insert([
            'cost_date'=>Date("Y-m-d"),
            'amount'=>$data['amount'],
            'description'=>$data['description'],
            'status'=>$status
        ]);
        //get the correct data and adding it in the table
        $costs = DB::table('costs')->limit(10)->get();
        $this->get_table_data($costs);
        //return "تم اضافة التكلفه";
       
    }
    public function Delete($number){
        DB::table('costs')->where('number', '=', $number)->delete();
        //get the correct data and adding it in the table
        $costs = DB::table('costs')->limit(10)->get();
        $this->get_table_data($costs);
    }

    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u']
        ]);
        $costs = DB::table('costs')
        ->where('number', 'like', '%'.$data["search_text"].'%')
        ->orWhere('cost_date', 'like', '%'.$data["search_text"].'%')
        ->orWhere('amount', 'like', '%'.$data["search_text"].'%')
        ->orWhere('description', 'like', '%'.$data["search_text"].'%')
        ->orWhere('status', 'like', '%'.$data["search_text"].'%')
        ->get();
        //get the correct data and adding it in the table
        $this->get_table_data($costs);   
    }
    
    public function get_cost_data($number){
        $costs = DB::table('costs')
        ->where('number', '=', $number)
        ->get();
        foreach($costs as $cost){
            echo '<div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">تحديث التكاليف</div>

                <div class="panel-body">
                    <form name="costs" id="update_data" method="post" action="'.url("/costs/update/$cost->number").'" enctype="multipart/form-data">
                      <div class="form-group col-xs-12">
                      <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                      </div>  
                        <div class="form-group col-sm-6">
                            <label>المبلغ</label>
                            <input name="amount" type="text" class="text-right form-control" value="'.$cost->amount.'">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>حالة الدفع</label>
                            <select name="status" class="text-right form-control">
                                <option value="1">تم الدفع</option>
                                <option value="0">لم يتم الدفع</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-12">
                            <label>الوصف</label>
                            <textarea rows="5" name="description" class="text-right form-control">'.$cost->description.'</textarea>
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
                'amount' => 'required|numeric',
                'description' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
                'status' => 'required',
            ]);
            if($data['status']=="1"){
                $status = "تم الدفع";
            }else{
                $status = "لم يتم الدفع";
            }
            //updating the cost data
            DB::table('costs')
            ->where('number', '=', $number)
            ->update([
                'amount' => $data['amount'],
                'description' => $data['description'],
                'status' => $status,
            ]);
            //get the correct data and adding it in the table
            $costs = DB::table('costs')->limit(10)->get();
            $this->get_table_data($costs);
    }
}
