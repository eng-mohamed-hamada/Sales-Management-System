<?php $__env->startSection('content'); ?>
        
        <div class="text-right col-xs-6 col-sm-3">
          <div class="panel panel-default">
            <div class="panel-heading">إجمالى المرتبات</div>

            <div class="panel-body">
              <h3 class="text-center">350000</h3>
              <div class="text-center">جنيه</div>
            </div>
          </div>
        </div>
        <div class="text-right col-xs-6 col-sm-3">
          <div class="panel panel-default">
            <div class="panel-heading">إجمالى الاناث</div>

            <div class="panel-body">
              <h3 class="text-center">40</h3>
              <div class="text-center">موظف</div>
            </div>
          </div>
        </div>
        <div class="text-right col-xs-6 col-sm-3">
          <div class="panel panel-default">
            <div class="panel-heading">إجمالى الذكور</div>

            <div class="panel-body">
              <h3 class="text-center">50</h3>
              <div class="text-center">موظف</div>
            </div>
          </div>
        </div>
        <div class="text-right col-xs-6 col-sm-3">
          <div class="panel panel-default">
            <div class="panel-heading">إجمالى الموظفين</div>

            <div class="panel-body">
              <h3 class="text-center">90</h3>
              <div class="text-center">موظف</div>
            </div>
          </div>
        </div>
        
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">الموظفين</div>

                <div class="panel-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form>
                        <div class="form-group col-sm-6 col-md-4">
                          <label for="exampleInputEmail1">هاتف الموظف</label>
                          <input name="phone" type="text" class="text-right form-control" id="exampleInputEmail1" placeholder="هاتف الموظف">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label for="exampleInputPassword1">الرقم القومى للموظف</label>
                          <input name="national_number" type="text" class="text-right form-control" id="exampleInputPassword1" placeholder="الرقم القومى للموظف">
                        </div>

                        <div class="form-group col-sm-6 col-md-4">
                          <label for="exampleInputEmail1">عنوان الموظف</label>
                          <input name="address" type="text" class="text-right form-control" id="exampleInputEmail1" placeholder="عنوان الموظف">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label for="exampleInputPassword1">اسم الموظف</label>
                          <input name="name" type="text" class="text-right form-control" id="exampleInputPassword1" placeholder="اسم الموظف">
                        </div>

                        <div class="form-group col-sm-6 col-md-4">
                          <label for="exampleInputEmail1">صورة الموظف</label>
                          <input name="photo" type="file" class="text-right form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label for="exampleInputPassword1">مرتب الموظف</label>
                          <input name="salary" type="text" class="text-right form-control" id="exampleInputPassword1" placeholder="مرتب الموظف">
                        </div>
                        
                        <div class="form-group col-sm-6 col-md-4">
                          <label for="exampleInputEmail1">تاريخ التعيين</label>
                          <input name="hiring_date" type="date" class="text-right form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label for="exampleInputPassword1">تاريخ الميلا</label>
                          <input name="birth_date" type="date" class="text-right form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                          <label>النوع</label>
                          <select name="gender" class="text-right form-control">
                            <option value="1">ذكر</option>
                            <option value="0">أنثى</option>
                          </select>
                        </div>
                        <div class="form-group col-sm-12">
                          <button name="print" type="submit" class="btn btn-primary print_button"><i class="fa fa-print"></i> طباعه</button>
                          <button name="update" type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> تحديث</button>
                          <button name="add" type="submit" class="btn btn-primary"><i class="fa fa-send"></i> إضافه</button>
                        </div>
                        
                      </form>
                </div>
            </div>
        </div>

        

        <div class="myContainer text-right col-xs-12">
          <div class="panel panel-default">
              <div class="panel-heading">عمليات البحث</div>

              <div class="panel-body">
                
                <form class="form-group">
                  <div class="form-group">
                    <input type="text" class="form-control text-right" placeholder="الرقم القومى/الاسم/الهاتف/النوع/المرتب">
                  </div>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> بحث</button>
                </form>
               
                <div class="myTable table-responsive">
                  <table class="table text-center table-bordered table-hover table-striped table-condensed">
                    <!-- On cells (`td` or `th`) -->
                    <thead class="danger">
                      <td class="hidden-print">حذف</td>
                      <td class="hidden-print">تعديل</td>
                      <td class="">تاريخ التعيين</td>
                      <td class="">تاريخ الميلا</td>
                      <td class="">الصوره</td>
                      <td class="">المرتب</td>
                      <td class="">العنوان</td>
                      <td class="">الاسم</td>
                      <td class="">الهاتف</td>
                      <td class="">الرقم القومى</td>
                    </thead>
                    <tr>
                      <td class="hidden-print">fgjfjg</td>
                      <td class="hidden-print">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>تعديل</button>
                      </td>
                      <td class="">gjhjg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                    </tr>
                    <tr>
                      <td class="hidden-print">fgjfjg</td>
                      <td class="hidden-print">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>تعديل</button>
                      </td>
                      <td class="">gjhjg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                    </tr>
                    <tr>
                      <td class="hidden-print">fgjfjg</td>
                      <td class="hidden-print">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>تعديل</button>
                      </td>
                      <td class="">gjhjg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                      <td class="">gjhg</td>
                    </tr>
                  </table>
                </div>
                  <button type="submit" class="btn btn-primary print_button"><i class="fa fa-print"></i> طباعه</button>
              </div>
          </div>
      </div>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>