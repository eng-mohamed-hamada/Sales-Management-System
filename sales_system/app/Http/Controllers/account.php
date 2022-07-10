<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class account extends Controller
{
    public function get_accounts(){
        $accounts = DB::table('accounts')->get();
        return view('accounts', ['accounts'=>$accounts]);
    }
    public function get_table_data($accounts){
        foreach ($accounts as $account){
            echo '<tr>
                 <td class="hidden-print">
                 <a name="delete" class="text-primary text-center" href="accounts/delete/'.$account->national_number.'"><i title="حذف" class="fa fa-trash"></i></a>
                 </td>
                 <td class="hidden-print">
                     <a name="edit" class="text-primary text-center" href="/accounts/get/account/'.$account->national_number.'"><i title="تعديل" class="fa fa-edit"></i></a>
                 </td>
                 <td class="">'.$account->permission.'</td>
                 <td class="">'.$account->name.'</td>
                 <td class="">'.$account->national_number.'</td>
             </tr>';
         }
    }
    public function add(){
        
        $data = $this->validate(request(),[
            'national_number' => 'required|digits:14',
            'name' => ['required','string','regex:/^(([a-zA-Z]+|[ا-ي])+\s?)+$/u'],
            'permission' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
        ]);
        DB::table("accounts")->insert([
            'national_number'=>$data['national_number'],
            'name'=>$data['name'],
            'permission'=>$data['permission'],
        ]);
        //get the correct data and adding it in the table
       $accounts = DB::table('accounts')->get();
       $this->get_table_data($accounts);
       
    }

    public function Delete($national_number){
        DB::table('users')->where('national_number', '=', $national_number)->delete();
        DB::table('accounts')->where('national_number', '=', $national_number)->delete();
        //get the correct data and adding it in the table
       $accounts = DB::table('accounts')->get();
       $this->get_table_data($accounts);
    }

    public function search(){
        
        $data = $this->validate(request(),[
            'search_text'=> ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u']
        ]);
        $accounts = DB::table('accounts')
        ->where('name', 'like', '%'.$data["search_text"].'%')
        ->orWhere('national_number', 'like', '%'.$data["search_text"].'%')
        ->orWhere('permission', 'like', '%'.$data["search_text"].'%')
        ->get();
        $this->get_table_data($accounts);  
    }

    public function get_account_data($national_number){
        $accounts = DB::table('accounts')
        ->where('national_number', '=', $national_number)
        ->get();
        foreach($accounts as $account){
            echo 
            '<div class="panel panel-default">
            <div class="panel-heading">تحديث المستخدم</div>
            <div class="panel-body">
                <form name="accounts" id="update_data" method="post" action="'.url("/accounts/update/$account->national_number").'" enctype="multipart/form-data">
                    
                    <div class="form-group col-xs-12">
                    <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                    </div>  

                    <div class="form-group col-xs-12">
                    <label>اسم المستخدم</label>
                    <input name="name" type="text" class="text-right form-control" value="'.$account->name.'" placeholder="ادخل الاسم الجديد">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>الصلاحيه</label>
                        <select name="permission" class="text-right form-control">
                          <option selected>---</option>
                          <option value="user">مستخدم</option>
                          <option value="admin">مسؤل</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                    <button name="close" type="button" class="btn btn-primary">اغلاق</button>
                    <button name="update" type="button" class="btn btn-primary"><i class="fa fa-save"></i> تحديث</button>
                    </div>

                </form>
            </div>
        </div>';
        }
        
    }
    public function update($national_number){
            
            //validating the form data
            $data = $this->validate(request(),[
                'name' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
                'permission' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u']
            ]);
            //updating the department data
            DB::table('accounts')
            ->where('national_number', '=', $national_number)
            ->update([
                'name' => $data['name'],
                'permission' => $data['permission'],
            ]);

            //get the correct data and adding it in the table
            $accounts = DB::table('accounts')->get();
            $this->get_table_data($accounts);
       
        
    }

}
