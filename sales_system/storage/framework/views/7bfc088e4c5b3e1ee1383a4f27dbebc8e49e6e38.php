<?php $__env->startSection('content'); ?>
       
        <div class=" text-right col-xs-12">
          <div class="panel panel-default">
              <div class="panel-heading">الاحصائيات</div>

              <div class="panel-body">
                <div class="myTable table-responsive">
                    <table class="table text-center table-bordered table-striped table-hover table-condensed">
                        <tr>
                            <td>موظف</td>
                            <td><?php echo e($employees_count); ?></td>
                            <td>اجمالى الموظفين</td>
                        </tr>
                        <tr>
                            <td>موظف</td>
                            <td><?php echo e($males); ?></td>
                            <td>اجمالى الذكور</td>
                        </tr>
                        <tr>
                            <td>موظف</td>
                            <td><?php echo e($females); ?></td>
                            <td>اجمالى الاناث</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td><?php echo e($total_salaries); ?></td>
                            <td>اجمالى الرواتب</td>
                        </tr>
                        <tr>
                            <td>منتج</td>
                            <td><?php echo e($products_count); ?></td>
                            <td>اجمالى المنتجات</td>
                        </tr>
                        <tr>
                            <td>مورد</td>
                            <td><?php echo e($suppliers_count); ?></td>
                            <td>اجمالى الموردين</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td><?php echo e($total_costs); ?></td>
                            <td>اجمالى التكاليف</td>
                        </tr>
                        <tr>
                            <td>قسم</td>
                            <td><?php echo e($departments_count); ?></td>
                            <td>اجمالى الاقسام</td>
                        </tr>
                        <tr>
                            <td>صنف</td>
                            <td><?php echo e($categories_count); ?></td>
                            <td>اجمالى الاصناف</td>
                        </tr>
                        <tr>
                            <td>سلفه</td>
                            <td><?php echo e($borrows_count); ?></td>
                            <td>عدد السلف</td>
                        </tr>
                        <tr>
                            <td>دين</td>
                            <td><?php echo e($debtes_count); ?></td>
                            <td>عدد الديون</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td><?php echo e($total_debtes); ?></td>
                            <td>اجمالى الديون</td>
                        </tr>
                        <tr>
                            <td>مستحقات</td>
                            <td><?php echo e($dues_count); ?></td>
                            <td>عدد المستحقات</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td><?php echo e($total_dues); ?></td>
                            <td>اجمالى المستحقات</td>
                        </tr>
                        <tr>
                            <td>مبيعات</td>
                            <td><?php echo e($sales_count); ?></td>
                            <td>عدد المبيعات</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td><?php echo e($total_sales); ?></td>
                            <td>اجمالى المبيعات</td>
                        </tr>
                        <tr>
                            <td>مشتريات</td>
                            <td><?php echo e($purchase_count); ?></td>
                            <td>عدد المشتريات</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td><?php echo e($total_purchase); ?></td>
                            <td>اجمالى المشتريات</td>
                        </tr>
                        <tr>
                            <td>جنيه</td>
                            <td><?php echo e($total_gain); ?></td>
                            <td>اجمالى الارباح بعد خصم (المشتريات والتكاليف)</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right hidden-print">
                            <button name="print_table" type="submit" class="btn btn-primary"><i class="fa fa-print"></i> طباعه</button>
                            </td>
                        </tr>
                    </table>
                  </div>
              </div>
          </div>
      </div>
      
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>