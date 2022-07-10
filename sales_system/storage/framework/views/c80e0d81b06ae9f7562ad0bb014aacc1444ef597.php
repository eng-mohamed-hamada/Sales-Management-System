<?php $__env->startSection('content'); ?>
        
        <div class="statistics col-xs-12">
          <div class="panel panel-default">
            
            <div class="text-center panel-body">
              <div>إجمالى الاصناف</div>
              <div>54</div>
              <div>صنف</div>
            </div>
          </div>
        </div>
        
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">الاصناف</div>

                <div class="panel-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <form name="users" id="basic_data" method="post" action="<?php echo e(url("/users/add")); ?>" enctype="multipart/form-data">
                      <div class="form-group col-xs-12">
                      <input id="_token" name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                      </div>  
                      <div class="form-group col-xs-12">
                        <label>الرقم القومى للمستخدم</label>
                        <input name="national_number" type="text" class="text-right form-control">
                      </div>
                      <div class="form-group col-xs-12">
                        <label>القسم</label>
                        <select name="section_id" class="text-right form-control">
                          <option value="1">قسم 1</option>
                          <option value="0">قسم 2</option>
                        </select>
                      </div>
                        
                       
                        <div class="form-group col-sm-12">
                          <button name="add" type="button" class="btn btn-primary"><i class="fa fa-save"></i> حفظ</button>
                        </div>
                        
                      </form>
                </div>
            </div>
        </div>

        

   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>