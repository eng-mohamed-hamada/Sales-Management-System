<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class info extends Controller
{
    public function get_info(){
        $employees = DB::table('employees')->limit(10)->get();
        $employees_count = DB::table('employees')->count();
        $males = DB::table('employees')->where('gender', '=', 'male')->count();
        $females = DB::table('employees')->where('gender', '=', 'female')->count();
        $total_salaries = DB::table('employees')->sum('salary');

        $products_count = DB::table('products')->count();

        $suppliers_count = DB::table('suppliers')->count();

        $departments_count = DB::table('departments')->count();

        $categories_count = DB::table('categories')->count();

        $costs_count = DB::table('costs')->count();
        $total_costs = DB::table('costs')->sum("amount");

        $borrows_count = DB::table('borrows')->count();

        $debtes_count = DB::table('debtes')->count();
        $total_debtes = DB::table('debtes')->sum('amount');

        $dues_count = DB::table('dues')->count();
        $total_dues = DB::table('dues')->sum('amount');

        //start calculate the sales' processes
        $sales_count = DB::table('sales_bells')->count();
        $total_sales = DB::table('sales_bells')->sum('bell_total_price');
        //end calculate the sales' processes

        $purchase_count = DB::table('purchase_bells')->count();
        $total_purchase = DB::table('purchase_bells')->sum('bell_total_price');
        //بداية حساب صافى الارباح
        $products_gain = DB::table('products')
        ->select('amount', 'sell_price')
        ->get();
        $total_products_gain = 0;
        foreach($products_gain as $product){
            $total_products_gain += $product->amount * $product->sell_price;
        }
        $total_gain = $total_products_gain - ($total_costs + $total_purchase);
        //نهاية حساب صافى الارباح
        return view("info", [
            //start employees info
            'employees'=>$employees,
            'employees_count'=>$employees_count,
            'males'=>$males,
            'females'=>$females,
            'total_salaries'=>$total_salaries,
            //end employees info

            //start products info
            'products_count'=>$products_count,
            //end products info

            //start suppliers info
            'suppliers_count'=>$suppliers_count,
            //end suppliers info

            //start departments info
            'departments_count'=>$departments_count,
            //end departments info

            //start categories info
            'categories_count'=>$categories_count,
            //end categories info

            //start costs info
            'costs_count'=>$costs_count,
            'total_costs'=>$total_costs,
            //end costs info

            //start borrows info
            'borrows_count'=>$borrows_count,
            //end borrows info

            //start debtes info
            'debtes_count'=>$debtes_count,
            'total_debtes'=>$total_debtes,
            //end debtes info

            //start dues info
            'dues_count'=>$dues_count,
            'total_dues'=>$total_dues,
            //end dues info

            //start sales info
            'sales_count'=>$sales_count,
            'total_sales'=>$total_sales,
            //end sales info

            //start purchases info
            'purchase_count'=>$purchase_count,
            'total_purchase'=>$total_purchase,
            //end purchases info

            //start gain
            'total_gain'=>$total_gain,
            //end gain
        ]);
    }
}
