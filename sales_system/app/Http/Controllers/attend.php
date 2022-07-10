<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class attend extends Controller
{
    public function get_attendees(){
        $employees = DB::table('employees')
        ->whereNotIn("national_number",
            DB::table("attendees")
            ->where("year", "=", Date("Y"))
            ->where("mounth", "=", Date("m"))
            ->where("day", "=", Date("d"))
            ->pluck("emp_national_number")
        )
        ->get();
        return view('attendees', ['employees'=>$employees]);
    }
    public function add(){
        DB::table("attendees")
        ->where("year", "=", Date("Y"))
        ->where("mounth", "=", Date("m"))
        ->where("day", "=", Date("d"))
        ->delete();
        $total_national_numbers = request("emp_national_number");
        foreach($total_national_numbers as $national_number){
            DB::table("attendees")->insert([
                'year'=>Date("Y"),
                'mounth'=>Date("m"),
                'day'=>Date("d"),
                'emp_national_number'=>$national_number
            ]);
        }
    }
    public function get_searched_employee_data($national_number){
        for($mounth =1; $mounth<=12; $mounth++){
            $attendees = DB::table('attendees')
            ->join("employees", "employees.national_number", "=", "attendees.emp_national_number")
            ->where('employees.national_number', '=', $national_number)
            ->where('attendees.year', '=', Date("Y"))
            ->where('attendees.mounth', '=', $mounth)
            ->select("attendees.*", "employees.name as employee_name")
            ->get();
           if(count($attendees) != 0){
            echo '<table class="table text-center table-bordered table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                    <th class="text-center">حذف</th>
                    <th class="text-center">اليوم</th>
                      <th class="text-center">الشهر</th>
                      <th class="text-center">السنه</th>
                      <th class="text-center">اسم الموظف</th>
                      <th class="text-center">الرقم القومى للموظف</th>
                      </tr>
                    </thead>
                    <tbody>';
                foreach ($attendees as $attend){
                        echo '<tr>
                        <td class="hidden-print">
                            <a name="delete" class="text-primary text-center" href="'.url("attendees/delete/".$attend->number).'"><i title="حذف" class="fa fa-trash"></i></a>
                        </td>
                        <td class="">'.$attend->day.'</td>
                        <td class="">'.$attend->mounth.'</td>
                        <td class="">'.$attend->year.'</td>
                        <td class="">'.$attend->employee_name.'</td>
                        <td class="">'.$attend->emp_national_number.'</td>
                    </tr>';
                
                }
                echo '<tr>
                <td>'.count($attendees).'</td>
                    <td colspan="2">عدد ايام الحضور</td>
                    <td class="">'.$mounth.'</td>
                    <td colspan="2" class="">حضور شهر</td>
                </tr>';
                echo '</tbody>
                </table>';
            }
        }
        echo '
        <div class="form-group hidden-print">
            <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
        </div>
        ';
    }
    public function Delete($number){
        $emp_national_number = DB::table("attendees")
        ->where("number", "=", $number)
        ->value("emp_national_number");
        DB::table('attendees')->where('number', '=', $number)->delete();
        $this->get_searched_employee_data($emp_national_number);
    }
    public function search(){
        $data = $this->validate(request(),[
            'search_text'=> 'required|digits:14'
        ]);
        
        $this->get_searched_employee_data($data["search_text"]);
           
    }
    
}
