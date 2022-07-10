<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <link rel="stylesheet" href=<?php echo e(asset("css/bootstrap.min.css")); ?>>
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/css/font-awesome.min.css')); ?>" rel="stylesheet">
    
    <script src=<?php echo e(asset("js/html5shiv.min.js")); ?>></script>
    <script src=<?php echo e(asset("js/respond.min.js")); ?>></script>
</head>
<body>
    <div id="app">
        <section class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-sm-10 mynav">
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                      <!-- Brand and toggle get grouped for better mobile display -->
                      <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">برنامج المبيعات</a>
                      </div>
                  
                      <!-- Collect the nav links, forms, and other content for toggling -->
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav text-right">
                          
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo e(auth::user()->name); ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <li><a href="<?php echo e(url("user/logout")); ?>">تسجيل خروج</a></li>
                            </ul>
                          </li>
                        </ul>
                        
                        
                      </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                  </nav>
                  <?php echo $__env->yieldContent('content'); ?>
                </div><!--End Navbar-->

                  <div class="sideBar col-xs-6 col-md-offset-10 col-sm-offset-10 col-md-2 text-right col-sm-2">
                          <a class="list-group-item active"><span class="hidden-sm">برنامج المبيعات</span></a>
                          <a class="user-data text-center list-group-item">
                          <img class="user-img img-responsive img-circle img-thumbnail" src="<?php echo e(asset("images/".Auth::user()->photo)); ?>">
                          <h4><span><?php echo e(auth::user()->name); ?></span></h4>
                          <a class="text-center list-group-item active" href="<?php echo e(url("user/settings")); ?>"><span>الاعدادت</span></a>
                          </a>
                          <a class="list-group-item" href="<?php echo e(url("/sales")); ?>"><span>المبيعات</span> <span class="fa fa-home"></span></a>
                  </div>
                  <input class="visible-xs sideBar-button" type="button" value="+">
                  <div class="load_content fom-group text-center">
                    <img class="load_image" src="<?php echo e(asset("images/load_image.jpg")); ?>">
                  </div>
                  
                  <div id="show_photo" class="text-center col-xs-12">
                    
                  </div>
                  
                  
                  <div id="update" class="text-right col-xs-12">
                    
                  </div>
                  
                  <div id="alert_message" class="alert_message text-center alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                  </div>
            </div>
        </section>

        
    </div>

  <script src=<?php echo e(asset("js/jquery-3.2.1.min.js")); ?>></script>
    <script src=<?php echo e(asset("js/bootstrap.min.js")); ?>></script>
    <script src="<?php echo e(asset("js/js.js")); ?>"></script>
    <script src="<?php echo e(asset("js/jquery.nicescroll.min.js")); ?>"></script>
</body>
</html>
