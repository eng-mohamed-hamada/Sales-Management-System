<?php $__env->startSection('content'); ?>
        
        <div class="statistics col-xs-12">
          <div class="panel panel-default">
            
            <div class="text-center panel-body">
              <div>إجمالى الفروع</div>
              <div><?php echo e($sections_count); ?></div>
              <div>فرع</div>
            </div>
          </div>
        </div>
        
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">الفروع</div>

                <div class="panel-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <form name="sections" id="basic_data" method="post" action="<?php echo e(url("/sections/add")); ?>" enctype="multipart/form-data">
                      <div class="form-group col-xs-12">
                      <input id="_token" name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                      </div>  
                      <div class="form-group col-xs-12">
                        <input name="number" type="text" class="hidden text-right form-control">
                      </div>

                      <div class="form-group col-sm-6">
                        <label>عنوان الفرع</label>
                        <input name="address" type="text" class="text-right form-control">
                      </div>
                      <div class="form-group col-sm-6">
                        <label>اسم الفرع</label>
                        <input name="name" type="text" class="text-right form-control">
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
                
                <form id="search_form" name="sections" class="form-group ">
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
                      <th class="text-center hidden-print">تعديل حذف</th>
                      <th class="text-center">العنوان</th>
                      <th class="text-center">الاسم</th>
                      <th class="text-center">رقم الفرع</th>
                      </tr>
                    </thead>
                    <tbody id="table_body">
                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="hidden-print">
                        <a name="delete" class="text-primary text-center" href="sections/delete/<?php echo e($section->number); ?>"><i title="حذف" class="fa fa-trash fa-2x"></i></a>
                      </td>
                      <td class="hidden-print">
                          <a name="edit" class="text-primary text-center" href="/sections/update/<?php echo e($section->number); ?>"><i title="تعديل" class="fa fa-edit fa-2x"></i></a>
                      </td>
                      <td class=""><?php echo e($section->address); ?></td>
                      <td class=""><?php echo e($section->name); ?></td>
                      <td class=""><?php echo e($section->number); ?></td>
                    </tr> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    
                  </table>
                </div>
                  <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
              </div>
          </div>
      </div>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>