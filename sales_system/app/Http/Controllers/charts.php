<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class charts extends Controller
{
    public function check_products(){
        //check products amount 
        $products = DB::table("products")
        ->where("amount", "=", 0)
        ->get();
        
        return $products;
    }
    public function check_debtes(){
        //check debtes dates 
        $debtes = DB::table("debtes")
        ->where("payment_date", "=", Date("Y-m-d"))
        ->get();
        
        return $debtes;
    }

    public function check_borrows(){
        //check check borrows date 
        $borrows = DB::table("borrows")
        ->join("employees", "employees.national_number", "=", "borrows.emp_national_number")
        ->where("last_paymented_mounth", "!=", Date("m"))
        ->where("last_paymented_mounth", "!=", "end")
        ->where("installment_payment_day", "<=", Date("d"))
        ->select("borrows.*", "employees.name as employee_name")
        ->get();
       
        return $borrows;
    }

    public function get_charts(){
        $products = $this->check_products();
        $debtes = $this->check_debtes();
        $borrows = $this->check_borrows();
        
        return view("charts", ['products'=>$products, 'debtes'=>$debtes, 'borrows'=>$borrows]);
    }

}
