<?php include('_header.php'); ?>

<!-- show registration form, but only if we didn't submit already -->
<?php if (!$registration->registration_successful && !$registration->verification_successful) { ?>

                    <div class="col-md-3 center">
                        <div class="login-box">
                            <a href="index.php" class="logo-name text-lg text-center">Company</a>
                            <p class="text-center m-t-md">Register for new account.</p>

                            <form method="post" action="register.php" name="registerform" class="m-t-md">
                                <div class="form-group">
                                  <label for="user_name"><?php echo WORDING_REGISTRATION_USERNAME; ?></label>
                                  <input class="form-control" id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
                              </div>

                              <!--div class="form-group">
                                <label for="user_email"><-?php echo WORDING_REGISTRATION_EMAIL; ?></label>
                                <input id="user_email" class="form-control" type="email" name="user_email" required />
                              </div-->

                              <div class="form-group">
                                <label for="user_password_new"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
                                <input id="user_password_new" class="form-control" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
                              </div>

                              <div class="form-group">
                                <label for="user_password_repeat"><?php echo WORDING_REGISTRATION_PASSWORD_REPEAT; ?></label>
                                <input id="user_password_repeat" class="form-control" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
                              </div>


                              <div class="form-group">
                                <input type="submit" name="register" class="btn btn-success btn-block" value="<?php echo WORDING_REGISTER; ?>" />
                              </div>

                            </form>
                               <p class="text-center m-t-xs text-sm">2015 &copy; Company by the-wire-coders.</p>
                        </div>
                    </div>
                </div><!-- Row -->
            </div><!-- Main Wrapper -->
        </div><!-- Page Inner -->
    </main><!-- Page Content -->
</body>
<?php } ?>

    <a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php'); ?>
