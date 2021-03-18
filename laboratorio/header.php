<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define( 'ROOTPATH', '/laboratorio/' );
define( 'ROOTFOLDER', getcwd() . "/" );
define( 'CONTROLLERS', ROOTFOLDER . "controladores/" );
define( 'ASSETSFOLDER', ROOTPATH . "assets/" );

require_once( CONTROLLERS . 'init.php' );
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laboratorio clinico</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./javascript/bootstrap.bundle.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="./index.php">
				<h1>Laboratorio clinico Zenday</h1>
			</a>
			<?php if ( isLoggedIn() ): ?>
				<form class="d-flex" action="./logout.php">
					<span class="navbar-text">
						<img src="<?php echo ASSETSFOLDER; ?>icons/person.svg" alt="">
						<?php echo $_SESSION[ 'user' ]; ?>
					</span>
					<button class="btn btn-outline-success ms-3" type="submit">Salir</button>
				</form>
			<?php endif ?>
		</div>
	</nav>