<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.php"><img src="navbarBrand.jpg" width="30" height="30"></a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="score.php">Score</a>
            </li>
          </ul>
          <?php if ($_COOKIE['connected'] == false) {?>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
              Login
          </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerModal">
              Register              
          </button>
          <?php } else {?>
            <form>
              <input type="hidden" name="disconnect" value="0">
              <button type="submit" class="btn btn-primary" >Disconnect</button>      
            </form>
          <?php }?>
        </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post">
        <div class="form-group">
          <label for="usernameLogin">Username</label>
          <input type="text" class="form-control" id="usernameLogin" name="usernameLogin" aria-describedby="emailHelp" placeholder="Enter username">
        </div>
        <div class="form-group">
          <label for="passwordLogin">Password</label>
          <input type="password" class="form-control" id="passwordLogin" name="passwordLogin" placeholder="Enter password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post">
        <div class="form-group">
          <label for="usernameRegister">Username</label>
          <input type="text" class="form-control" id="usernameRegister" name="usernameRegister" aria-describedby="emailHelp" placeholder="Enter username">
        </div>
        <div class="form-group">
          <label for="passwordRegister">Password</label>
          <input type="password" class="form-control" id="passwordRegister" name="passwordRegister" placeholder="Enter password">
          <label for="passwordRepeat">Repeat Password</label>
          <input type="password" class="form-control" id="passwordRepeat" name="passwordRepeat" placeholder="Repeat password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
    </div>
  </div>
</div>
