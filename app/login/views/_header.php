<!DOCTYPE html>
<html>
    <head>

        <!-- Title -->
        <title>Company - Dashboard</title>

        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="the-wire-coders" />

        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="../../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="../../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>

        <!-- Theme Styles -->
        <link href="../../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/css/themes/white.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="../../assets/css/custom.css" rel="stylesheet" type="text/css"/>

        <script src="../../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="../../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

<div>


  </div>

  <body class="page-login">
<main class="page-content">
        <div class="page-inner">
            <div id="main-wrapper">
                <div class="row">


  <?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo '<div class="alert alert-danger" role="alert">'.$error.'</div';
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo '<div class="alert alert-warning alert-dismissible" role="alert"><button class="close" aria-label="Close" type="button" data-dismiss="alert"><span aria-hidden="true">×</span></button>'.$message.'</div>';
        }
    }
}
?>

<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo '<div class="alert alert-danger" role="alert">'.$error.'</div';
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo '<div class="alert alert-warning alert-dismissible" role="alert"><button class="close" aria-label="Close" type="button" data-dismiss="alert"><span aria-hidden="true">×</span></button>'.$message.'</div>';
        }
    }
}
?>
</div>
