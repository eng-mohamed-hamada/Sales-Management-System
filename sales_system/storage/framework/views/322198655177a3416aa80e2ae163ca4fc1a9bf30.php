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
                                <?php echo $__env->yieldContent('content'); ?>
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
