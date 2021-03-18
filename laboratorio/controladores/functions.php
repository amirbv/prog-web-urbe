<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function isLoggedIn () {

	if ( isset( $_SESSION[ 'uid' ] ) ) {
		return true;
	} else {
		return false;
	}
}

function loggin ( $login = null, $pass = null ) {

	global $dbh;

	$return = false;

	if ( $login != null && $pass != null ) {

		$slogin = filter_var( $login, FILTER_SANITIZE_STRING );
		$spass = filter_var( $pass, FILTER_SANITIZE_STRING );

		if ( $slogin != null && $pass != null ) {

			$sslogin = $dbh->real_escape_string( $slogin );

			$query = $dbh->prepare( "SELECT id, username, password, rol FROM `usuarios` WHERE username = ?;" );
			$query->bind_param( "s", $sslogin );

			if ( $query->execute() ) {

				$result = $query->get_result()->fetch_all( MYSQLI_ASSOC );

				if ( is_array( $result ) ) {

					if ( count( $result ) < 1 ) {
						// USUARIO NO ENCONTRADO
						$return = false;
					} elseif ( count( $result ) > 1 ) {
						// USUARIO NO ES UNICO
						$return = false;
					} else {

						$user = $result[0];

						if ( !password_verify( $spass, $user[ 'password' ] ) ) {
							// CONTRASEÑA INCORRECTA
							$return = false;
						} else {

							$_SESSION[ 'uid' ] = $user[ 'id' ];
							$_SESSION[ 'rol' ] = $user[ 'rol' ];
							$_SESSION[ 'user' ] = $user[ 'username' ];

							$return = true;
						}
					}
				}
			}
		}
	}

	return $return;
}

function logout () {
	unset( $_SESSION );
	session_destroy();
}

function tipo_examenes () {

	global $dbh;

	$resultado = array();

	$query = $dbh->query( "SELECT * FROM tipo_examen WHERE 1 ORDER BY id DESC;" );

	for ( $num_fila = $query->num_rows - 1; $num_fila >= 0; $num_fila-- ) {

		$query->data_seek( $num_fila );
		$fila = $query->fetch_assoc();

		array_push( $resultado, $fila );
	}

	return $resultado;
}

function insertar_tipo_examen ( $name = null ) {

	global $dbh;

	$error = true;

	if ( $name != null ) {

		$sname = $dbh->real_escape_string( $name );

		$query = $dbh->prepare( "INSERT INTO tipo_examen ( name ) VALUES ( ? );" );
		$query->bind_param( "s", $sname );

		if ( $query->execute() ) {
			$error = false;
		}
	}

	return $error;
}

function registrar_examen ( $fullName = null, $ci = null, $email = null, $type = null ) {

	global $dbh;

	$error = true;

	if ( $fullName != null && $ci != null && $email != null && $type != null ) {

		$sfullName = $dbh->real_escape_string( $fullName );
		$sci = $dbh->real_escape_string( $ci );
		$semail = $dbh->real_escape_string( $email );
		$stype = $dbh->real_escape_string( $type );

		$query = $dbh->prepare( "INSERT INTO examenes ( fullname, ci, email, type ) VALUES ( ?, ?, ?, ? );" );
		$query->bind_param( "sssi", $sfullName, $sci, $semail, $stype );

		if ( $query->execute() ) {
			$error = false;
		}
	}

	return $error;
}

function examenes ( $completados = false ) {

	global $dbh;

	$estado = ( $completados != false ? 1 : 0 );
	$resultado = array();

	$query = $dbh->prepare( "SELECT id, stado, fullname, ci, email, ( SELECT name FROM tipo_examen WHERE tipo_examen.id = examenes.type ) AS tipo FROM examenes WHERE stado = ? ORDER BY id DESC;" );
	$query->bind_param( 'i', $estado );

	if ( $query->execute() ) {
		$resultado = $query->get_result()->fetch_all( MYSQLI_ASSOC );
	}

	return $resultado;
}

function send_mail ( $msg = '', $to = '', $name = '', $alt = '' ) {

	global $mail;

	//Tell PHPMailer to use SMTP
	$mail->isSMTP();

	//Enable SMTP debugging
	//SMTP::DEBUG_OFF = off (for production use)
	//SMTP::DEBUG_CLIENT = client messages
	//SMTP::DEBUG_SERVER = client and server messages
	// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

	//Set the hostname of the mail server
	$mail->Host = 'smtp.gmail.com';
	// $mail->Host = gethostbyname('smtp.gmail.com');
	//Use `$mail->Host = gethostbyname('smtp.gmail.com');`
	//if your network does not support SMTP over IPv6,
	//though this may cause issues with TLS

	//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = 587;

	//Set the encryption mechanism to use - STARTTLS or SMTPS
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;

	//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = 'panzerdanger@gmail.com';

	//Password to use for SMTP authentication
	$mail->Password = 'wnjpcgfgasubfxlb';

	//Set who the message is to be sent from
	$mail->setFrom( 'panzerdanger@gmail.com', 'Admin' );

	//Set an alternative reply-to address
	$mail->addReplyTo( 'panzerdanger@gmail.com', 'Admin' );

	//Set who the message is to be sent to
	$mail->addAddress( $to, $name );

	//Set the subject line
	$mail->Subject = 'Resultado laboratorio';

	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML( $msg );

	//Replace the plain text body with one created manually
	$mail->AltBody = ( strlen( $alt ) > 0 ? $alt : $msg );

	//Attach an image file

	//send the message, check for errors
	if ( !$mail->send() ) {
		return true;
		// echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		return false;
		// echo 'Message sent!';
		//Section 2: IMAP
		//Uncomment these to save your message in the 'Sent Mail' folder.
		#if (save_mail($mail)) {
		#    echo "Message saved!";
		#}
	}
}

function enviar_resultado( $id = null, $result = '' ) {

	global $dbh;

	$error = true;

	if ( is_int( $id ) ) {

		$query = $dbh->prepare( "SELECT id, stado, fullname, ci, email, ( SELECT name FROM tipo_examen WHERE tipo_examen.id = examenes.type ) AS tipo FROM examenes WHERE stado = 0 AND id = ?;" );
		$query->bind_param( 'i', $id );

		if ( $query->execute() ) {

			$resultado = $query->get_result()->fetch_all( MYSQLI_ASSOC );
			$query->close();

			if ( is_array( $resultado ) ) {

				if ( count( $resultado ) < 1 ) {
					// EXAMEN NO ENCONTRADO
				} elseif ( count( $resultado ) > 1 ) {
					// EXAMEN NO UNICO
				} else {

					$examen = $resultado[0];

					$html = "<div><h1>Laboratorio clinico Zenday</h1><br /><br /><h2>Paciente: :nombre_paciente:</h2><br /><p>Examen: :tipo_examen:</p><p>resultado: :resultado:</p></div>";

					$sresultado = $dbh->real_escape_string( $result );
					$to_state = 1;

					$update = $dbh->prepare( "UPDATE examenes SET stado = ?, resultado = ? WHERE id = ?;" );
					$update->bind_param( "isi", $to_state, $sresultado, $examen[ 'id' ] );

					if ( $update->execute() ) {

						$html = str_replace( ":nombre_paciente:", $examen[ 'fullname' ], $html );
						$html = str_replace( ":tipo_examen:", $examen[ 'tipo' ], $html );
						$html = str_replace( ":resultado:", $sresultado, $html );

						$error = send_mail( $html, $examen[ 'email' ], $examen[ 'fullname' ] );
					}
				}
			}
		}
	}

	return $error;
}
