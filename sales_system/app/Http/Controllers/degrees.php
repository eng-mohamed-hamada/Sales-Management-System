<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class degrees extends Controller
{
    public function get_degrees(){
        $degrees = DB::table('degrees')->limit(10)->get();
        return view('degrees', ['degrees'=>$degrees]);
    }
    public function get_table_data($degrees){
        foreach ($degrees as $degree){
            echo '<tr>
                 <td class="hidden-print">
                 <a name="delete" class="text-primary text-center" href="degrees/delete/'.$degree->number.'"><i title="حذف" class="fa fa-trash"></i></a>
                 </td>
                 <td class="hidden-print">
                     <a name="edit" class="text-primary text-center" href="/degrees/get/degree/'.$degree->number.'"><i title="تعديل" class="fa fa-edit"></i></a>
                 </td>
                 <td class="">'.$degree->name.'</td>
                 <td class="">'.$degree->number.'</td>
             </tr>';
         }
    }
    public function add(){
        $data = $this->validate(request(),[
            'name' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
        ]);
        DB::table("degrees")->insert($data);
        
       //get the correct data and adding it in the table
       $degrees = DB::table('degrees')->limit(10)->get();
       $this->get_table_data($degrees);
       
    }
    public function Delete($number){
        DB::table('degrees')->where('number', '=', $number)->delete();
        //get the correct data and adding it in the table
       $degrees = DB::table('degrees')->limit(10)->get();
       $this->get_table_data($degrees);
    }

    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u']
        ]);
        $degrees = DB::table('degrees')
        ->where('name', 'like', '%'.$data["search_text"].'%')
        ->orWhere('number', 'like', '%'.$data["search_text"].'%')
        ->get();
        $this->get_table_data($degrees);  
    }
    public function get_degree_data($number){
        $degrees = DB::table('degrees')
        ->where('number', '=', $number)
        ->get();
        foreach($degrees as $degree){
            echo 
            '<div class="panel panel-default">
            <div class="panel-heading">تحديث القسم</div>
            <div class="panel-body">
                <form name="degrees" id="update_data" method="post" action="'.url("/degrees/update/$degree->number").'" enctype="multipart/form-data">
                    
                    <div class="form-group col-xs-12">
                    <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                    </div>  

                    <div class="form-group col-xs-12">
                    <label>الدرجه الوظيفيه</label>
                    <input name="name" type="text" class="text-right form-control" value="'.$degree->name.'" placeholder="ادخل الاسم الجديد">
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
            //updating the degree data
            DB::table('degrees')
            ->where('number', '=', $number)
            ->update([
                'name' => $data['name'],
            ]);

            //get the correct data and adding it in the table
            $degrees = DB::table('degrees')->limit(10)->get();
            $this->get_table_data($degrees);
       
        
    }
}
