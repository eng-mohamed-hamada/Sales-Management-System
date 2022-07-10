@extends('layouts.app')

@section('content')
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">المنتجات</div>

                <div class="panel-body">
                    <form name="products" id="basic_data" method="post" action="{{url("/products/add")}}" enctype="multipart/form-data">
                      <div class="form-group">
                      <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
                      </div>  
                        <div class="form-group col-sm-6 col-md-4 hidden">
                          <label>الرقم المنتج</label>
                          <input name="number" type="text" class="text-right form-control" placeholder="الرقم المنتج">
                        </div>

                        <div class="form-group col-sm-6 col-md-4">
                          <label>اسم المنتج</label>
                          <input name="name" type="text" class="text-right form-control" placeholder="اسم المنتج">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>سعر البيع</label>
                          <input name="sell_price" type="text" class="text-right form-control" placeholder="سعر البيع">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>الكميه</label>
                          <input name="amount" type="text" class="text-right form-control">
                        </div>

                        <div class="form-group col-sm-6 col-md-4">
                          <label>الصوره</label>
                          <input name="photo" type="file" class="text-right form-control">
                        </div>

                        <div class="form-group col-sm-6 col-md-4">
                          <label>القسم</label>
                          <select name="depart_number" class="text-right form-control">
                            {{app("departments")}}
                          </select>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <label>ألصنف</label>
                            <select name="category_number" class="text-right form-control">
                              
                            </select>
                          </div>
                        <div class="form-group col-sm-12 hidden-print">
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
                <form id="search_form" name="products" action="{{url("products/search")}}" class="form-group ">
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
                      <th class="text-center hidden-print">الصوره</th>
                      <th class="text-center">الكميه</th>
                      <th class="text-center">سعر البيع</th>
                      <th class="text-center">الاسم</th>
                      <th class="text-center">رقم المنتج</th>
                      </tr>
                    </thead>
                    <tbody id="table_body">
                    @foreach ($products as $product)
                    <tr>
                      <td class="hidden-print">
                        <a name="delete" class="text-primary text-center" href="products/delete/{{$product->number}}"><i title="حذف" class="fa fa-trash"></i></a>
                      </td>
                      <td class="hidden-print">
                          <a name="edit" class="text-primary text-center" href="/products/get/product/{{$product->number}}"><i title="تعديل" class="fa fa-edit"></i></a>
                      </td>
                      <td class="hidden-print">
                        <a name="show_photo" href="{{asset("images/$product->photo")}}">الصوره</a>
                      </td>
                      <td class="">{{$product->amount}}</td>
                      <td class="">{{$product->sell_price}}</td>
                      <td class="">{{$product->name}}</td>
                      <td class="">{{$product->number}}</td>
                    </tr> 
                    @endforeach
                    <tr>
                      <td colspan="8" class="text-right hidden-print">
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
