@extends('layouts.app')

@section('content')
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">الاقسام</div>

                <div class="panel-body">
                    <form name="departments" id="basic_data" method="post" action="{{url("/departments/add")}}" enctype="multipart/form-data">
                        <div class="form-group">
                          <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
                        </div>  
                        <div class="form-group">
                          <label>اسم القسم</label>
                          <input name="name" type="text" class="text-right form-control">
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
                <form id="search_form" name="departments" action="{{url("departments/search")}}" class="form-group ">
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
                      <th class="text-center">الاسم</th>
                      <th class="text-center">رقم القسم</th>
                      </tr>
                    </thead>
                    <tbody id="table_body">
                    @foreach ($departments as $department)
                    <tr>
                      <td class="hidden-print">
                        <a name="delete" class="text-primary text-center" href="departments/delete/{{$department->number}}"><i title="حذف" class="fa fa-trash"></i></a>
                      </td>
                      <td class="hidden-print">
                          <a name="edit" class="text-primary text-center" href="/departments/get/department/{{$department->number}}"><i title="تعديل" class="fa fa-edit"></i></a>
                      </td>
                      <td class="">{{$department->name}}</td>
                      <td class="">{{$department->number}}</td>
                    </tr> 
                    @endforeach
                    <tr>
                      <td colspan="4" class="text-right hidden-print">
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
