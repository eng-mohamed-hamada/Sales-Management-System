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
    <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">
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
                        <a class="navbar-brand" href="#"><?php echo e(config('app.name', 'Laravel')); ?></a>
                      </div>
                  
                      <!-- Collect the nav links, forms, and other content for toggling -->
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav text-right">
                          <?php if(Auth::user()->permission == 'admin'): ?>
                          <li>
                            <a href="<?php echo e(url("/charts")); ?>"><span class="fa fa-bell"><span class="badge"><?php echo e(app("notifiy_count")); ?></span></span></a>
                          </li>
                          <?php endif; ?>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo e(auth::user()->name); ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <?php if(Auth::user()->permission == 'admin'): ?>
                                <li><a href="<?php echo e(url("/accounts")); ?>">إنشاء مستخدم جديد</a></li>
                              <?php endif; ?>
                              <li><a href="<?php echo e(url("/logout")); ?>">تسجيل خروج</a></li>
                            </ul>
                          </li>
                        </ul>
                        
                        
                      </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                  </nav>
                  <?php echo $__env->yieldContent('content'); ?>
                  
                </div><!--End Navbar-->

                  <div class="sideBar col-xs-6 col-md-offset-10 col-sm-offset-10 col-md-2 text-right col-sm-2">
                          <a class="list-group-item active text-center"><span class="hidden-sm"><?php echo e(config('app.name', 'Laravel')); ?></span></a>
                          <a class="user-data text-center list-group-item">
                          <img class="user-img img-responsive img-circle img-thumbnail" src="<?php echo e(asset("images/".Auth::user()->photo)); ?>">
                          <h4><span><?php echo e(auth::user()->name); ?></span></h4>
                          <a class="text-center list-group-item active" href="<?php echo e(url("/settings")); ?>"><span>حسابى</span></a>
                          </a>
                          <a class="list-group-item" href="<?php echo e(url("/sales")); ?>"><span>المبيعات</span> <span class="fa fa-product-hunt"></span></a>
                          <?php if(Auth::user()->permission == 'admin'): ?>
                            <a class="list-group-item" href="<?php echo e(url("/products")); ?>"><span>المنتجات</span> <span class="fa fa-product-hunt"></span></a>
                            <a class="list-group-item" href="<?php echo e(url("/suppliers")); ?>"><span>الموردين</span> <span class="fa fa-users"></span></a>
                            <a class="list-group-item" href="<?php echo e(url("/purchases")); ?>"><span>المشتريات</span> <span class="fa fa-shopping-bag"></span></a>
                            <a class="list-group-item" href="<?php echo e(url("/employees")); ?>"><span>الموظفين</span> <span class="fa fa-user-plus"></span></a>
                            <a class="list-group-item" href="<?php echo e(url("/degrees")); ?>"><span>الدرجه الوظيفيه</span> <span class="fa fa-user-plus"></span></a>
                            <a class="list-group-item" href="<?php echo e(url("/departments")); ?>"><span>الاقسام</span> <span class="fa fa-user-plus"></span></a>
                            <a class="list-group-item" href="<?php echo e(url("/categories")); ?>"><span>الاصناف</span> <span class="fa fa-file"></span></a>
                            <a class="list-group-item" href="<?php echo e(url("/attendees")); ?>"><span>الحضور</span> <span class="fa fa-home"></span></a>
                            <a class="list-group-item" href="<?php echo e(url("/costs")); ?>"><span>التكاليف</span> <span class="fa fa-dollar"></span></a>
                            <a class="list-group-item" href="<?php echo e(url("/borrows")); ?>"><span>السلف</span> <span class="fa fa-bell"></span></a>
                            <a class="list-group-item" href="<?php echo e(url("/installments")); ?>"><span>الاقساط</span> <span class="fa fa-calendar"></span></a>
                            <a class="list-group-item" href="<?php echo e(url("/debtes")); ?>"><span>الديون</span> <span class="fa fa-bell"></span></a>
                            <a class="list-group-item" href="<?php echo e(url("/dues")); ?>"><span>المستحقات</span> <span class="fa fa-bell"></span></a>
                            <a class="list-group-item" href="<?php echo e(url("/info")); ?>"><span>الاحصائيات</span> <span class="fa fa-bell"></span></a>
                          <?php endif; ?>
                  </div>
                  <input class="visible-xs sideBar-button" type="button" value="+">
                  <div class="load_content form-group text-center">
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
