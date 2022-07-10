<?php $__env->startSection('content'); ?>

        <div class="myContainer text-right col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">حسابى</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(url('/settings')); ?>" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('photo') ? ' has-error' : ''); ?>">

                            <div class="col-xs-12">
                                <label for="photo" class="control-label">الصوره</label>
                                <input id="photo" type="file" class="form-control" name="photo" value="<?php echo e(old('photo')); ?>" required>

                                <?php if($errors->has('photo')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('photo')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">

                            <div class="col-xs-12">
                                <label for="password" class="control-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-xs-12">
                                <label for="password-confirm" class="control-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary">
                                    حفظ الاعدادات
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>