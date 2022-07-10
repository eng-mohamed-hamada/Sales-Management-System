<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class category extends Controller
{
    public function get_categories(){
        $categories = DB::table('categories')
        ->join("departments", "categories.depart_number", "=", "departments.number")
        ->select("categories.*", "departments.name as department_name")
        ->get();
        return view('categories', ['categories'=>$categories]);
    }
    public function get_table_data($categories){
       foreach ($categories as $category){
           echo '<tr>
                <td class="hidden-print">
                <a name="delete" class="text-primary text-center" href="'.url("categories/delete/".$category->number).'"><i title="حذف" class="fa fa-trash"></i></a>
                </td>
                <td class="hidden-print">
                    <a name="edit" class="text-primary text-center" href="'.url("/categories/get/category/".$category->number).'"><i title="تعديل" class="fa fa-edit"></i></a>
                </td>
                <td class="">'.$category->name.'</td>
                <td class="">'.$category->department_name.'</td>
                <td class="">'.$category->number.'</td>
            </tr>';
        }
    }
    public function add(){
        $data = $this->validate(request(),[
            'name' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
            'depart_number'=>['required']
        ]);
        DB::table("categories")->insert([
            'depart_number'=>$data['depart_number'],
            'name'=>$data['name']
        ]);
        //get the correct data and adding it in the table
       $categories = DB::table('categories')
       ->join("departments", "categories.depart_number", "=", "departments.number")
       ->limit(10)
       ->select("categories.*", "departments.name as department_name")
       ->get();
       $this->get_table_data($categories);
        //return "تم اضافة الصنف";
    }
    public function Delete($number){
        DB::table('categories')->where('number', '=', $number)->delete();
         //get the correct data and adding it in the table
       $categories = DB::table('categories')
       ->join("departments", "categories.depart_number", "=", "departments.number")
        ->limit(10)
        ->select("categories.*", "departments.name as department_name")
        ->get();
       $this->get_table_data($categories);
    }

    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u']
        ]);
        $categories = DB::table('categories')
        ->join("departments", "categories.depart_number", "=", "departments.number")
        ->where('categories.name', 'like', '%'.$data["search_text"].'%')
        ->orWhere('categories.number', 'like', '%'.$data["search_text"].'%')
        ->select("categories.*", "departments.name as department_name")
        ->get();
       $this->get_table_data($categories);   
    }
    public function get_category_data($number){
        $categories = DB::table('categories')
        ->where('number', '=', $number)
        ->get();
        foreach($categories as $category){
            echo 
            '<div class="panel panel-default">
            <div class="panel-heading">تحديث القسم</div>
            <div class="panel-body">
                <form name="categories" id="update_data" method="post" action="'.url("/categories/update/$category->number").'" enctype="multipart/form-data">
                    
                    <div class="form-group col-xs-12">
                    <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                    </div>  

                    <div class="form-group col-xs-12">
                    <label>اسم الصنف</label>
                    <input name="name" type="text" class="text-right form-control" value="'.$category->name.'" placeholder="ادخل الاسم الجديد">
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
            //updating the category data
            DB::table('categories')
            ->where('number', '=', $number)
            ->update([
                'name' => $data['name'],
            ]);
             //get the correct data and adding it in the table
            $categories = DB::table('categories')
            ->join("departments", "categories.depart_number", "=", "departments.number")
            ->limit(10)
            ->select("categories.*", "departments.name as department_name")
            ->get();
            $this->get_table_data($categories);
    }
}
