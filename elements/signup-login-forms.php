
<!--BANNER IMAGE-->
    <div id="runners-home">
            <div class="centered-box"></div>
            <h1 class="centered-header">RUN.LOG.SHARE.</h1>
    </div><!-- #runners-home -->

<!--Login Form & Join Link-->
    <div class="container-fluid home-container">
        <div class="row">
            <div class="col-md-4">
                <div class="login-form">
                    <h2>LOGIN:</h2>
                    <?=!empty($_SESSION['login_attempt_msg']) ? $_SESSION['login_attempt_msg'] : '' ?>
                    <form action="/users/login.php" method="post">
                        <div id="form-closer" class="form-group">
                            <input class="form-control form-red" type="text" name="username" placeholder="USERNAME">
                        </div>
                        <div id="form-closer" class="form-group">
                            <input class="form-control form-red" type="password" name="password" placeholder="PASSWORD">
                        </div>
                        <input class="btn btn-add-run" type="submit" value="Submit">
                    </form>
                </div>
            </div><!-- .col-md-4 *LOGIN -->

            <div class="col-md-8">
                <p class="sign-up">NEW TO PACER? <a class="sign-up-link" href="/signup.php">SIGN UP HERE</a></p>
                <p class="join-our-community"><a class="sign-up-link" href="/signup.php">JOIN OUR COMMUNITY</a></p>

            </div><!-- .col-md-6 *JOIN -->

        </div><!-- .row -->
    </div><!-- .container -->
