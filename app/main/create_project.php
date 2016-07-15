<?php


require_once('../login/classes/Login.php');
require_once('../../scripts/sql/shared/ez_sql_core.php');
require_once('../../scripts/sql/mysqli/ez_sql_mysqli.php');
require_once('../../scripts/db-config.php');


$login = new Login();

require_once('../../scripts/classes/employee.php');
require_once('../../scripts/classes/artist.php');

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == false)
{
    header('Location:../login/');
}

$e = new Employee();

if($e->get_emp('oplogno') == 999){
    header("Location: ../firstLogin.php");
}
/* else{

   if(strcmp($e->get_emp('rolenm'), 'DEPARTMENT MANAGER') == 0){
       header("Location: ../manager/manageUsers.php");

   }

 }
*/
$a = new Artist();

//$db = new ezSQL_mysqli(EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME,EZSQL_DB_HOST);

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Title -->
    <title>
        <?php echo TITLE; ?>
    </title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="UTF-8">
    <meta name="description" content="Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="the-wire-coders" />
    <!-- Styles -->
    <link href='../../assets/custom/open-sans-400-300-600.css' rel='stylesheet' type='text/css'>
    <link href="../../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet" />
    <link href="../../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet" />
    <link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
    <link href="../../assets/plugins/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../../assets/plugins/x-editable/inputs-ext/address/address.css" rel="stylesheet" type="text/css">
    <link href="../../assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/plugins/toastr/toastr.min.css" rel="stylesheet" />
    <!-- Theme Styles -->
    <link href="../../assets/css/modern.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/themes/white.css" class="theme-color" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/custom.css" rel="stylesheet" type="text/css" />
    <script src="../../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
    <script src="../../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="page-header-fixed">
<div class="overlay"></div>
<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s1">
    <h3><span class="pull-left">Chat</span><a href="javascript:void(0);" class="pull-right" id="closeRight"><i class="fa fa-times"></i></a></h3>
    <div class="slimscroll">
        <a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar1.png" alt=""><span>Sandra smith<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar1.png" alt=""><span>Amily Lee<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar1.png" alt=""><span>Christopher Palmer<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar1.png" alt=""><span>Nick Doe<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar1.png" alt=""><span>Sandra smith<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar1.png" alt=""><span>Amily Lee<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar1.png" alt=""><span>Christopher Palmer<small>Hi! How're you?</small></span></a>
        <a href="javascript:void(0);" class="showRight2"><img src="../../assets/images/avatar1.png" alt=""><span>Nick Doe<small>Hi! How're you?</small></span></a>
    </div>
</nav>
<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
    <h3><span class="pull-left">Sandra Smith</span> <a href="javascript:void(0);" class="pull-right" id="closeRight2"><i class="fa fa-angle-right"></i></a></h3>
    <div class="slimscroll chat">
        <div class="chat-item chat-item-left">
            <div class="chat-image"> <img src="../../assets/images/avatar1.png" alt=""> </div>
            <div class="chat-message"> Hi There! </div>
        </div>
        <div class="chat-item chat-item-right">
            <div class="chat-message"> Hi! How are you? </div>
        </div>
        <div class="chat-item chat-item-left">
            <div class="chat-image"> <img src="../../assets/images/avatar1.png" alt=""> </div>
            <div class="chat-message"> Fine! do you like my project? </div>
        </div>
        <div class="chat-item chat-item-right">
            <div class="chat-message"> Yes, It's clean and creative, good job! </div>
        </div>
        <div class="chat-item chat-item-left">
            <div class="chat-image"> <img src="../../assets/images/avatar1.png" alt=""> </div>
            <div class="chat-message"> Thanks, I tried! </div>
        </div>
        <div class="chat-item chat-item-right">
            <div class="chat-message"> Good luck with your sales! </div>
        </div>
    </div>
    <div class="chat-write">
        <form class="form-horizontal" action="javascript:void(0);">
            <input type="text" class="form-control" placeholder="Say something"> </form>
    </div>
