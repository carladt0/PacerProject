<!--PACER-->

<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="/"> <img class="logo" src="/assets/images/pacer-logo.png" alt="Pacer Logo"> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">

        <?php
        //check if user is logged in, show welcome links.

            if( $_SESSION['user_logged_in']  ){
                $u = new User;
                $user = $u->get_by_id( $_SESSION['user_logged_in']);

                ?>

                      <li class="nav-item">
                        <a class="nav-link" href="/index.php"> |&nbsp&nbsp&nbspYOUR FEED</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/profile.php"> |&nbsp&nbsp&nbspYOUR PROFILE</a>
                     </li>
                     <li class="nav-item">
                       <a class="nav-link" href="/support.php"> |&nbsp&nbsp&nbspSUPPORT</a>
                    </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/users/logout.php"> |&nbsp&nbsp&nbspLOGOUT</a>
                     </li>
                     <p class="social-network-runners">A SOCIAL NETWORK FOR RUNNERS</p>
                  <?php }else{ //user not logged in ?>


      <li class="nav-item active">
        <a class="nav-link" href="/index.php"> |&nbsp&nbsp&nbspLOGIN<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/signup.php"> |&nbsp&nbsp&nbspSIGN-UP</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/support.php"> |&nbsp&nbsp&nbspSUPPORT</a>
    </li>
    <p class="social-network-runners">A SOCIAL NETWORK FOR RUNNERS</p>


     <?php } ?>
    </ul>
  </div>
</nav>
