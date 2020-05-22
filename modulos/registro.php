<?php
	if(isset($_SESSION['id_cliente'])){
		header ("Location:?p=principal");
	}
?>

<form method="post" action="modulos/validaciones/validar_registro.php">
	<div class="centrar_registro">
		<label><h1>Registrate</h1></label>
		<label><h5>¿Ya estás registrado?<a href="?p=login"> Inicia Sesión</a> </h5> </label>

		<div class="form-group">
			<input type="email" autocomplete="off" class="form-control" placeholder="Email" name="email" maxlength="55"/>
		</div>
		
		<div class="form-group">
			<input type="password" class="form-control" placeholder="Contraseña" name="password" maxlength="55"/>
		</div>

		<div class="form-group">
			<input type="password" class="form-control" placeholder="Confirmar Contraseña" name="cpassword" maxlength="55"/>
		</div>
		
		<div class="form-group">
			<button class="btn btn-submit" name="enviar" type="submit">Registrarse</button>
		</div>
	</div>
</form>

