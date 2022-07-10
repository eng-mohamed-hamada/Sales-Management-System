@extends('layouts.app')

@section('content')
        {{-- Start Statistics --}}

        {{-- End Statistics --}}

        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">المستحقات</div>

                <div class="panel-body">
                    
                    <form name="dues" id="dues" method="post" action="{{url("/dues/add")}}" enctype="multipart/form-data">
                      <div class="form-group">
                      <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
                      </div>  
                        
                        <div class="form-group  col-sm-6 col-md-4">
                            <label>الرقم القومى للعميل</label>
                            <input name="national_number" type="text" class="text-right form-control" placeholder="الرقم القومى للعميل">
                        </div>
                        <div class="form-group  col-sm-6 col-md-4">
                          <label>اسم العميل</label>
                          <input name="name" type="text" class="text-right form-control" placeholder="اسم العميل">
                        </div>
                       
                        <div class="form-group  col-sm-6 col-md-4">
                            <label>هاتف العميل</label>
                            <input name="phone" type="tel" class="text-right form-control" placeholder="هاتف العميل">
                        </div>
                        <div class="form-group  col-sm-6 col-md-4">
                            <label>عنوان العميل</label>
                            <input name="address" type="text" class="text-right form-control" placeholder="عنوان العميل">
                        </div>

                        <div class="form-group col-sm-6 col-md-4">
                          <label>المبلغ</label>
                          <input name="amount" type="text" class="text-right form-control" placeholder="الكميه">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>تاريخ السداد</label>
                          <input name="payment_date" type="date" class="text-right form-control">
                        </div>
                        <div class="form-group  col-sm-12">
                          <label>حالة الدفع</label>
                          <select name="status" class="text-right form-control">
                            <option value="1">تم الدفع</option>
                            <option value="0">لم يتم الدفع</option>
                          </select>                        </div>
                        <div class="form-group col-sm-12">
                            <label>الوصف</label>
                            <textarea rows="5" name="description" type="text" class="text-right form-control" placeholder="اكتب وصف للدين"></textarea>
                          </div>
                        <div class="form-group col-sm-12">
                          <button name="add" type="button" class="btn btn-primary"><i class="fa fa-save"></i> إضافه</button>
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
                <form id="search_form" name="dues" action="{{url("dues/search")}}" class="form-group ">
                    <div class="input-group">
                      <input id="search_text" type="text" class="text-right form-control" placeholder="الاسم/رقم التلفون/الرقم القومى/النوع/العنوان/المرتب">
                      <span class="input-group-btn">
                        <button id="search" class="btn btn-primary" type="button">بحث</button>
                      </span>
                    </div><!-- /input-group -->
                </form>
             {{-- End search box --}}
                <div id="table_body" class="myTable table-responsive">
                </div>
              </div>
          </div>
      </div>
   
@endsection
