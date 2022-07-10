<?php $__env->startSection('content'); ?>
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">الحضور</div>

                <div class="panel-body">
                    <form name="attendees" id="basic_data" method="post" action="<?php echo e(url("/attendees/add")); ?>" enctype="multipart/form-data">
                      <div class="form-group">
                      <input id="_token" name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                      </div>  
                        <div class="form-group col-sm-6 col-md-4 hidden">
                          <label>رقم الحضور</label>
                          <input name="number" type="text" class="text-right form-control" placeholder="رقم الحضور">
                        </div>

                        <div class="form-group col-sm-6 col-md-12">
                            <div class="table-responsive">
                                <table class="table text-center table-bordered table-striped table-hover table-condensed">
                                  <!-- On cells (`td` or `th`) -->
                                  <thead>
                                    <tr>
                                    <th class="text-center">الحاله</th>
                                    <th class="text-center">اسم الموظف</th>
                                    <th class="text-center">الرقم القومى</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    
                                    <td class="hidden-print">
                                        <input type="checkbox" name="emp_national_number[]" value="<?php echo e($employee->national_number); ?>">
                                    </td>
                                    <td class=""><?php echo e($employee->name); ?></td>
                                    <td class=""><?php echo e($employee->national_number); ?></td>
                                  </tr> 
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>
                                  
                                </table>
                              </div>
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
                
                <form id="search_form" name="attendees" action="<?php echo e(url("attendees/search")); ?>">
                    <div class="form-group">
                      <div class="input-group">
                        <input id="search_text" type="text" class="text-right form-control" placeholder="الرقم القومى">
                        <span class="input-group-btn">
                          <button id="search" class="btn btn-primary" type="button">بحث</button>
                        </span>
                      </div><!-- /input-group -->
                    </div>
                </form>
                <br>
               
                <div  id="table_body" class="myTable table-responsive">
                  
                  
                </div>
              </div>
          </div>
      </div>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>