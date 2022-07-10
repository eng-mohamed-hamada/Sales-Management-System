<?php $__env->startSection('content'); ?>
<form class="form-horizontal" method="POST" action="<?php echo e(route('register')); ?>" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>



        <div class="col-xs-12">
            <label for="email" class="control-label">الايميل</label>
            <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

            <?php if($errors->has('email')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
            <?php endif; ?>
        </div>

        <div class="col-xs-12">
            <label for="photo" class="control-label">الصوره</label>
            <input id="photo" type="file" class="form-control" name="photo" value="<?php echo e(old('photo')); ?>" required>

            <?php if($errors->has('photo')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('photo')); ?></strong>
                </span>
            <?php endif; ?>
        </div>

        <div class="col-xs-12">
            <label for="national_number" class="control-label">الرقم القومى</label>
            <input id="national_number" type="text" class="form-control" name="national_number" value="<?php echo e(old('national_number')); ?>" required>
            
            <?php if($errors->has('national_number')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('national_number')); ?></strong>
                </span>
            <?php endif; ?>
        </div>

        <div class="col-xs-12">
            <label for="password" class="control-label">الرقم السرى</label>
            <input id="password" type="password" class="form-control" name="password" required>

            <?php if($errors->has('password')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                </span>
            <?php endif; ?>
        </div>


        <div class="col-xs-12">
            <label for="password-confirm" class="control-label">تاكيد الرقم السرى</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="col-xs-12">
            <br>
            <button type="submit" class="btn btn-success col-xs-12">
                إنشاء حساب
            </button>
            <a class="btn btn-link col-xs-12" href="<?php echo e(url("/login")); ?>">
                تسجيل دخول 
            </a>
            
            
        </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>