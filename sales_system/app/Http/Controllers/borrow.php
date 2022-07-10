<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class borrow extends Controller
{
    public function get_borrows(){
        $borrows = DB::table('borrows')->limit(10)->get();

        return view('borrows', ['borrows'=>$borrows]);
    }
    public function get_table_data($borrows){
        foreach ($borrows as $borrow){
            echo '<tr>
                <td class="hidden-print">
                    <a name="delete" class="text-primary text-center" href="borrows/delete/'.$borrow->number.'"><i title="حذف" class="fa fa-trash"></i></a>
                </td>
                <td class="hidden-print">
                    <a name="edit" class="text-primary text-center" href="/borrows/get/borrow/'.$borrow->number.'"><i title="تعديل" class="fa fa-edit"></i></a>
                </td>
                 <td class="">'.$borrow->emp_national_number.'</td>
                 <td class="">'.$borrow->total_amount.'</td>
                 <td class="">'.$borrow->benefits.'</td>
                 <td class="">'.$borrow->description.'</td>
                 <td class="">'.$borrow->amount.'</td>
                 <td class="">'.$borrow->borrow_date.'</td>
                 <td class="">'.$borrow->number.'</td>
             </tr>';
         }
    }
    public function add(){
        $data = $this->validate(request(),[
            'amount' => 'required|numeric',
            'paymented_amount' => 'required',
            'installment_amount' => 'required',
            'installment_payment_day' => 'required',
            'description' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
            'benefits' => 'required',
            'emp_national_number' => 'required|digits:14|unique:borrows',
        ]);
        $borrows_count = DB::table("borrows")->max("number") + 1;
        $borrow_number = str_pad("$borrows_count", 10, "0", STR_PAD_LEFT);
        $total_amount = $data['amount'] + $data['benefits'];
        $remiander = $total_amount - $data['paymented_amount'];
        DB::table("borrows")->insert([
            'number'=>$borrow_number,
            'borrow_date'=>date("Y-m-d"),
            'amount'=>$data['amount'],
            'paymented_amount'=>$data['paymented_amount'],
            'installment_amount'=>$data['installment_amount'],
            'installment_payment_day'=>$data['installment_payment_day'],
            'last_paymented_mounth'=>date("m"),
            'remiander'=>$remiander,
            'description'=>$data['description'],
            'benefits'=>$data['benefits'],
            'total_amount'=>$total_amount,
            'emp_national_number'=>$data['emp_national_number'],
        ]);
        //get the correct data and adding it in the table
        $borrows = DB::table('borrows')->limit(10)->get();
        $this->get_table_data($borrows);
       // return "تم اضافة السلفه";
       
    }
    public function Delete($number){
        DB::table('borrows')->where('number', '=', $number)->delete();
        //get the correct data and adding it in the table
        $borrows = DB::table('borrows')->limit(10)->get();
        $this->get_table_data($borrows);
    }

    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u']
        ]);
        $borrows = DB::table('borrows')
        ->where('number', 'like', '%'.$data["search_text"].'%')
        ->orWhere('borrow_date', 'like', '%'.$data["search_text"].'%')
        ->orWhere('amount', 'like', '%'.$data["search_text"].'%')
        ->orWhere('description', 'like', '%'.$data["search_text"].'%')
        ->orWhere('benefits', 'like', '%'.$data["search_text"].'%')
        ->orWhere('total_amount', 'like', '%'.$data["search_text"].'%')
        ->orWhere('emp_national_number', 'like', '%'.$data["search_text"].'%')
        ->get();
        $this->get_table_data($borrows);   
    }
    
    public function get_borrow_data($number){
        $borrows = DB::table('borrows')
        ->where('number', '=', $number)
        ->get();
        foreach($borrows as $borrow){
            echo 
            '<div class="panel panel-default">
            <div class="panel-heading">تحديث السلف</div>
            <div class="panel-body">
                <form name="borrows" id="update_data" method="post" action="'.url("/borrows/update/$borrow->number").'" enctype="multipart/form-data">
                    <div class="form-group col-xs-12">
                    <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                    </div>  
                    
                    <div class="form-group col-sm-6 col-md-4">
                        <label>المبلغ الكلى للسلفه</label>
                        <input name="amount" type="text" class="text-right form-control" placeholder="المبلغ">
                    </div>
                    <div class="form-group col-sm-6 col-md-4">
                        <label>الفوايد</label>
                        <input name="benefits" type="text" class="text-right form-control" placeholder="الفوايد">
                    </div>
                    <div class="form-group col-sm-6 col-md-4">
                        <label>الرقم القومى للموظف</label>
                        <input name="emp_national_number" type="text" class="text-right form-control" placeholder="الرقم القومى للموظف">
                    </div>
                    <div class="form-group col-sm-6 col-md-4">
                          <label>المبلغ المسدد(المقدم)</label>
                          <input name="paymented_amount" type="text" class="text-right form-control" placeholder="المبلغ المسدد">
                        </div>
                        
                        <div class="form-group col-sm-6 col-md-4">
                          <label>قيمة القسط</label>
                          <input name="installment_amount" type="text" class="text-right form-control" placeholder="قيمة القسط">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>يوم دفع القسط</label>
                          <select name="installment_payment_day" class="text-right form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                          </select>
                        </div>
                    <div class="form-group col-xs-12">
                        <label for="exampleInputEmail1">الوصف</label>
                    <textarea name="description" class="text-right form-control" placeholder="اكتب وصف للسلفه"></textarea>
                    </div>

                    <div class="form-group col-sm-12 hidden-print">
                        <button name="close" type="button" class="btn btn-primary">اغلاق</button>
                        <button name="update" type="button" class="btn btn-primary"><i class="fa fa-edit"></i> تحديث</button>
                    </div>
                    
                </form>
            </div>
        </div>';
        }
    }
    public function update($number){
            //validating the form data
            $data = $this->validate(request(),[
                'amount' => 'required|numeric',
                'paymented_amount' => 'required',
                'installment_amount' => 'required',
                'installment_payment_day' => 'required',
                'description' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
                'benefits' => 'required',
                'emp_national_number' => 'required|digits:14|exists:borrows,emp_national_number',
                ]);
            //updating the borrow data
            $total_amount = $data['amount'] + $data['benefits'];
            $remiander = $total_amount - $data['paymented_amount'];
            DB::table('borrows')
            ->where('number', '=', $number)
            ->update([
                'amount' => $data['amount'],
                'paymented_amount'=>$data['paymented_amount'],
                'installment_amount'=>$data['installment_amount'],
                'installment_payment_day'=>$data['installment_payment_day'],
                'remiander'=>$remiander,
                'description' => $data['description'],
                'benefits' => $data['benefits'],
                'total_amount' => $total_amount,
                'emp_national_number' => $data['emp_national_number'],
            ]);
            //get the correct data and adding it in the table
            $borrows = DB::table('borrows')->limit(10)->get();
            $this->get_table_data($borrows);
    }
}
