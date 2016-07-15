<?php include('_header.php'); ?>
<body class="page-login">
<main class="page-content">
        <div class="page-inner">
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-3 center">
                        <div class="login-box">
                            <a href="index.php" class="logo-name text-lg text-center">Company</a>
                            <p class="text-center m-t-md">Please login into your account.</p>
                            <form class="m-t-md" action="index.php" method="POST">
                                <div class="form-group">
                                    <input id="user_name" name="user_name" type="text" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <input id="user_password" name="user_password" type="password" class="form-control" placeholder="Password" autocomplete="off" required>
                                </div>
                                <!--button type="submit" class="btn btn-success btn-block"><?php //echo WORDING_LOGIN; ?></button-->
                              <input type="submit" name="login" class="btn btn-success btn-block" value="<?php echo WORDING_LOGIN; ?>" />
                              <br>
                                <div class="form-group">
                                    <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
                                    <label for="user_rememberme"><?php echo WORDING_REMEMBER_ME; ?></label>
                                </div>
                                <a href="password_reset.php" class="display-block text-center m-t-md text-sm"><?php echo WORDING_FORGOT_MY_PASSWORD; ?></a>
                                <!--p class="text-center m-t-xs text-sm">Do not have an account?</p>
                                <a href="register.html" class="btn btn-default btn-block m-t-md">Create an account</a-->
                          </form>                           
                            <p class="text-center m-t-xs text-sm">2015 &copy; Company by the-wire-coders.</p>
                        </div>
                    </div>
                  </div><!-- Row -->
            </div><!-- Main Wrapper -->
        </div><!-- Page Inner -->
    </main><!-- Page Content -->
                </div><!-- Row -->
            </div><!-- Main Wrapper -->
        </div><!-- Page Inner -->
    </main><!-- Page Content -->
</body>
<?php include('_footer.php'); ?>
