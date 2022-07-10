<?php $__env->startSection('content'); ?>
        

        

        
        <div class="text-right col-xs-12">
          <div class="panel panel-default">
              <div class="panel-heading">الخطوه الاولى: انشاء الفاتوره</div>

              <div class="panel-body">
                  
                  <form name="purchases" id="bell" method="post" action="<?php echo e(url("/purchases/create/bell")); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                    <input id="_token" name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                    </div>  
                      
                      <div class="form-group col-sm-12">
                        <label>المورد/الشركه</label>
                        <select name="supplier_number" class="text-right form-control">
                          <?php echo e(app("suppliers")); ?>

                        </select>
                      </div>
                     
                      <div class="form-group col-sm-12 hidden-print">
                        <button name="add" type="button" class="btn btn-primary"><i class="fa fa-save"></i> إنشاء</button>
                      </div>
                      
                    </form>
              </div>
          </div>
      </div>
        
        <div class="text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">الخطوه الثانيه: اضافة المنتجات الى الفاتوره</div>

                <div class="panel-body">
                    
                    <form name="purchases" id="bell_products" method="post" action="<?php echo e(url("/purchases/add")); ?>" enctype="multipart/form-data">
                      <div class="form-group">
                      <input id="_token" name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                      </div>  
                        

                        <div class="form-group col-sm-6 col-md-6">
                          <label>القسم</label>
                          <select name="depart_number" class="text-right form-control">
                            <?php echo e(app("departments")); ?>

                          </select>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                          <label>الصنف</label>
                          <select name="category_number" class="text-right form-control">
                            
                          </select>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>المنتج</label>
                          <select name="product_number" class="text-right form-control">
                            
                          </select>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                          <label>الكميه</label>
                          <input name="amount" type="text" class="text-right form-control" placeholder="الكميه">
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                          <label>سعر الكميه</label>
                          <input name="product_total_price" type="text" class="text-right form-control" placeholder="السعر الكلى للكميه">
                        </div>
                        <div class="form-group col-sm-12 hidden-print">
                          <button name="add" type="button" class="btn btn-primary"><i class="fa fa-save"></i> إضافه</button>
                        </div>
                      </form>
                      <form id="search_form" class="col-xs-12" name="purchases" action="<?php echo e(url("purchases/search")); ?>" class=" ">
                        <div class="input-group">
                          <input id="search_text" type="text" class="text-right form-control" placeholder="رقم الفاتوره">
                          <span class="input-group-btn">
                            <button id="search" class="btn btn-primary" type="button">بحث</button>
                          </span>
                        </div><!-- /input-group -->
                    </form>
                </div>
            </div>
        </div>
        

        <div class="myContainer text-right col-xs-12">
          <div class="panel panel-default">
              <div class="panel-heading">الفاتوره الحاليه</div>

              <div class="panel-body">
                
                <div id="table_body" class="myTable table-responsive">
                  
                </div>
              </div>
          </div>
      </div>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>