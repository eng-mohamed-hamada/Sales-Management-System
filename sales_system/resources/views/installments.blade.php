@extends('layouts.app')

@section('content')
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">الاقساط</div>

                <div class="panel-body">
                    <form name="installments" id="basic_data" method="post" action="{{url("/installments/add")}}" enctype="multipart/form-data">
                      <div class="form-group">
                      <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
                      </div>  
                        <div class="form-group col-sm-6 col-md-4 hidden">
                          <label>رقم القسط</label>
                          <input name="number" type="text" class="text-right form-control" placeholder="رقم القسط">
                        </div>

                        <div class="form-group">
                          <label>المبلغ</label>
                          <input name="amount" type="text" class="text-right form-control" placeholder="المبلغ">
                        </div>
                        <div class="form-group">
                            <label>رقم السلفه</label>
                            <input name="borrow_number" type="text" class="text-right form-control" placeholder="رقم السلفه">
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
                <form id="search_form" name="installments" action="{{url("installments/search")}}" class="form-group ">
                    <div class="input-group">
                      <input id="search_text" type="text" class="text-right form-control" placeholder="رقم السلفه">
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
                      <th class="text-center hidden-print">تعديل</th>
                      <th class="text-center">رقم السلف</th>
                      <th class="text-center">المبلغ</th>
                      <th class="text-center">تاريخ القسط</th>
                      <th class="text-center">رقم القسط</th>
                      </tr>
                    </thead>
                    <tbody id="table_body">
                    
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
