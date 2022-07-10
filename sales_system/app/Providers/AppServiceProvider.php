<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->singleton("suppliers", function(){
            $suppliers = DB::table('suppliers')->select("number","name")->get();
            echo '<option value="" selected disabled>---</option>';
            foreach($suppliers as $supplier){
                echo '<option value="'.$supplier->number.'">'.$supplier->name.'</option>';
            }
        });
        app()->singleton("departments", function(){
            echo '<option value="" selected disabled>---</option>';
            $departments = DB::table('departments')->select("number","name")->get();
            foreach($departments as $department){
                echo '<option value="'.$department->number.'">'.$department->name.'</option>';
            }
        });

        app()->singleton("degrees", function(){
            echo '<option value="" selected disabled>---</option>';
            $degrees = DB::table('degrees')->select("number","name")->get();
            foreach($degrees as $degree){
                echo '<option value="'.$degree->number.'">'.$degree->name.'</option>';
            }
        });

        app()->singleton("notifiy_count", function(){
            //check products amount 
            $products = DB::table("products")
            ->where("amount", "=", 0)
            ->get();

            //check debtes dates 
            $debtes = DB::table("debtes")
            ->where("payment_date", "=", Date("Y-m-d"))
            ->get();

            //check check borrows date 
            $borrows = DB::table("borrows")
            ->join("employees", "employees.national_number", "=", "borrows.emp_national_number")
            ->where("last_paymented_mounth", "!=", Date("m"))
            ->where("last_paymented_mounth", "!=", "end")
            ->where("last_paymented_mounth", "!=", 0)
            ->where("installment_payment_day", "<=", Date("d"))
            ->select("borrows.*", "employees.name as employee_name")
            ->get();

            $notifiy_count = count($products) + count($debtes) + count($borrows);
            return $notifiy_count;
        });
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
