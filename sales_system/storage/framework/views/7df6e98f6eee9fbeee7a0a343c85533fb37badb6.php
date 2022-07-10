<?php $__env->startSection('content'); ?>
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">الموظفين</div>

                <div class="panel-body">
                    <form name="employees" id="basic_data" method="post" action="<?php echo e(url("/employees/add")); ?>" enctype="multipart/form-data">
                      <div class="form-group">
                      <input id="_token" name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                      </div>  
                      <div class="form-group col-sm-6 col-md-4">
                          <label>هاتف الموظف</label>
                          <input name="phone" type="text" class="text-right form-control" placeholder="هاتف الموظف">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>الرقم القومى للموظف</label>
                          <input name="national_number" type="text" class="text-right form-control" placeholder="الرقم القومى للموظف">
                        </div>

                        <div class="form-group col-sm-6 col-md-4">
                          <label>عنوان الموظف</label>
                          <input name="address" type="text" class="text-right form-control" placeholder="عنوان الموظف">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>اسم الموظف</label>
                          <input name="name" type="text" class="text-right form-control" placeholder="اسم الموظف">
                        </div>

                        <div class="form-group col-sm-6 col-md-4">
                          <label>مرتب الموظف</label>
                          <input name="salary" type="text" class="text-right form-control" placeholder="مرتب الموظف">
                        </div>
                        
                        <div class="form-group col-sm-6 col-md-4">
                          <label>تاريخ التعيين</label>
                          <input name="hiring_date" type="date" class="text-right form-control">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>سنة الميلاد</label>
                          <input name="birth_year" type="text" class="text-right form-control">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>صورة الموظف</label>
                          <input name="photo" type="file" class="text-right form-control">
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>النوع</label>
                          <select name="gender" class="text-right form-control">
                            <option value="male">ذكر</option>
                            <option value="female">أنثى</option>
                          </select>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                          <label>القسم</label>
                          <select name="depart_number" class="text-right form-control">
                            <?php echo e(app("departments")); ?>

                          </select>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                          <label>الدرجه الوظيفيه</label>
                          <select name="degree_number" class="text-right form-control">
                            <?php echo e(app("degrees")); ?>

                          </select>
                        </div>
                        <div class="form-group col-sm-12 hidden-print">
                          <button name="add" type="button" class="btn btn-primary"><i class="fa fa-save"></i> حفظ</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
        
        

        <div class="myContainer text-right col-xs-12">
          <div class="panel panel-default">
              <div class="panel-heading">عمليات البحث</div>

              <div class="panel-body">
                
                <form id="search_form" name="employees" action="<?php echo e(url("employees/search")); ?>" class="form-group ">
                    <div class="input-group">
                      <input id="search_text" type="text" class="text-right form-control" placeholder="الاسم/رقم التلفون/الرقم القومى/النوع/العنوان/المرتب">
                      <span class="input-group-btn">
                        <button id="search" class="btn btn-primary" type="button">بحث</button>
                      </span>
                    </div><!-- /input-group -->
                </form>
                <br>
               
                <div class="myTable table-responsive">
                  <table class="table text-center table-bordered table-striped table-hover table-condensed">
                    <!-- On cells (`td` or `th`) -->
                    <thead>
                      <tr>
                      <th class="text-center hidden-print">حذف</th>
                      <th class="text-center hidden-print">تعديل</th>
                      <th class="text-center hidden-print">الصوره</th>
                      <th class="text-center">تاريخ التعيين</th>
                      <th class="text-center">السن</th>
                      <th class="text-center">النوع</th>
                      <th class="text-center">المرتب</th>
                      <th class="text-center">العنوان</th>
                      <th class="text-center">الاسم</th>
                      <th class="text-center">الهاتف</th>
                      <th class="text-center">الرقم القومى</th>
                      </tr>
                    </thead>
                    <tbody id="table_body">
                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="hidden-print">
                        <a name="delete" class="text-primary text-center" href="employees/delete/<?php echo e($employee->national_number); ?>"><i title="حذف" class="fa fa-trash"></i></a>
                      </td>
                      <td class="hidden-print">
                          <a name="edit" class="text-primary text-center" href="/employees/get/employee/<?php echo e($employee->national_number); ?>"><i title="تعديل" class="fa fa-edit"></i></a>
                      </td>
                      <td class="hidden-print">
                        <a name="show_photo" href="<?php echo e(asset("images/$employee->photo")); ?>">الصوره</a>
                      </td>
                      <td class=""><?php echo e($employee->hiring_date); ?></td>
                      <td class=""><?php echo e($employee->age); ?></td>
                      <td class=""><?php echo e($employee->gender); ?></td>
                      <td class=""><?php echo e($employee->salary); ?></td>
                      <td class=""><?php echo e($employee->address); ?></td>
                      <td class=""><?php echo e($employee->name); ?></td>
                      <td class=""><?php echo e($employee->phone); ?></td>
                      <td class=""><?php echo e($employee->national_number); ?></td>
                    </tr> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td colspan="11" class="text-right hidden-print">
                        <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
                      </td>
                    </tr>
                    </tbody>
                    
                  </table>
                </div>
              </div>
          </div>
      </div>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>