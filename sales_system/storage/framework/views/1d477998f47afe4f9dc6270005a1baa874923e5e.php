<?php $__env->startSection('content'); ?>
        

        

        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">الديون</div>

                <div class="panel-body">
                    
                    <form name="debtes" id="debtes" method="post" action="<?php echo e(url("/debtes/add")); ?>" enctype="multipart/form-data">
                      <div class="form-group">
                      <input id="_token" name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                      </div>  
                        

                        <div class="form-group  col-sm-12">
                          <label>المورد/الشركة(صاحب الدين)</label>
                          <select name="supplier_number" class="text-right form-control">
                            <?php echo e(app("suppliers")); ?>

                          </select>
                        </div>
                       
                        
                        <div class="form-group col-sm-6">
                          <label>المبلغ</label>
                          <input name="amount" type="text" class="text-right form-control" placeholder="الكميه">
                        </div>
                        <div class="form-group col-sm-6">
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
                            <label>وصف الدين</label>
                            <textarea rows="5" name="description" type="text" class="text-right form-control" placeholder="اكتب وصف للدين"></textarea>
                          </div>
                        <div class="form-group col-sm-12 hidden-print">
                          <button name="add" type="button" class="btn btn-primary"><i class="fa fa-save"></i> إضافه</button>
                        </div>
                      </form>

                      
                </div>
            </div>
        </div>
        

        <div class="myContainer text-right col-xs-12">
          <div class="panel panel-default">
              <div class="panel-heading">عمليات البحث</div>

              <div class="panel-body">
                
                <form id="search_form" name="debtes" action="<?php echo e(url("debtes/search")); ?>" class="form-group ">
                  <div class="form-group col-sm-12">
                    <label>المورد/الشركة(صاحب الدين)</label>
                    <select id="search_text" class="text-right form-control">
                      <?php echo e(app("suppliers")); ?>

                    </select>
                  </div>
                  <div class="form-group">
                    <button id="search" type="button" class="btn btn-primary">بحث</button>
                  </div>
                </form>
             
                <div id="table_body" class="myTable table-responsive">
                </div>
              </div>
          </div>
      </div>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>