<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class department extends Controller
{
    public function get_departments(){
        $departments = DB::table('departments')->limit(10)->get();
        return view('departments', ['departments'=>$departments]);
    }
    public function get_table_data($departments){
        foreach ($departments as $department){
            echo '<tr>
                 <td class="hidden-print">
                 <a name="delete" class="text-primary text-center" href="departments/delete/'.$department->number.'"><i title="حذف" class="fa fa-trash"></i></a>
                 </td>
                 <td class="hidden-print">
                     <a name="edit" class="text-primary text-center" href="/departments/get/department/'.$department->number.'"><i title="تعديل" class="fa fa-edit"></i></a>
                 </td>
                 <td class="">'.$department->name.'</td>
                 <td class="">'.$department->number.'</td>
             </tr>';
         }
    }
    public function add(){
        $data = $this->validate(request(),[
            'name' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
        ]);
        DB::table("departments")->insert($data);
        
       //get the correct data and adding it in the table
       $departments = DB::table('departments')->limit(10)->get();
       $this->get_table_data($departments);
    //    return "تم اضافة القسم بنجاح";
       
    }
    public function Delete($number){
        DB::table('departments')->where('number', '=', $number)->delete();
        //get the correct data and adding it in the table
       $departments = DB::table('departments')->limit(10)->get();
       $this->get_table_data($departments);
    }

    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u']
        ]);
        $departments = DB::table('departments')
        ->where('name', 'like', '%'.$data["search_text"].'%')
        ->orWhere('number', 'like', '%'.$data["search_text"].'%')
        ->get();
        $this->get_table_data($departments);  
    }
    public function get_department_data($number){
        $departments = DB::table('departments')
        ->where('number', '=', $number)
        ->get();
        foreach($departments as $department){
            echo 
            '<div class="panel panel-default">
            <div class="panel-heading">تحديث القسم</div>
            <div class="panel-body">
                <form name="departments" id="update_data" method="post" action="'.url("/departments/update/$department->number").'" enctype="multipart/form-data">
                    
                    <div class="form-group col-xs-12">
                    <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                    </div>  

                    <div class="form-group col-xs-12">
                    <label>اسم القسم</label>
                    <input name="name" type="text" class="text-right form-control" value="'.$department->name.'" placeholder="ادخل الاسم الجديد">
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
    public function update($number){
            //validating the form data
            $data = $this->validate(request(),[
                'name' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u']
            ]);
            //updating the department data
            DB::table('departments')
            ->where('number', '=', $number)
            ->update([
                'name' => $data['name'],
            ]);

            //get the correct data and adding it in the table
            $departments = DB::table('departments')->limit(10)->get();
            $this->get_table_data($departments);
       
        
    }
}
