<?php $__env->startSection('content'); ?>
        

        

        <div class=" text-right col-xs-12">
          <div class="panel panel-default">
              <div class="panel-heading">الاشعارات</div>

              <div class="panel-body">
            
                <div class="myTable table-responsive">
                    <?php if(count($products) > 0): ?>
                    <table class="table text-center table-bordered table-striped table-hover table-condensed">
                        <tr>
                            <td colspan="5" class="text-center">منتجات غير متوفره</td>
                        </tr>        
                        <tr>
                            <td class="text-center">الكميه المتبقيه</td>
                            <td class="text-center">سعر البيع</td>
                            <td class="text-center">اسم المنتج</td>
                            <td class="text-center">رقم المنتج</td>
                            </tr>
                        
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                             <td class=""><?php echo e($product->amount); ?></td>
                             <td class=""><?php echo e($product->sell_price); ?></td>
                             <td class=""><?php echo e($product->name); ?></td>
                             <td class=""><?php echo e($product->number); ?></td>
                         </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                      <td colspan="5" class="text-right hidden-print">
                        <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
                      </td>
                    </tr>
                    </table>
                    <?php endif; ?>
                
                    <?php if(count($debtes) > 0): ?>
                    <table class="table text-center table-bordered table-striped table-hover table-condensed">
                        <tr>
                            <td colspan="5" class="text-center">ديون جاء موعد سدادها</td>
                        </tr> 
                        <tr>
                            <td class="text-center">الوصف</td>
                            <td class="text-center">المبلغ</td>
                            <td class="text-center">تاريخ السداد</td>
                            <td class="text-center">تاريخ الدين</td>
                            <td class="text-center">رقم الدين</td>
                            </tr>
                        
                    <?php $__currentLoopData = $debtes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $debte): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                             <td class=""><?php echo e($debte->description); ?></td>
                             <td class=""><?php echo e($debte->amount); ?></td>
                             <td class=""><?php echo e($debte->payment_date); ?></td>
                             <td class=""><?php echo e($debte->debte_date); ?></td>
                             <td class=""><?php echo e($debte->number); ?></td>
                         </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                      <td colspan="5" class="text-right hidden-print">
                        <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
                      </td>
                    </tr>
                    </table>
                    <?php endif; ?>
                
            
                    <?php if(count($borrows) > 0): ?>
                    <table class="table text-center table-bordered table-striped table-hover table-condensed">
                            <tr>
                                <td colspan="6" class="text-center">لم يتم سداد اقساط هذه السلف</td>
                            </tr> 
                            <tr>
                            <td class="text-center">المبلغ الكلى</td>
                            <td class="text-center">الفوايد</td>
                            <td class="text-center">المبلغ</td>
                            <td class="text-center">تاريخ السلفه</td>
                            <td class="text-center">اسم الموظف</td>
                            <td class="text-center">رقم السلفه</td>
                            </tr>
                        
                    <?php $__currentLoopData = $borrows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                             <td class=""><?php echo e($borrow->total_amount); ?></td>
                             <td class=""><?php echo e($borrow->benefits); ?></td>
                             <td class=""><?php echo e($borrow->amount); ?></td>
                             <td class=""><?php echo e($borrow->borrow_date); ?></td>
                             <td class=""><?php echo e($borrow->employee_name); ?></td>
                             <td class=""><?php echo e($borrow->number); ?></td>
                         </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                      <td colspan="6" class="text-right hidden-print">
                        <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
                      </td>
                    </tr>
                    </table>
                    <?php endif; ?>
                
                </div>
              </div>
          </div>
      </div>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>