</nav>
<div class="menu-wrap">
    <nav class="profile-menu">
        <div class="profile"><img src="../../assets/images/avatar1.png" width="52" alt="David Green" /><span><?php echo $e->get_emp('name');?></span></div>
        <div class="profile-menu-list"> <a href="#"><i class="fa fa-star"></i><span>Favorites</span></a> <a href="#"><i class="fa fa-bell"></i><span>Alerts</span></a> <a href="#"><i class="fa fa-envelope"></i><span>Messages</span></a> <a href="#"><i class="fa fa-comment"></i><span>Comments</span></a> </div>
    </nav>
    <button class="close-button" id="close-button">Close Menu</button>
</div>
<form class="search-form" action="#" method="GET">
    <div class="input-group">
        <input type="text" name="search" class="form-control search-input" placeholder="Search..."> <span class="input-group-btn">
                    <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
                </span> </div>
    <!-- Input Group -->
</form>
<!-- Search Form -->
<main class="page-content content-wrap">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="sidebar-pusher">
                <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar"> <i class="fa fa-bars"></i> </a>
            </div>
            <div class="logo-box"> <a href="index.html" class="logo-text"><span><?php echo COMPANY; ?></span></a> </div>
            <!-- Logo Box -->
            <div class="search-button"> <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a> </div>
            <div class="topmenu-outer">
                <div class="top-menu">
                    <ul class="nav navbar-nav navbar-left">
                        <li> <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a> </li>
                        <li> <a href="#cd-nav" class="waves-effect waves-button waves-classic cd-nav-trigger"><i class="fa fa-diamond"></i></a> </li>
                        <li> <a href="javascript:void(0);" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a> </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"> <i class="fa fa-cogs"></i> </a>
                            <ul class="dropdown-menu dropdown-md dropdown-list theme-settings" role="menu">
                                <li class="li-group">
                                    <ul class="list-unstyled">
                                        <li class="no-link" role="presentation"> Fixed Header
                                            <div class="ios-switch pull-right switch-md">
                                                <input type="checkbox" class="js-switch pull-right fixed-header-check" checked> </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="li-group">
                                    <ul class="list-unstyled">
                                        <li class="no-link" role="presentation"> Fixed Sidebar
                                            <div class="ios-switch pull-right switch-md">
                                                <input type="checkbox" class="js-switch pull-right fixed-sidebar-check"> </div>
                                        </li>
                                        <li class="no-link" role="presentation"> Horizontal bar
                                            <div class="ios-switch pull-right switch-md">
                                                <input type="checkbox" class="js-switch pull-right horizontal-bar-check"> </div>
                                        </li>
                                        <li class="no-link" role="presentation"> Toggle Sidebar
                                            <div class="ios-switch pull-right switch-md">
                                                <input type="checkbox" class="js-switch pull-right toggle-sidebar-check"> </div>
                                        </li>
                                        <li class="no-link" role="presentation"> Compact Menu
                                            <div class="ios-switch pull-right switch-md">
                                                <input type="checkbox" class="js-switch pull-right compact-menu-check"> </div>
                                        </li>
                                        <li class="no-link" role="presentation"> Hover Menu
                                            <div class="ios-switch pull-right switch-md">
                                                <input type="checkbox" class="js-switch pull-right hover-menu-check"> </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="li-group">
                                    <ul class="list-unstyled">
                                        <li class="no-link" role="presentation"> Boxed Layout
                                            <div class="ios-switch pull-right switch-md">
                                                <input type="checkbox" class="js-switch pull-right boxed-layout-check"> </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="li-group">
                                    <ul class="list-unstyled">
                                        <li class="no-link" role="presentation"> Choose Theme Color
                                            <div class="color-switcher">
                                                <a class="colorbox color-blue" href="?theme=blue" title="Blue Theme" data-css="blue"></a>
                                                <a class="colorbox color-green" href="?theme=green" title="Green Theme" data-css="green"></a>
                                                <a class="colorbox color-red" href="?theme=red" title="Red Theme" data-css="red"></a>
                                                <a class="colorbox color-white" href="?theme=white" title="White Theme" data-css="white"></a>
                                                <a class="colorbox color-purple" href="?theme=purple" title="purple Theme" data-css="purple"></a>
                                                <a class="colorbox color-dark" href="?theme=dark" title="Dark Theme" data-css="dark"></a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="no-link">
                                    <button class="btn btn-default reset-options">Reset Options</button>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li> <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a> </li>
                        <li class="dropdown"> <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="badge badge-success pull-right">4</span></a>
                            <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                <li>
                                    <p class="drop-title">You have 4 new messages !</p>
                                </li>
                                <li class="dropdown-menu-list slimscroll messages">
                                    <ul class="list-unstyled">
                                        <li>
                                            <a href="#">
                                                <div class="msg-img">
                                                    <div class="online on"></div><img class="img-circle" src="../../assets/images/avatar1.png" alt=""></div>
                                                <p class="msg-name">Sandra Smith</p>
                                                <p class="msg-text">Hey ! I'm working on your project</p>
                                                <p class="msg-time">3 minutes ago</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="msg-img">
                                                    <div class="online off"></div><img class="img-circle" src="../../assets/images/avatar1.png" alt=""></div>
                                                <p class="msg-name">Amily Lee</p>
                                                <p class="msg-text">Hi David !</p>
                                                <p class="msg-time">8 minutes ago</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="msg-img">
                                                    <div class="online off"></div><img class="img-circle" src="../../assets/images/avatar1.png" alt=""></div>
                                                <p class="msg-name">Christopher Palmer</p>
                                                <p class="msg-text">See you soon !</p>
                                                <p class="msg-time">56 minutes ago</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="msg-img">
                                                    <div class="online on"></div><img class="img-circle" src="../../assets/images/avatar1.png" alt=""></div>
                                                <p class="msg-name">Nick Doe</p>
                                                <p class="msg-text">Nice to meet you</p>
                                                <p class="msg-time">2 hours ago</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="msg-img">
                                                    <div class="online on"></div><img class="img-circle" src="../../assets/images/avatar1.png" alt=""></div>
                                                <p class="msg-name">Sandra Smith</p>
                                                <p class="msg-text">Hey ! I'm working on your project</p>
                                                <p class="msg-time">5 hours ago</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="msg-img">
                                                    <div class="online off"></div><img class="img-circle" src="../../assets/images/avatar1.png" alt=""></div>
                                                <p class="msg-name">Amily Lee</p>
                                                <p class="msg-text">Hi David !</p>
                                                <p class="msg-time">9 hours ago</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="drop-all"><a href="#" class="text-center">All Messages</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"> <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="badge badge-success pull-right">3</span></a>
                            <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                <li>
                                    <p class="drop-title">You have 3 pending tasks !</p>
                                </li>
                                <li class="dropdown-menu-list slimscroll tasks">
                                    <ul class="list-unstyled">
                                        <li>
                                            <a href="#">
                                                <div class="task-icon badge badge-success"><i class="icon-user"></i></div> <span class="badge badge-roundless badge-default pull-right">1min ago</span>
                                                <p class="task-details">New user registered.</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="task-icon badge badge-danger"><i class="icon-energy"></i></div> <span class="badge badge-roundless badge-default pull-right">24min ago</span>
                                                <p class="task-details">Database error.</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="task-icon badge badge-info"><i class="icon-heart"></i></div> <span class="badge badge-roundless badge-default pull-right">1h ago</span>
                                                <p class="task-details">Reached 24k likes</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="drop-all"><a href="#" class="text-center">All Tasks</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"> <span class="user-name"><?php echo $e->get_emp('name');?><i class="fa fa-angle-down"></i></span> <img class="img-circle avatar" src="../../assets/images/avatar1.png" width="40" height="40" alt=""> </a>
                            <ul class="dropdown-menu dropdown-list" role="menu">
                                <li role="presentation"><a href="profile.html"><i class="fa fa-user"></i>Profile</a></li>
                                <li role="presentation"><a href="calendar.html"><i class="fa fa-calendar"></i>Calendar</a></li>
                                <li role="presentation"><a href="inbox.html"><i class="fa fa-envelope"></i>Inbox<span class="badge badge-success pull-right">4</span></a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation"><a href="lock-screen.html"><i class="fa fa-lock"></i>Lock screen</a></li>
                                <li role="presentation"><a href="login.html"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="../login/index.php?logout" class="log-out waves-effect waves-button waves-classic"> <span><i class="fa fa-sign-out m-r-xs"></i>Log out</span> </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="waves-effect waves-button waves-classic" id="showRight"> <i class="fa fa-comments"></i> </a>
                        </li>
                    </ul>
                    <!-- Nav -->
                </div>
                <!-- Top Menu -->
            </div>
        </div>
    </div>
    <!-- Navbar -->
    <div class="page-sidebar sidebar">
        <div class="page-sidebar-inner slimscroll">
            <div class="sidebar-header">
                <div class="sidebar-profile">
                    <a href="javascript:void(0);" id="profile-menu-link">
                        <div class="sidebar-profile-image"> <img src="../../assets/images/avatar1.png" class="img-circle img-responsive" alt=""> </div>
                        <div class="sidebar-profile-details"> <span><?php echo $e->get_emp('name');?><br><small><?php echo $e->get_emp('rolenm');?></small></span> </div>
                    </a>
                </div>
            </div>
            <ul class="menu accordion-menu">
                <li><a href="index.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>

                <li><a href="artist_task_create.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-user"></span><p>Create Task (A)</p></a></li>

                <li><a href="assets_task_assign.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-envelope"></span><p>Task Assign</p><span class="arrow"></span></a></li>

                <li><a href="assets_task_list.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>Task List</p><span class="arrow"></span></a></li>

                <li><a href="assign_roles.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th"></span><p>Assign Roles</p></a></li>

                <li><a href="create_assets_bulk.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list"></span><p>Create Assets (Bulk)</p></a></li>

                <li class="active"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-edit"></span><p>Create Project</p></a></li>

                <li><a href="edit_project.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-stats"></span><p>Edit Project</p></a></li>

                <li><a href="re-assign_roles.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-log-in"></span><p>Reassign Roles</p></a></li>

                <li><a href="review_assets.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-map-marker"></span><p>Review Assets</p></a></li>

                <li><a href="review_tasks.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-gift"></span><p>Review Tasks</p></a> </li>

                <li><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-flash"></span><p>Levels</p></a>
                </li>
            </ul>
        </div>
        <!-- Page Sidebar Inner -->
    </div>
    <!-- Page Sidebar -->
    <div class="page-inner">
        <div class="page-title">
            <h3>Manage Tasks</h3>
            <div class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">All Information</a></li>
                    <li class="active">Manage Tasks</li>
                </ol>
            </div>
        </div>
        <div id="main-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-body">
                            <?php

                            echo '|'.$_SESSION['name'].'|'.$_SESSION['id'].'|';

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-body">
                            <?php

                            echo '|'.$_SESSION['name'].'|'.$_SESSION['id'].'|';

                            ?>
                            <!-- Table for Task List-->
                            <div class="table-responsive">
                                <div id="msg"></div>
                                <table id="taskList" class="table tablesorter">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Project<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>Sequence<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>Shot<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>Version<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>Supervisor/Client Notes<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>End Date<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>End Time<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>Artist Notes<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>Timer</th>
                                    </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>
                            </div>
                            <!-- End of Table for Task List-->

                            <button id="openModalAP" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addProject"> NEW PROJECT </button>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-body">
                            <!-- Table for Completed Task List-->
                            <div class="table-responsive">
                                <div id="msg"></div>
                                <table id="completed-taskList" class="table tablesorter">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Project<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>Sequence<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>Shot<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>Version<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>Supervisor/Client Notes<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>End Date<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>End Time<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>Artist Notes<img src="../../assets/custom/sort-arrows.png" alt="th-img" height="8px" /></th>
                                        <th>Timer</th>
                                    </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>
                            </div>
                            <!-- End of Completed Table for Task List-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row -->
        </div>
        <!-- Main Wrapper -->
        <div class="page-footer">
            <p class="no-s">2015 &copy; by the-wire-coders.</p>
        </div>
    </div>
    <!-- Page Inner -->
