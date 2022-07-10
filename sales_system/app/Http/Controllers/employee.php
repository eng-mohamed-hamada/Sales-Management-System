<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class employee extends Controller
{
    public function get_employees(){
        $employees = DB::table('employees')->limit(10)->get();

        return view('employees', ['employees'=>$employees]);
    }
    public function get_table_data($employees){
        foreach ($employees as $employee){
            echo '<tr>
                <td class="hidden-print">
                    <a name="delete" class="text-primary text-center" href="employees/delete/'.$employee->national_number.'"><i title="حذف" class="fa fa-trash"></i></a>
                </td>
                <td class="hidden-print">
                    <a name="edit" class="text-primary text-center" href="/employees/get/employee/'.$employee->national_number.'"><i title="تعديل" class="fa fa-edit"></i></a>
                </td>
                <td class="hidden-print">
                  <a name="show_photo" href="'.asset("images/$employee->photo").'">الصوره</a>
                </td>
                 <td class="">'.$employee->hiring_date.'</td>
                 <td class="">'.$employee->age.'</td>
                 <td class="">'.$employee->gender.'</td>
                 <td class="">'.$employee->salary.'</td>
                 <td class="">'.$employee->address.'</td>
                 <td class="">'.$employee->name.'</td>
                 <td class="">'.$employee->phone.'</td>
                 <td class="">'.$employee->national_number.'</td>
             </tr>';
         }
    }
    public function add(){
        $data = $this->validate(request(),[
            'national_number' => 'required|digits:14|unique:employees',
            'phone' => 'required|numeric',
            'name' => ['required','string','regex:/^(([a-zA-Z]+|[ا-ي])+\s?)+$/u'],
            'address' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
            'birth_year' => 'required',
            'hiring_date' => 'required|date',
            'salary' => 'required|numeric',
            'gender' => 'required',
            'depart_number' => 'required',
            'degree_number' => 'required',
        ]);
        $photo = request()->file('photo');
        if($photo != ""){
          $name = "employee_".$data['national_number'].'.jpg';
          $photo->move(public_path('images'), $name);
        }else{
          $name = "default.jpg";
        }
        $age = Date("Y") - $data['birth_year'];
        DB::table("employees")->insert([
            'national_number' => $data['national_number'],
            'phone' => $data['phone'],
            'name' => $data['name'],
            'photo' => $name,
            'address' => $data['address'],
            'age' => $age,
            'hiring_date' => $data['hiring_date'],
            'salary' => $data['salary'],
            'gender' => $data['gender'],
            'depart_number' => $data['depart_number'],
            'degree_number' => $data['degree_number'],
        ]);
        //get the correct data and adding it in the table
        $employees = DB::table('employees')->limit(10)->get();
        $this->get_table_data($employees);
        // return "تم اضافة الموظف بنجاح";
       
    }
    public function Delete($national_number){
        $old_name = DB::table("employees")->where('national_number', '=', $national_number)->value("photo");
        if($old_name != "default.jpg"){
          unlink(public_path('images/'.$old_name));//deleting the old photo
        }
        DB::table('employees')->where('national_number', '=', $national_number)->delete();
        
        //get the correct data and adding it in the table
        $employees = DB::table('employees')->limit(10)->get();
        $this->get_table_data($employees);
    }

    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u']
        ]);
        $employees = DB::table('employees')
        ->where('name', 'like', '%'.$data["search_text"].'%')
        ->orWhere('phone', 'like', '%'.$data["search_text"].'%')
        ->orWhere('national_number', 'like', '%'.$data["search_text"].'%')
        ->orWhere('gender', 'like', '%'.$data["search_text"].'%')
        ->orWhere('address', 'like', '%'.$data["search_text"].'%')
        ->orWhere('salary', 'like', '%'.$data["search_text"].'%')
        ->orWhere('age', '=', $data["search_text"])
        ->get();
        $this->get_table_data($employees);   
    }
    
    public function get_employee_data($national_number){
        $employees = DB::table('employees')
        ->where('national_number', '=', $national_number)
        ->get();
        foreach($employees as $employee){
            echo '<div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">تحديث الموظفين</div>

                <div class="panel-body">
                    <form name="employees" id="update_data" method="post" action="'.url("/employees/update/$national_number").'" enctype="multipart/form-data">
                      <div class="form-group col-xs-12">
                      <input id="_token" name="_token" type="hidden" value="'.csrf_token().'">
                      </div>  
                      <div class="form-group col-sm-6 col-md-4">
                          <label>هاتف الموظف</label>
                          <input name="phone" type="text" class="text-right form-control" value="'.$employee->phone.'">
                        </div>
                        
                        <div class="form-group col-sm-6 col-md-4">
                          <label>عنوان الموظف</label>
                          <input name="address" type="text" class="text-right form-control" value="'.$employee->address.'">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>اسم الموظف</label>
                          <input name="name" type="text" class="text-right form-control" value="'.$employee->name.'">
                        </div>

                        
                        <div class="form-group col-sm-6 col-md-4">
                          <label>مرتب الموظف</label>
                          <input name="salary" type="text" class="text-right form-control" value="'.$employee->salary.'">
                        </div>
                        
                        <div class="form-group col-sm-6 col-md-4">
                          <label>تاريخ التعيين</label>
                          <input name="hiring_date" type="date" class="text-right form-control" value="'.$employee->hiring_date.'">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>سنة الميلا</label>
                          <input name="birth_year" type="text" class="text-right form-control">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>صورة الموظف</label>
                          <input name="photo" type="file" class="text-right form-control">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>النوع</label>
                          <select name="gender" class="text-right form-control">
                            <option value="male">ذكر</option>
                            <option value="female">أنثى</option>
                          </select>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>القسم</label>
                          <select name="depart_number" class="text-right form-control">
                            ';
                            app("departments");
                          echo '</select>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>الدرجه الوظيفيه</label>
                          <select name="degree_number" class="text-right form-control">
                            ';
                            app("degrees");
                          echo '</select>
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
    public function update($national_number){
            //validating the form data
            $data = $this->validate(request(),[
                'phone' => 'required|numeric',
                'name' => ['required','string','regex:/^(([a-zA-Z]+|[ا-ي])+\s?)+$/u'],
                'address' => ['required','string','regex:/^((\w+|[ا-ي])+\s?)+$/u'],
                'birth_year' => 'required',
                'hiring_date' => 'required|date',
                'salary' => 'required|numeric',
                'gender' => 'required',
                'depart_number' => 'required',
                'degree_number' => 'required',
                ]);
            $age = Date("Y") - $data['birth_year'];

            $old_name = DB::table("employees")->where('national_number', '=', $national_number)->value("photo");
            if($old_name != "default.jpg"){
              unlink(public_path('images/'.$old_name));//deleting the old photo
            }
            //the new photo
            $photo = request()->file('photo');
            
            if($photo != ""){
              $name = "employee_".$national_number."_update".'.jpg';
              $photo->move(public_path('images'), $name);
            }else{
              $name = "default.jpg";
            }
            //updating the employee data
            DB::table('employees')
            ->where('national_number', '=', $national_number)
            ->update([
                'phone' => $data['phone'],
                'name' => $data['name'],
                'address' => $data['address'],
                'age' => $age,
                'photo' => $name,
                'hiring_date' => $data['hiring_date'],
                'salary' => $data['salary'],
                'gender' => $data['gender'],
                'depart_number' => $data['depart_number'],
                'degree_number' => $data['degree_number']
            ]);

            //get the correct data and adding it in the table
            $employees = DB::table('employees')->limit(10)->get();
            $this->get_table_data($employees);
    }
}
