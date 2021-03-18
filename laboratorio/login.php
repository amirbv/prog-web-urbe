<?php 
require_once('./header.php');

$error = false;

if ( isLoggedIn() ) {
  header( "Location: ./index.php" );
  exit();
}

if ( isset( $_POST ) && isset( $_POST[ 'control' ] ) ) {

  $access = null;

  $user = ( isset( $_POST[ 'username' ] ) ? filter_var( $_POST[ 'username' ], FILTER_SANITIZE_STRING ) : null );
  $pass = ( isset( $_POST[ 'password' ] ) ? filter_var( $_POST[ 'password' ], FILTER_SANITIZE_STRING ) : null );

  if ( $user != null && $pass != null ) {

    $access = loggin( $user, $pass );

    var_dump( $access );

    if ( $access != false ) {
      header( "Location: ./index.php" );
      exit();
    } else {
      $error = true;
    }
  } else {
    $error = true;
  }
}

?><div class="container">
  <div class="row justify-content-center align-items-center">
    <div class="col">
      <div class="card p-4 m-4">
        <h2 class="heading text-center">Iniciar sesión</h2>
        <form method="POST" action="">
          <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <input type="text" class="form-control" name="username" id="username" aria-describedby="usuariohelp">
            <div id="usuariohelp" class="form-text">Ingresa el usuario (por defecto admin)</div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="passhelp">
            <div id="passhelp" class="form-text">Ingresa la contraseña (por defecto admin)</div>
          </div>
          <div class="input-group has-validation">
            <button type="submit" name="control" class="btn btn-primary text-center <?php if ( $error != false ) { echo "is-invalid"; } ?>" aria-describedby="validationServerUsernameFeedback">Ingresar</button>
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
              <p>Usuario o contraseña no valido</p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once('./footer.php');
