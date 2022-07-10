<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class installment extends Controller
{
    public function get_installments(){
        return view('installments');
    }
    public function get_table_data($installments){
        foreach ($installments as $installment){
            echo '<tr>
                <td class="hidden-print">
                    <a name="edit" class="text-primary text-center" href="/installments/get/installment/'.$installment->number.'"><i title="تعديل" class="fa fa-edit"></i></a>
                </td>
                 <td class="">'.$installment->borrow_number.'</td>
                 <td class="">'.$installment->amount.'</td>
                 <td class="">'.$installment->payment_date.'</td>
                 <td class="">'.$installment->number.'</td>
             </tr>';
         }
    }
    public function add(){
        $data = $this->validate(request(),[
            'amount' => 'required|numeric',
            'borrow_number' => 'required|exists:borrows,number',
        ]);
        
        $remiander =  DB::table('borrows')
        ->where("number", "=", $data['borrow_number'])
        ->value("remiander");
        if($remiander- $data["amount"] >= 0){
            DB::table("installments")->insert([
                'payment_date'=>date("Y-m-d"),
                'amount'=>$data['amount'],
                'borrow_number'=>$data['borrow_number']
            ]);
            //update last paymented mounth
            DB::table('borrows')
            ->where("number", "=", $data['borrow_number'])
            ->update([
                'remiander'=>$remiander - $data['amount'],
                'last_paymented_mounth'=>date("m")
            ]);
            //get the correct data and adding it in the table
            $installments = DB::table('installments')->get();
            $this->get_table_data($installments);
            // return "تم سداد القسط";
        }else{
            DB::table('borrows')
            ->where("number", "=", $data['borrow_number'])
            ->update([
                'last_paymented_mounth'=> "end"
            ]);
            return "borrow_end";
        }
        
        
       
    }

    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u']
        ]);
        $installments = DB::table('installments')
        ->where('borrow_number', 'like', '%'.$data["search_text"].'%')
        ->get();
        $this->get_table_data($installments);   
    }
    
    public function get_installment_data($number){
        $installments = DB::table('installments')
        ->where('number', '=', $number)
        ->get();
        foreach($installments as $installment){
            echo '<div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">تحديث الاقساط</div>

                <div class="panel-body">
                    <form name="installments" id="update_data" method="post" action="'.url("/installments/update/$installment->number").'" enctype="multipart/form-data">
                      <div class="form-group col-xs-12">
                      <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                      </div>  
                       
                        <div class="form-group col-xs-12">
                          <label>المبلغ</label>
                          <input name="amount" type="text" class="text-right form-control" placeholder="المبلغ">
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
            ]);
            $borrow_number = DB::table("installments")
            ->where("number", "=", $number)
            ->value("borrow_number");
            //updating the installment data
            $old_amount = DB::table("installments")
            ->where("number", "=", $number)
            ->value("amount");

            DB::table("borrows")
            ->where("number", "=", $borrow_number)
            ->increment("remiander",$old_amount);

            
            
            //check remianer amount
            $remiander =  DB::table('borrows')
            ->where("number", "=", $borrow_number)
            ->value("remiander");
            if($remiander- $data["amount"] >= 0){
                DB::table('installments')
                ->where('number', '=', $number)
                ->update([
                    'amount' => $data['amount'],
                    'borrow_number' => $borrow_number,
                ]);

                DB::table("borrows")
                ->where("number", "=", $borrow_number)
                ->decrement("remiander",$data['amount']);
                //get the correct data and adding it in the table
                $installments = DB::table('installments')->limit(10)->get();
                $this->get_table_data($installments);
            }else{
                DB::table("borrows")
                ->where("number", "=", $borrow_number)
                ->update([
                    "remiander"=>$remiander - $old_amount,
                    "last_paymented_mounth"=> "end"
                ]);
                return "borrow_end";
            }
    }
}