</main>
<!-- Page Content -->
<nav class="cd-nav-container" id="cd-nav">
    <header>
        <h3>Navigation</h3> <a href="#0" class="cd-close-nav">Close</a> </header>
    <ul class="cd-nav list-unstyled">
        <li class="cd-selected" data-menu="index">
            <a href="javsacript:void(0);"> <span>
                            <i class="glyphicon glyphicon-home"></i>
                        </span>
                <p>Dashboard</p>
            </a>
        </li>
        <li data-menu="profile">
            <a href="javsacript:void(0);"> <span>
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                <p>Profile</p>
            </a>
        </li>
        <li data-menu="inbox">
            <a href="javsacript:void(0);"> <span>
                            <i class="glyphicon glyphicon-envelope"></i>
                        </span>
                <p>Mailbox</p>
            </a>
        </li>
        <li data-menu="#">
            <a href="javsacript:void(0);"> <span>
                            <i class="glyphicon glyphicon-tasks"></i>
                        </span>
                <p>Tasks</p>
            </a>
        </li>
        <li data-menu="#">
            <a href="javsacript:void(0);"> <span>
                            <i class="glyphicon glyphicon-cog"></i>
                        </span>
                <p>Settings</p>
            </a>
        </li>
        <li data-menu="calendar">
            <a href="javsacript:void(0);"> <span>
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                <p>Calendar</p>
            </a>
        </li>
    </ul>
