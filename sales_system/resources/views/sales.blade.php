
 @extends('layouts.app')

@section('content')
        {{-- Start Statistics --}}

        {{-- End Statistics --}}

        {{-- start bell section --}}
        <div class="text-right col-xs-12">
          <div class="panel panel-default">
              <div class="panel-heading">الخطوه الاولى: انشاء الفاتوره</div>

              <div class="panel-body">
                  
                  <form name="sales" id="bell" method="post" action="{{url("/sales/create/bell")}}" enctype="multipart/form-data">
                        <div class="form-group">
                        <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
                        </div>  
                      
                        <div class="form-group col-sm-6">
                            <label>اسم العميل</label>
                            <input name="client_name" type="text" class="text-right form-control" placeholder="اسم العميل">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>هاتف العميل</label>
                            <input name="client_phone" type="text" class="text-right form-control" placeholder="هاتف العميل">
                        </div>
                        <div class="form-group col-sm-12 hidden-print">
                            <button name="add" type="button" class="btn btn-primary"><i class="fa fa-save"></i> إنشاء</button>
                        </div>
                      
                    </form>
              </div>
          </div>
      </div>
        {{-- end bell section --}}
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">الخطوه الثانيه: اضافة المنتجات الى الفاتوره</div>

                <div class="panel-body">
                    
                    <form name="sales" id="bell_products" method="post" action="{{url("/sales/add")}}" enctype="multipart/form-data">
                      <div class="form-group">
                      <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
                      </div>  
                        

                        <div class="form-group col-sm-6 col-md-12">
                          <label>القسم</label>
                          <select name="depart_number" class="text-right form-control">
                            {{app("departments")}}
                          </select>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>الصنف</label>
                          <select name="category_number" class="text-right form-control">
                            
                          </select>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>المنتج</label>
                          <select name="product_number" class="text-right form-control">
                            
                          </select>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>الكميه</label>
                          <input name="amount" type="text" class="text-right form-control" placeholder="الكميه">
                        </div>
                        <div class="form-group col-sm-12 hidden-print">
                          <button name="add" type="button" class="btn btn-primary"><i class="fa fa-save"></i> إضافه</button>
                        </div>
                      </form>

                      <form id="search_form" name="sales" action="{{url("sales/search")}}" class="col-sm-12">
                        <div class="input-group">
                          <input id="search_text" type="text" class="text-right form-control" placeholder="رقم الفاتوره">
                          <span class="input-group-btn">
                            <button id="search" class="btn btn-primary" type="button">بحث</button>
                          </span>
                        </div><!-- /input-group -->
                    </form>
                </div>
            </div>
        </div>
        {{-- the table --}}

        <div class="myContainer text-right col-xs-12">
          <div class="panel panel-default">
              <div class="panel-heading">الفاتوره الحاليه</div>

              <div class="panel-body">
                
                <div id="table_body" class="myTable table-responsive">
                  
                </div>
              </div>
          </div>
      </div>
   
@endsection
