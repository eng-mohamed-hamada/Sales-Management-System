@extends('layouts.app')

@section('content')
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">الموردين</div>

                <div class="panel-body">
                    <form name="suppliers" id="basic_data" method="post" action="{{url("/suppliers/add")}}" enctype="multipart/form-data">
                      <div class="form-group">
                      <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
                      </div>  
                      <div class="form-group col-sm-6 col-md-4">
                          <label>هاتف المورد/الشركه</label>
                          <input name="phone" type="text" class="text-right form-control" placeholder="هاتف المورد">
                        </div>
                                               
                        <div class="form-group col-sm-6 col-md-4">
                          <label>اسم المورد/الشركه</label>
                          <input name="name" type="text" class="text-right form-control" placeholder="اسم المورد">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label>عنوان المورد/الشركه</label>
                            <input name="address" type="text" class="text-right form-control" placeholder="عنوان المورد">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                          <label>رقم هاتف الوتساب</label>
                          <input name="whatsapp_phone" type="text" class="text-right form-control" placeholder="عنوان المورد">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                          <label>رابط الفيسبوك</label>
                          <input name="facebook_url" type="url" class="text-right form-control" placeholder="عنوان المورد">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                          <label>رابط الموقع / التطبيق</label>
                          <input name="app_url" type="url" class="text-right form-control" placeholder="عنوان المورد">
                        </div>
                        <div class="form-group col-sm-12 hidden-print">
                          <button name="add" type="button" class="btn btn-primary"><i class="fa fa-save"></i> حفظ</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
        {{-- the table --}}

        <div class=" text-right col-xs-12">
          <div class="panel panel-default">
              <div class="panel-heading">عمليات البحث</div>

              <div class="panel-body">
                {{-- start search box --}}
                <form id="search_form" name="suppliers" action="{{url("suppliers/search")}}" class="form-group ">
                    
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
                    <th class="text-center">واتساب</th>
                    <th class="text-center">فيسبوك</th>
                    <th class="text-center">الموقع/التطبيق</th>
                    <th class="text-center">العنوان</th>
                    <th class="text-center">الاسم</th>
                    <th class="text-center">الهاتف</th>
                    <th class="text-center">الرقم</th>
                    </tr>
                    </thead>
                    <tbody id="table_body">
                      @foreach ($suppliers as $supplier)
                        <tr>
                            <td class="hidden-print">
                                <a name="delete" class="text-primary text-center" href="suppliers/delete/{{$supplier->number}}"><i title="حذف" class="fa fa-trash"></i></a>
                            </td>
                            <td class="hidden-print">
                                <a name="edit" class="text-primary text-center" href="/suppliers/get/supplier/{{$supplier->number}}"><i title="تعديل" class="fa fa-edit"></i></a>
                            </td>
                            <td>{{$supplier->whatsapp_phone}}</td>
                            <td><a href="{{$supplier->facebook_url}}">{{$supplier->facebook_url}}</a></td>
                            <td><a href="{{$supplier->app_url}}">{{$supplier->app_url}}</a></td>
                            <td>{{$supplier->address}}</td>
                            <td>{{$supplier->name}}</td>
                            <td>{{$supplier->phone}}</td>
                            <td>{{$supplier->number}}</td>
                        </tr>
                     @endforeach
                          <tr>
                            <td colspan="9" class="text-right hidden-print">
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
