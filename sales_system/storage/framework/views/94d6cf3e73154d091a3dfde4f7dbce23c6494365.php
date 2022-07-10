<?php $__env->startSection('content'); ?>
<?php if(session('status')): ?>
    <div class="alert alert-success">
        <?php echo e(session('status')); ?>

    </div>
<?php endif; ?>

<form class="form-horizontal" method="POST" action="<?php echo e(route('password.email')); ?>">
    <?php echo e(csrf_field()); ?>


    <div class=" form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
        <label for="email" class="col-xs-12 text-center">الايميل</label>

        <div class="col-xs-12">
            <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

            <?php if($errors->has('email')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group col-xs-12 text-center">
        <button type="submit" class="btn btn-success col-xs-12">ارسال رابط تعيين الرقم السرى</button>
        <a class="btn btn-link col-xs-12" href="<?php echo e(url("/login")); ?>">
            تسجيل دخول 
        </a>    
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>