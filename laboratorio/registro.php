<?php 
require_once( './header.php' );

$error = false;
$mensaje = false;
$tipo_examenes = tipo_examenes();

if ( isset( $_POST ) && isset( $_POST[ 'control' ] ) ) {

  $fullName = filter_var( $_POST[ 'fullName' ], FILTER_SANITIZE_STRING );
  $ci = filter_var( $_POST[ 'ci' ], FILTER_SANITIZE_STRING );
  $email = filter_var( $_POST[ 'email' ], FILTER_SANITIZE_STRING );
  $type = filter_var( $_POST[ 'type' ], FILTER_SANITIZE_NUMBER_INT );

  if ( empty( $fullName ) || empty( $ci ) || empty( $email ) || empty( $type ) ) {
    $error = true;
  } else {

    $resultado = registrar_examen( $fullName, $ci, $email, $type );

    if ( $resultado != true ) {
      $error = false;
      $mensaje = true;
    }
  }
}

?><div class="container">
  <div class="row justify-content-center align-items-center">
    <div class="col">
      <?php if ( $mensaje != false ): ?>
        <div class="alert alert-success" role="alert">
          <p>Registro exitoso del examen</p>
        </div>
      <?php endif ?>
      <div class="card p-4 m-4">
        <h2 class="heading text-center">Registrar examen</h2>
        <form method="POST" action="">
          <div class="mb-3">
            <label for="fullName" class="form-label">Nombre y Apellido</label>
            <input type="text" name="fullName" class="form-control" id="fullName" required>
          </div>
          <div class="mb-3">
            <label for="id" class="form-label">Cédula</label>
            <input type="text" name="ci" class="form-control" id="id" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control" id="email" required aria-describedby="emailhelp">
            <div id="emailhelp" class="form-text">A este correo serán enviados los resultados</div>
          </div>
          
          <div class="mb-3">
            <label for="type" class="form-label">Tipo de examen</label>
            <select class="form-select" name="type" id="type" required>
              <option value="-1" selected="selected" hidden="hidden">SELECCIONAR</option>
              <?php if ( count( $tipo_examenes ) > 0 ): ?>
                <?php foreach ( $tipo_examenes as $examen ): ?>
                  <option value="<?php echo $examen[ 'id' ] ?>"><?php echo $examen[ 'name' ] ?></option>
                <?php endforeach ?>
              <?php endif ?>
            </select>
            <a href="./nuevo-tipo.php">Si el tipo de examen no existe añadelo</a>
          </div>
          <button type="submit" name="control" class="btn btn-primary text-center <?php if ( $error != false ) { echo "is-invalid"; } ?>" aria-describedby="validationServerExamenFeedback">Registrar</button>
          <div id="validationServerExamenFeedback" class="invalid-feedback">
            <p>Error al ingresar el examen</p>
          </div>
        </form>
      </div>
    </div>
    <a href="./">Volver</a>

  </div>
</div>
<?php require_once('./footer.php');
