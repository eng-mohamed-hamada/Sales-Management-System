@extends('layouts.app')

@section('content')
       {{-- start employees info --}}
        <div class=" text-right col-xs-12">
          <div class="panel panel-default">
              <div class="panel-heading">الاحصائيات</div>

              <div class="panel-body">
                <div class="myTable table-responsive">
                    <table class="table text-center table-bordered table-striped table-hover table-condensed">
                        <tr>
                            <td>موظف</td>
                            <td>{{$employees_count}}</td>
                            <td>اجمالى الموظفين</td>
                        </tr>
                        <tr>
                            <td>موظف</td>
                            <td>{{$males}}</td>
                            <td>اجمالى الذكور</td>
                        </tr>
                        <tr>
                            <td>موظف</td>
                            <td>{{$females}}</td>
                            <td>اجمالى الاناث</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td>{{$total_salaries}}</td>
                            <td>اجمالى الرواتب</td>
                        </tr>
                        <tr>
                            <td>منتج</td>
                            <td>{{$products_count}}</td>
                            <td>اجمالى المنتجات</td>
                        </tr>
                        <tr>
                            <td>مورد</td>
                            <td>{{$suppliers_count}}</td>
                            <td>اجمالى الموردين</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td>{{$total_costs}}</td>
                            <td>اجمالى التكاليف</td>
                        </tr>
                        <tr>
                            <td>قسم</td>
                            <td>{{$departments_count}}</td>
                            <td>اجمالى الاقسام</td>
                        </tr>
                        <tr>
                            <td>صنف</td>
                            <td>{{$categories_count}}</td>
                            <td>اجمالى الاصناف</td>
                        </tr>
                        <tr>
                            <td>سلفه</td>
                            <td>{{$borrows_count}}</td>
                            <td>عدد السلف</td>
                        </tr>
                        <tr>
                            <td>دين</td>
                            <td>{{$debtes_count}}</td>
                            <td>عدد الديون</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td>{{$total_debtes}}</td>
                            <td>اجمالى الديون</td>
                        </tr>
                        <tr>
                            <td>مستحقات</td>
                            <td>{{$dues_count}}</td>
                            <td>عدد المستحقات</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td>{{$total_dues}}</td>
                            <td>اجمالى المستحقات</td>
                        </tr>
                        <tr>
                            <td>مبيعات</td>
                            <td>{{$sales_count}}</td>
                            <td>عدد المبيعات</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td>{{$total_sales}}</td>
                            <td>اجمالى المبيعات</td>
                        </tr>
                        <tr>
                            <td>مشتريات</td>
                            <td>{{$purchase_count}}</td>
                            <td>عدد المشتريات</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td>{{$total_purchase}}</td>
                            <td>اجمالى المشتريات</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td>{{$total_gain}}</td>
                            <td>اجمالى الارباح بعد خصم (المشتريات والتكاليف)</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right hidden-print">
                            <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
                            </td>
                        </tr>
                    </table>
                  </div>
              </div>
          </div>
      </div>
      {{-- end employees info --}}
@endsection
