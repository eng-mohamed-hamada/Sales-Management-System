@extends('layouts.app')

@section('content')
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">الدرجه الوظيفيه</div>

                <div class="panel-body">
                    <form name="degrees" id="basic_data" method="post" action="{{url("/degrees/add")}}" enctype="multipart/form-data">
                        <div class="form-group">
                          <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
                        </div>  
                        <div class="form-group">
                          <label>الدرجه الوظيفيه</label>
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
                <form id="search_form" name="degrees" action="{{url("degrees/search")}}" class="form-group ">
                    <div class="input-group">
                      <input id="search_text" type="text" class="text-right form-control" placeholder="الدرجه الوظيفيه/رقم التلفون/الرقم القومى/النوع/العنوان/المرتب">
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
                      <th class="text-center">الدرجه الوظيفيه</th>
                      <th class="text-center">رقم الدرجه الوظيفيه</th>
                      </tr>
                    </thead>
                    <tbody id="table_body">
                    @foreach ($degrees as $degree)
                    <tr>
                      <td class="hidden-print">
                        <a name="delete" class="text-primary text-center" href="degrees/delete/{{$degree->number}}"><i title="حذف" class="fa fa-trash"></i></a>
                      </td>
                      <td class="hidden-print">
                          <a name="edit" class="text-primary text-center" href="/degrees/get/degree/{{$degree->number}}"><i title="تعديل" class="fa fa-edit"></i></a>
                      </td>
                      <td class="">{{$degree->name}}</td>
                      <td class="">{{$degree->number}}</td>
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
