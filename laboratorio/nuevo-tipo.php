<?php 
require_once( './header.php' );

$mensaje = false;

if ( isset( $_POST ) && isset( $_POST[ 'control' ] ) ) {

  $error = false;

  $tipo_examenes = tipo_examenes();

  if ( isset( $_POST[ 'type' ] ) ) {

    $name = filter_var( $_POST[ 'type' ], FILTER_SANITIZE_STRING );

    if ( count( $tipo_examenes ) > 0 ) {

      foreach ( $tipo_examenes as $examen ) {

        if ( strtolower( $examen[ 'name' ] ) == strtolower( $name ) ) {
          $error = true;
        }
      }
    }

    if ( $error != true ) {

      $insertado = insertar_tipo_examen( $name );

      if ( $insertado != true ) {
        $error = false;
        $mensaje = true;
      }
    }

  } else {
    $error = true;
  }
}

?><div class="container">
  <div class="row justify-content-center align-items-center">
    <div class="col">
      <?php if ( $mensaje != false ): ?>
        <div class="alert alert-success" role="alert">
          <p>Registro exitoso de tipo de examen</p>
        </div>
      <?php endif ?>
      <div class="card p-4 m-4">
        <h2 class="heading text-center">Añade un nuevo tipo de examen</h2>
        <form method="POST" action="">
          <div class="mb-3">
            <label for="newType" class="form-label">Nuevo tipo de examen</label>
            <input type="text" name="type" class="form-control" id="newType" required>
          </div>
          <button type="submit" name="control" class="btn btn-primary text-center <?php if ( $error != false ) { echo "is-invalid"; } ?>" aria-describedby="validationServerExamenFeedback">Añadir</button>
          <div id="validationServerExamenFeedback" class="invalid-feedback">
            <p>Error en el nombre del examen</p>
          </div>
        </form>
      </div>
    </div>
    <a href="./registro.php">Volver al registro</a>
  </div>
</div>
<?php require_once('./footer.php');
