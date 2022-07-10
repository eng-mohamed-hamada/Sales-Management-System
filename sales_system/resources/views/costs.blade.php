@extends('layouts.app')

@section('content')
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">التكاليف</div>

                <div class="panel-body">
                    
                    <form name="costs" id="basic_data" method="post" action="{{url("/costs/add")}}" enctype="multipart/form-data">
                      <div class="form-group">
                      <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
                      </div>  

                        <div class="form-group col-sm-6">
                          <label>المبلغ</label>
                          <input name="amount" type="text" class="text-right form-control" placeholder="المبلغ">
                        </div>

                        <div class="form-group col-sm-6">
                          <label>حالة الدفع</label>
                          <select name="status" class="text-right form-control">
                            <option value="1">تم الدفع</option>
                            <option value="0">لم يتم الدفع</option>
                          </select>
                        </div>

                        <div class="form-group col-sm-12">
                          <label>الوصف</label>
                        <textarea rows="5" name="description" class="text-right form-control" placeholder="اكتب وصف للتكلفه"></textarea>
                        </div>
                                               
                        <div class="form-group col-sm-12">
                          <button name="add" type="button" class="btn btn-primary"><i class="fa fa-save"></i> حفظ</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
        {{-- the table --}}

        <div class="myContainer text-right col-xs-12">
          <div class="panel panel-default">
              <div class="panel-heading">عمليات البحث</div>

              <div class="panel-body">
                {{-- start search box --}}
                <form id="search_form" name="costs" action="{{url("costs/search")}}" class="form-group ">
                    <div class="input-group">
                      <input id="search_text" type="text" class="text-right form-control" placeholder="الاسم/رقم التلفون/الرقم القومى/النوع/العنوان/المرتب">
                      <span class="input-group-btn">
                        <button id="search" class="btn btn-primary" type="button">بحث</button>
                      </span>
                    </div><!-- /input-group -->
                </form>
                <br>
               {{-- End search box --}}
                <div class="myTable table-responsive">
                  <table class="table text-center table-bordered table-striped table-hover table-condensed">
                    <!-- On cells (`td` or `th`) -->
                    <thead>
                      <tr>
                      <th class="text-center hidden-print">حذف</th>
                      <th class="text-center hidden-print">تعديل</th>
                      <th class="text-center">الحاله</th>
                      <th class="text-center">الوصف</th>
                      <th class="text-center">المبلغ</th>
                      <th class="text-center">تاريخ التكلفه</th>
                      <th class="text-center">رقم التكلفه</th>
                      </tr>
                    </thead>
                    <tbody id="table_body">
                    @foreach ($costs as $cost)
                    <tr>
                      <td class="hidden-print">
                        <a name="delete" class="text-primary text-center" href="costs/delete/{{$cost->number}}"><i title="حذف" class="fa fa-trash"></i></a>
                      </td>
                      <td class="hidden-print">
                          <a name="edit" class="text-primary text-center" href="/costs/get/cost/{{$cost->number}}"><i title="تعديل" class="fa fa-edit"></i></a>
                      </td>
                      <td class="">{{$cost->status}}</td>
                      <td class="">{{$cost->description}}</td>
                      <td class="">{{$cost->amount}}</td>
                      <td class="">{{$cost->cost_date}}</td>
                      <td class="">{{$cost->number}}</td>
                    </tr> 
                    @endforeach
                    <tr>
                      <td colspan="7" class="text-right hidden-print">
                        <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
                      </td>
                    </tr>
                    </tbody>
                    
                  </table>
                </div>
              </div>
          </div>
      </div>
   
@endsection
