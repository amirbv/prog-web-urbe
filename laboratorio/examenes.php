<?php require_once('./header.php');

$error = false;
$mensaje = false;

if ( isset( $_POST ) && isset( $_POST[ 'control' ] ) ) {

  $examen_id = filter_var( $_POST[ 'id' ], FILTER_SANITIZE_NUMBER_INT );
  $examen_re = filter_var( $_POST[ 'results' ], FILTER_SANITIZE_STRING );

  $resultado = enviar_resultado( (INT)intval( $examen_id ), $examen_re );
}

$examenes = examenes();
$examenes_completados = examenes( true );
?>

<?php if ( $mensaje != false ): ?>
  
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Resultado enviado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>
    </div>
  </div>

  <script>
    var successModal = new bootstrap.Modal( document.getElementById('successModal') );
    successModal.show()
  </script>
<?php endif ?>


<div class="container">
  <div class="row">
    <div class="col">
      <br />
      <h2 class="text-center ">Listado de examenes pendientes</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Cedula</th>
            <th scope="col">Correo</th>
            <th scope="col">Tipo de examen</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php if ( count( $examenes ) > 0 ): ?>

            <?php foreach ( $examenes as $id => $examen ): ?>
              <tr>
                <th><?php echo $id + 1; ?></th>
                <td><?php echo $examen[ 'fullname' ]; ?></td>
                <td><?php echo $examen[ 'ci' ]; ?></td>
                <td><?php echo $examen[ 'email' ]; ?></td>
                <td><?php echo $examen[ 'tipo' ]; ?></td>
                <td>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#resultModal" data-bs-id="<?php echo $examen[ 'id' ]; ?>">
                    Enviar resultados
                  </button>
                </td>
              </tr>
            <?php endforeach ?>
          <?php else: ?>
            <tr>
              <td colspan="6">
                <p style="text-align: center;margin-top: 1rem;">NO HAY EXAMENES PENDIENTES</p>
              </td>
            </tr>
          <?php endif ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="container">
  <div class="row">
    <div class="col">
      <br />
      <h2 class="text-center ">Listado de examenes completados</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Cedula</th>
            <th scope="col">Correo</th>
            <th scope="col">Tipo de examen</th>
          </tr>
        </thead>
        <tbody>
          <?php if ( count( $examenes_completados ) > 0 ): ?>

            <?php foreach ( $examenes_completados as $id => $examen ): ?>
              <tr>
                <th><?php echo $id + 1; ?></th>
                <td><?php echo $examen[ 'fullname' ]; ?></td>
                <td><?php echo $examen[ 'ci' ]; ?></td>
                <td><?php echo $examen[ 'email' ]; ?></td>
                <td><?php echo $examen[ 'tipo' ]; ?></td>
              </tr>
            <?php endforeach ?>
          <?php else: ?>
            <tr>
              <td colspan="6">
                <p style="text-align: center;margin-top: 1rem;">NO HAY EXAMENES PENDIENTES</p>
              </td>
            </tr>
          <?php endif ?>
        </tbody>
      </table>
    </div>
  </div>
  <a href="./">Volver</a>
  
  <!-- Modal -->
  <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="resultModal">Enviar resultados</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="#" method="POST">
          <input type="hidden" name="id">
          <div class="modal-body">
            <div class="mb-2">
              <label for="results" class="form-label">Resultados:</label>
              <textarea name="results" id="results" class="form-control" cols="30" rows="10"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" name="control" class="btn btn-primary">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once('./footer.php');

/*<tr>
    <th scope="row">1</th>
    <td>Elmen Tolate</td>
    <td>66633388</td>
    <td>elmen@tola.te</td>
    <td>Hepatitis</td>
    <td>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#resultModal">
        Enviar resultados
      </button>
    </td>
  </tr>
  <tr>
    <th scope="row">2</th>
    <td>Elmen Tolate</td>
    <td>66633388</td>
    <td>elmen@tola.te</td>
    <td>Hepatitis</td>
    <td>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#resultModal">
        Enviar resultados
      </button>
    </td>
  </tr>*/
