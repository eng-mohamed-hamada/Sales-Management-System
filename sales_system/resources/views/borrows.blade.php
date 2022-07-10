@extends('layouts.app')

@section('content')
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">السلف</div>

                <div class="panel-body">
                    <form name="borrows" id="basic_data" method="post" action="{{url("/borrows/add")}}" enctype="multipart/form-data">
                      <div class="form-group">
                      <input id="_token" name="_token" type="hidden" value="{{csrf_token()}}">
                      </div>  
                        <div class="form-group col-sm-6 col-md-4 hidden">
                          <label>رقم السلفه</label>
                          <input name="number" type="text" class="text-right form-control" placeholder="رقم السلفه">
                        </div>

                        <div class="form-group col-sm-6 col-md-4">
                          <label>المبلغ السلفه</label>
                          <input name="amount" type="text" class="text-right form-control" placeholder="المبلغ">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>الفوايد</label>
                          <input name="benefits" type="text" class="text-right form-control" placeholder="الفوايد">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>الرقم القومى للموظف</label>
                          <input name="emp_national_number" type="text" class="text-right form-control" placeholder="الرقم القومى للموظف">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>المبلغ المسدد(المقدم)</label>
                          <input name="paymented_amount" type="text" class="text-right form-control" placeholder="المبلغ المسدد">
                        </div>
                        
                        <div class="form-group col-sm-6 col-md-4">
                          <label>قيمة القسط</label>
                          <input name="installment_amount" type="text" class="text-right form-control" placeholder="قيمة القسط">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>يوم دفع القسط</label>
                          <select name="installment_payment_day" class="text-right form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                          </select>
                        </div>
                        <div class="form-group col-sm-12">
                          <label>الوصف</label>
                        <textarea rows="5" name="description" class="text-right form-control" placeholder="اكتب وصف للسلفه"></textarea>
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
                <form id="search_form" name="borrows" action="{{url("borrows/search")}}" class="form-group ">
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
                      <th class="text-center">الموظف</th>
                      <th class="text-center">المبلغ الكلى</th>
                      <th class="text-center">الفوائد</th>
                      <th class="text-center">الوصف</th>
                      <th class="text-center">المبلغ</th>
                      <th class="text-center">تاريخ السلفه</th>
                      <th class="text-center">رقم السلفه</th>
                      </tr>
                    </thead>
                    <tbody id="table_body">
                    @foreach ($borrows as $borrow)
                    <tr>
                      <td class="hidden-print">
                        <a name="delete" class="text-primary text-center" href="borrows/delete/{{$borrow->number}}"><i title="حذف" class="fa fa-trash"></i></a>
                      </td>
                      <td class="hidden-print">
                          <a name="edit" class="text-primary text-center" href="/borrows/get/borrow/{{$borrow->number}}"><i title="تعديل" class="fa fa-edit"></i></a>
                      </td>
                      <td class="">{{$borrow->emp_national_number}}</td>
                      <td class="">{{$borrow->total_amount}}</td>
                      <td class="">{{$borrow->benefits}}</td>
                      <td class="">{{$borrow->description}}</td>
                      <td class="">{{$borrow->amount}}</td>
                      <td class="">{{$borrow->borrow_date}}</td>
                      <td class="">{{$borrow->number}}</td>
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
