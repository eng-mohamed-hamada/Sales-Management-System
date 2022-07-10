<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link rel="stylesheet" href=<?php echo e(asset("css/bootstrap.min.css")); ?>>
    <link href="<?php echo e(asset('css/css/font-awesome.min.css')); ?>" rel="stylesheet">
    
    <script src=<?php echo e(asset("js/html5shiv.min.js")); ?>></script>
    <script src=<?php echo e(asset("js/respond.min.js")); ?>></script>
    <link href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet">
</head>
<body>
    <div id="app">

        <div class="container-fluid">
            <div class="row">                    
                      <div class="login-container col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 text-right">
                        <div class="panel panel-default">
                            <div class="login-logo-container text-center">
                            <img class="img-responsive img-circle img-thumbnail" src="<?php echo e(asset("images/default.jpg")); ?>">
                            </div>
            
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" action="<?php echo e(url('login/admin')); ?>">
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
                                            <button type="submit" class="btn btn-primary">
                                                تسجيل دخول
                                            </button>
                                            <br>
                                            <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                                نسيت كلمة السر?
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        
    </div>

    <!-- Scripts -->
    <script src=<?php echo e(asset("js/jquery-3.2.1.min.js")); ?>></script>
    <script src=<?php echo e(asset("js/bootstrap.min.js")); ?>></script>
    <script src="<?php echo e(asset("js/js.js")); ?>"></script>
    <script src="<?php echo e(asset("js/jquery.nicescroll.min.js")); ?>"></script>
</body>
</html>
