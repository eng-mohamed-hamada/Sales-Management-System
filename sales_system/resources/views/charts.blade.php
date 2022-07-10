@extends('layouts.app')

@section('content')
        {{-- Start Statistics --}}

        {{-- End Statistics --}}

        <div class=" text-right col-xs-12">
          <div class="panel panel-default">
              <div class="panel-heading">الاشعارات</div>

              <div class="panel-body">
            
                <div class="myTable table-responsive">
                    @if(count($products) > 0)
                    <table class="table text-center table-bordered table-striped table-hover table-condensed">
                        <tr>
                            <td colspan="5" class="text-center">منتجات غير متوفره</td>
                        </tr>        
                        <tr>
                            <td class="text-center">الكميه المتبقيه</td>
                            <td class="text-center">سعر البيع</td>
                            <td class="text-center">اسم المنتج</td>
                            <td class="text-center">رقم المنتج</td>
                            </tr>
                        
                    @foreach ($products as $product)
                        <tr>
                             <td class="">{{$product->amount}}</td>
                             <td class="">{{$product->sell_price}}</td>
                             <td class="">{{$product->name}}</td>
                             <td class="">{{$product->number}}</td>
                         </tr>
                     @endforeach
                     <tr>
                      <td colspan="5" class="text-right hidden-print">
                        <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
                      </td>
                    </tr>
                    </table>
                    @endif
                
                    @if(count($debtes) > 0)
                    <table class="table text-center table-bordered table-striped table-hover table-condensed">
                        <tr>
                            <td colspan="5" class="text-center">ديون جاء موعد سدادها</td>
                        </tr> 
                        <tr>
                            <td class="text-center">الوصف</td>
                            <td class="text-center">المبلغ</td>
                            <td class="text-center">تاريخ السداد</td>
                            <td class="text-center">تاريخ الدين</td>
                            <td class="text-center">رقم الدين</td>
                            </tr>
                        
                    @foreach ($debtes as $debte)
                        <tr>
                             <td class="">{{$debte->description}}</td>
                             <td class="">{{$debte->amount}}</td>
                             <td class="">{{$debte->payment_date}}</td>
                             <td class="">{{$debte->debte_date}}</td>
                             <td class="">{{$debte->number}}</td>
                         </tr>
                         @endforeach
                     <tr>
                      <td colspan="5" class="text-right hidden-print">
                        <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
                      </td>
                    </tr>
                    </table>
                    @endif
                
            
                    @if(count($borrows) > 0)
                    <table class="table text-center table-bordered table-striped table-hover table-condensed">
                            <tr>
                                <td colspan="6" class="text-center">لم يتم سداد اقساط هذه السلف</td>
                            </tr> 
                            <tr>
                            <td class="text-center">المبلغ الكلى</td>
                            <td class="text-center">الفوايد</td>
                            <td class="text-center">المبلغ</td>
                            <td class="text-center">تاريخ السلفه</td>
                            <td class="text-center">اسم الموظف</td>
                            <td class="text-center">رقم السلفه</td>
                            </tr>
                        
                    @foreach ($borrows as $borrow)
                        <tr>
                             <td class="">{{$borrow->total_amount}}</td>
                             <td class="">{{$borrow->benefits}}</td>
                             <td class="">{{$borrow->amount}}</td>
                             <td class="">{{$borrow->borrow_date}}</td>
                             <td class="">{{$borrow->employee_name}}</td>
                             <td class="">{{$borrow->number}}</td>
                         </tr>
                         @endforeach
                     <tr>
                      <td colspan="6" class="text-right hidden-print">
                        <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
                      </td>
                    </tr>
                    </table>
                    @endif
                
                </div>
              </div>
          </div>
      </div>
   
@endsection
