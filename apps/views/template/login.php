<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= assets("img/favicon.png"); ?>">
    <title><?= APPNAME ?></title>

    <?= linkrel("bootstrap4/css/bootstrap.min.css", TRUE) ?>
    <?= linkrel("icon/css/material-design-iconic-font.min.css", TRUE) ?>
    <?= linkrel("toastr/toastr.min.css", TRUE) ?>
    <?= linkrel("css/generic_classes.css") ?>
    <?= (isset($libs)) ? libs($libs, "css") : "" ?>
    <?= linkrel("css/sb-admin.min.css") ?>
    <?= linkrel("css/app.css") ?>
</head>
<body id="page-top" class="bg-login">
    
    <div id="wrapper">
        <div class="col-md-4 offset-md-4 m-t-30">
			<div class="card login-pane">
				<div class="card-body">
					<h3 class="text-center">Login</h3>
					<hr>
					<div class="clearfix m-t-30"></div>
					<form id="form" class="form-horizontal fs16" role="form" method="POST" action="<?= base_url("login/proccess") ?>">
						<div class="form-group row">
							<label for="" class="col-sm-1 offset-sm-2 col-form-label text-right"><i class="zmdi zmdi-account"></i></label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="username" placeholder="Username">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-1 offset-sm-2 col-form-label text-right"><i class="zmdi zmdi-lock"></i></label>
							<div class="col-sm-7">
								<input type="password" class="form-control" name="password" placeholder="Password">
							</div>
						</div>
						<div class="form-group text-center">
							<button class="btn btn-primary">Login</button>
						</div>
					</form>
				</div>
			</div>
			<p class="text-center m-t-20">&copy; WatchLog 2019</p>
		</div>
    </div>
    
    <?= script("jquery/jquery.min.js", TRUE) ?>
    <?= script("bootstrap4/js/bootstrap.bundle.min.js", TRUE) ?>
    <?= script("jquery-easing/jquery.easing.min.js", TRUE) ?>
    <?= script("moment/moment.js", TRUE) ?>
    <?= script("toastr/toastr.min.js", TRUE) ?>
    <?= script("js/syntetic.js") ?>
    <?= script("js/sb-admin.min.js") ?>
    <?= script("js/app.js") ?>
    <?= (isset($js)) ? "<script>" . $this->load->view($js, null, true) . "</script>" : "" ; ?>
    
</body>
</html>