</nav>
<div class="cd-overlay"></div>


<div id="preview" class="preview">
    <!-- Modal -->
    <div class="modal fade" id="addVersion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button id="close-modal" type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">&times;</span> <span class="sr-only">Close</span> </button>
                    <h4 class="modal-title" id="myModalLabel">
                        ADD NEW TASK
                    </h4> </div>
                <!-- Modal Body -->
                <div id="VersionAdd" class="modal-body">
                    <form id="addVersionForm" name="form" method="POST" class="form-horizontal" role="form">
                        <input type="hidden" id="action" name="action" value="AV" />
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="project">Project</label>
                            <div class="col-sm-10">
                                <select id="project" name="project" class="form-control" placeholder="Select Project">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="seq">Sequence</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="seq" name="seq" placeholder="Sequence no." /> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="shot">Shot</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="shot" name="shot" placeholder="Shot no." /> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="shot">Version</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ver" name="ver" placeholder="Version no." /> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="shot">Notes</label>
                            <div class="col-sm-10">
                                <textarea name="notes" id="notes" cols="40" rows="3" class="form-control" placeholder="Notes..."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="status">Status</label>
                            <div class="col-sm-10">
                                <select id="status" name="status" class="form-control" placeholder="Select Status">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input id="submit" type="submit" name="submit" class="btn btn-default" value="ADD TASK"><img src="../../assets/custom/loading.gif" id="img" style="display:none" /> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="project-modal-div">
    <div id="project-modal" class="project-modal">

        <!-- Modal -->
        <div class="modal fade" id="addProject" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button id = "close-modal" type="button" class="close"
                                data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            ADD NEW PROJECT
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div id ="ProjectAdd" class="modal-body">



                        <form id="addProjectForm" name="form"  method="POST" class="form-horizontal" role="form">

                            <input type="hidden" id="action" name="action" value="CP"/>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="ptype">Project Type</label>
                                <div class="col-sm-8">
                                    <select id="ptype" name="ptype" class="form-control" placeholder="Select Project">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <button id="newProjectTypeBtton" class="btn btn-toolbar btn-md" data-toggle="modal" data-target="#addProjectType">ADD NEW</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"
                                       for="pid" >Project ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                           id="pid" name="pid" placeholder="Project ID"  />
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-2 control-label"
                                        for="pnm">Project Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                           id="pnm" name="pnm" placeholder="Project Name"  />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"
                                       for="pdesc" >Description</label>
                                <div class="col-sm-10">
                                    <textarea name="pdesc" id="pdesc" cols="40" rows="3"  class="form-control" placeholder="Project Description"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"
                                       for="opendt" >Open Date</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control date-picker"
                                           id="opendt" name="opendt" placeholder="Open date for project" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"
                                       for="closedt" >Close Date</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control date-picker"
                                           id="closedt" name="closedt" placeholder="Expected close date for project" />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input id="submit" type="submit" name="submit" class="btn btn-default" value="ADD USER"><img src="../../../assets/custom/loading.gif" id="img" style="display:none"/ >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--ADD NEW PROJECT MODAL-->



