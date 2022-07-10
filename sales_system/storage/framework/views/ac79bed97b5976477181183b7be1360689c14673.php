<?php $__env->startSection('content'); ?>
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">المستخدمين</div>

                <div class="panel-body">
                    <form name="accounts" id="basic_data" method="post" action="<?php echo e(url("/accounts/add")); ?>" enctype="multipart/form-data">
                      <div class="form-group">
                      <input id="_token" name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                      </div>  
                      <div class="form-group col-sm-6 col-md-4">
                        <label>الرقم القومى للمستخدم</label>
                        <input name="national_number" type="text" class="text-right form-control">
                      </div>                        
                      <div class="form-group  col-sm-6 col-md-4">
                        <label>الاسم</label>
                        <input name="name" type="text" class="text-right form-control">
                      </div>
                      <div class="form-group  col-sm-12 col-md-4">
                        <label>الصلاحيه</label>
                        <select name="permission" class="text-right form-control">
                          <option selected>---</option>
                          <option value="user">مستخدم</option>
                          <option value="admin">مسؤل</option>
                        </select>
                      </div>
                        <div class="form-group col-sm-12">
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
                
                <form id="search_form" name="departments" action="<?php echo e(url("accounts/search")); ?>" class="form-group ">
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
                      <th class="text-center">الصلاحيه</th>
                      <th class="text-center">الاسم</th>
                      <th class="text-center">الرقم القومى</th>
                      </tr>
                    </thead>
                    <tbody id="table_body">
                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="hidden-print">
                        <a name="delete" class="text-primary text-center" href="accounts/delete/<?php echo e($account->national_number); ?>"><i title="حذف" class="fa fa-trash"></i></a>
                      </td>
                      <td class="hidden-print">
                          <a name="edit" class="text-primary text-center" href="/accounts/get/account/<?php echo e($account->national_number); ?>"><i title="تعديل" class="fa fa-edit"></i></a>
                      </td>
                      <td class=""><?php echo e($account->permission); ?></td>
                      <td class=""><?php echo e($account->name); ?></td>
                      <td class=""><?php echo e($account->national_number); ?></td>
                    </tr> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>