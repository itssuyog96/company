<?php include('_header.php'); ?>

<body class="page-login">
<main class="page-content">
        <div class="page-inner">
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-3 center">
                        <div class="login-box">
                            <a href="index.php" class="logo-name text-lg text-center">Company</a>
                            
                          <?php if ($login->passwordResetLinkIsValid() == true) { ?>
                          <form class="m-t-md" method="post" action="password_reset.php" name="new_password_form">
                            <p class="text-center m-t-md">Please enter new password.</p>
                              <input type='hidden' name='user_name' value='<?php echo htmlspecialchars($_GET['user_name']); ?>' />
                              <input type='hidden' name='user_password_reset_hash' value='<?php echo htmlspecialchars($_GET['verification_code']); ?>' />

                              <div class="form-group">
                                <input id="user_password_new" class="form-control" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
                            </div>

                              <div class="form-group">
                              <input id="user_password_repeat" class="form-control" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
                            </div>
                              <button type="submit" name="submit_new_password" ><?php echo WORDING_SUBMIT_NEW_PASSWORD; ?></button>
                          </form>
                          <!-- no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form -->
                          <?php } else { ?>
                          <p class="text-center m-t-md">Enter your username.</p>
                          <form method="post" action="password_reset.php" name="password_reset_form">
                              <div class="form-group">
                                <input id="user_name" class="form-control" type="text" name="user_name" required />
                            </div>
                              <button type="submit" class="btn btn-success btn-block" name="request_password_reset"><?php echo WORDING_RESET_PASSWORD; ?></button>
                          </form>
                          <?php } ?>

                          <p class="text-center m-t-md"><a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a> </p>

                          
                            <p class="text-center m-t-xs text-sm">2015 &copy; Company by the-wire-coders.</p>
                        </div>
                    </div>
                </div><!-- Row -->
            </div><!-- Main Wrapper -->
        </div><!-- Page Inner -->
    </main><!-- Page Content -->
</body>

<?php include('_footer.php'); ?>
