<?php $__env->startSection('content'); ?>
<form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo e(csrf_field()); ?>


    <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
        <label for="email" class="col-md-12">الايميل</label>

        <div class="col-md-12">
            <input id="email" type="email" class="text-center form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

            <?php if($errors->has('email')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
        <label for="password" class="col-md-12">كلمة المرورو</label>

        <div class="col-md-12">
            <input id="password" type="password" class="text-center form-control" name="password" required>

            <?php if($errors->has('password')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12 text-left">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> تذكرنى
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-success col-xs-12">
                تسجيل دخول
            </button>
            <br>
            <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                نسيت كلمة السر?
            </a>
            <a class="btn btn-success col-xs-12" href="<?php echo e(url("/register")); ?>">
                انشاء حساب جديد
            </a>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>