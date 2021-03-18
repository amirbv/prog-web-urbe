<?php require_once('header.php'); ?>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card border-secondary p-4 m-4 text-center">
        <img src="<?php echo ASSETSFOLDER; ?>icons/person.svg" class="card-img-top icon-image mb-2" alt="person icon">
        <div class="card-body text-success">
          <h4>Registrar un examen al paciente</h4>
          <a class="stretched-link" href="./registro.php">ir</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-secondary p-4 m-4 text-center">
        <img src="<?php echo ASSETSFOLDER; ?>icons/table.svg" class="card-img-top icon-image mb-2" alt="table icon">
        <div class="card-body text-success">
          <h4>Lista de examenes realizados</h4>
          <a class="stretched-link" href="./examenes.php">ir</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once('footer.php');
