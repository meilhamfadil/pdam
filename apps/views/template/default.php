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
<body id="page-top">
    
    <?= $this->load->view("template/navigation"); ?>
    <div id="wrapper">
        <?= $this->load->view("template/sidebar"); ?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <?php foreach($breadcrumb as $b): ?>
                        <li class="breadcrumb-item"><?= $b ?></li>
                    <?php endforeach; ?>
                </ol>
                <?= $this->load->view((empty($page)) ? "default" : $page); ?>
            </div>
        </div>
        <?= $this->load->view("template/footer.php"); ?>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="zmdi zmdi-chevron-up"></i>
    </a>
    <?= $this->load->view("template/modal.php"); ?>
    
    <?= script("jquery/jquery.min.js", TRUE) ?>
    <?= script("bootstrap4/js/bootstrap.bundle.min.js", TRUE) ?>
    <?= script("jquery-easing/jquery.easing.min.js", TRUE) ?>
    <?= script("moment/moment.js", TRUE) ?>
    <?= script("toastr/toastr.min.js", TRUE) ?>
    <?= (isset($libs)) ? libs($libs, "js") : "" ?>
    <?= script("js/syntetic.js") ?>
    <?= script("js/sb-admin.min.js") ?>
    <?= script("js/app.js") ?>
    <?= (isset($js)) ? "<script>" . $this->load->view($js, null, true) . "</script>" : "" ; ?>
    
</body>
</html>