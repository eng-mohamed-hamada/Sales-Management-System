@extends('layouts.app')

@section('content')
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">الاصناف</div>

                <div class="panel-body">
                    <form name="categories" id="basic_data" method="post" action="{{url("/categories/add")}}" enctype="multipart/form-data">
                      <div class="form-group">
                      <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
                      </div>  
                      <div class="form-group col-sm-6">
                        <label>القسم</label>
                        <select name="depart_number" class="text-right form-control">
                          {{app("departments")}}
                        </select>
                      </div>
                        <div class="form-group col-sm-6">
                          <label>اسم الصنف</label>
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
                <form id="search_form" name="categories" action="{{url("categories/search")}}" class="form-group ">
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
                      <th class="text-center hidden-print">تعديل حذف</th>
                      <th class="text-center">اسم الصنف</th>
                      <th class="text-center">القسم</th>
                      <th class="text-center">رقم الصنف</th>
                      </tr>
                    </thead>
                    <tbody id="table_body">
                    @foreach ($categories as $category)
                    <tr>
                      <td class="hidden-print">
                        <a name="delete" class="text-primary text-center" href="categories/delete/{{$category->number}}"><i title="حذف" class="fa fa-trash"></i></a>
                      </td>
                      <td class="hidden-print">
                          <a name="edit" class="text-primary text-center" href="/categories/get/category/{{$category->number}}"><i title="تعديل" class="fa fa-edit"></i></a>
                      </td>
                      <td class="">{{$category->name}}</td>
                      <td class="">{{$category->department_name}}</td>
                      <td class="">{{$category->number}}</td>
                    </tr> 
                    @endforeach
                    <tr>
                      <td colspan="5" class="text-right hidden-print">
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