<div class="project-type-modal-div">
    <div id="project-type-modal" class="project-type-modal">


        <!-- Modal -->
        <div class="modal fade" id="addProjectType" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button id = "close-modal" type="button" class="close"
                                data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            ADD NEW PROJECT TYPE
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div id ="ProjectTypeAdd" class="modal-body">



                        <form id="addProjectTypeForm" name="form"  method="POST" class="form-horizontal" role="form">

                            <input type="hidden" id="action" name="action" value="APT"/>


                            <div class="form-group">
                                <label class="col-sm-2 control-label"
                                       for="ptype_new" >Project Type</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"
                                           id="ptype_new" name="ptype_new" placeholder="Project Type"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input id="submit" type="submit" name="submit" class="btn btn-default" value="ADD"><img src="../../assets/custom/loading.gif" id="img" style="display:none"/ >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--ADD NEW PROJECT MODAL-->





<!-- Javascripts -->
<script src="../../assets/plugins/jquery/jquery-2.1.3.min.js"></script>
<script src="../../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="../../assets/plugins/pace-master/pace.min.js"></script>
<script src="../../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
<script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../../assets/plugins/switchery/switchery.min.js"></script>
<script src="../../assets/plugins/uniform/jquery.uniform.min.js"></script>
<script src="../../assets/plugins/offcanvasmenueffects/js/classie.js"></script>
<script src="../../assets/plugins/offcanvasmenueffects/js/main.js"></script>
<script src="../../assets/plugins/waves/waves.min.js"></script>
<script src="../../assets/plugins/3d-bold-navigation/js/main.js"></script>
<script src="../../assets/plugins/moment/moment.js"></script>
<script src="../../assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="../../assets/js/modern.min.js"></script>
<script src="../../assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
<script src="../../assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
<script src="../../assets/plugins/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js"></script>
<script src="../../assets/plugins/x-editable/inputs-ext/typeaheadjs/typeaheadjs.js"></script>
<script src="../../assets/plugins/x-editable/inputs-ext/address/address.js"></script>
<script src="../../assets/plugins/select2/js/select2.full.min.js"></script>
<script src="../../assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="../../assets/plugins/toastr/toastr.min.js"></script>
<script src="../../assets/js/pages/form-x-editable.js"></script>
<script src="js/run-toast.js"></script>
<script src="js/manage-project.js"></script>
<script src="js/getProjectType.js"></script>
<script src="../../assets/js/custom.js"></script>
</body>

</html>