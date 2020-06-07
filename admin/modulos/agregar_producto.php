<?php
	check_admin();
	if(isset($enviar)){
		$name = clear($name);
		$price = clear($price);
		$oferta = clear($oferta);
		$imagen = "";

		if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
			$imagen = $name.rand(0,1000).".png";
			move_uploaded_file($_FILES['imagen']['tmp_name'], "../productos/".$imagen);
		}

		$mysqli->query("INSERT INTO productos (name,price,imagen,oferta) VALUES ('$name','$price','$imagen','$oferta')");
		redir("?p=agregar_producto");
	}

	if(isset($eliminar)){
		$mysqli->query("DELETE FROM productos WHERE id = '$eliminar'");
		redir("?p=agregar_producto");
	}
?>

<h1>Agregar Producto</h1>
<br>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<select name="oferta" class="form-control" required>
			<option value="0">0% de Descuento</option>
			<option value="5">5% de Descuento</option>
			<option value="10">10% de Descuento</option>
			<option value="15">15% de Descuento</option>
			<option value="20">20% de Descuento</option>
			<option value="25">25% de Descuento</option>
			<option value="30">30% de Descuento</option>
			<option value="35">35% de Descuento</option>
			<option value="40">40% de Descuento</option>
			<option value="45">45% de Descuento</option>
			<option value="50">50% de Descuento</option>
			<option value="55">55% de Descuento</option>
			<option value="60">60% de Descuento</option>
			<option value="65">65% de Descuento</option>
			<option value="70">70% de Descuento</option>
			<option value="75">75% de Descuento</option>
			<option value="80">80% de Descuento</option>
			<option value="85">85% de Descuento</option>
			<option value="90">90% de Descuento</option>
			<option value="95">95% de Descuento</option>
			<option value="99">99% de Descuento</option>
		</select>
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="name" placeholder="Nombre del producto" autocomplete="off" required/>
	</div>
	
	
	<div class="form-group">
		<input type="text" class="form-control" name="price" placeholder="Precio del producto" autocomplete="off" required/>
	</div>

	<label>Imagen del producto</label>

	<div class="form-group">
		<input type="file" class="form-control" name="imagen" title="Imagen del producto" placeholder="Imagen del producto" required/>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-succe2ss" name="enviar"><i class="fa fa-check"></i> Agregar Producto</button>
	</div>
</form>
<br>
<table class="table table-striped">

	<tr>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Descuento</th>
		<th>Precio Total</th>
		<th>Imagen</th>
		<th>Acciones</th>
	</tr>

	<?php
		$prod = $mysqli->query("SELECT * FROM productos ORDER BY id DESC");
		while($rp=mysqli_fetch_array($prod)){
			$preciototal = 0;

			if($rp['oferta']>0){
				if(strlen($rp['oferta'])==1){
					$desc = "0.0".$rp['oferta'];
				}else{
					$desc = "0.".$rp['oferta'];
				}
				$preciototal = $rp['price'] -($rp['price'] * $desc);
			}else{
				$preciototal = $rp['price'];
			}
			?>
				<tr>
					<td><?=$rp['name']?></td>
					<td><?=$rp['price']?></td>
					<td>
						<?php
							if($rp['oferta']>0){
								echo $rp['oferta']."% de Descuento";
							}else{
								echo "Sin descuento";
							}
						?>
					</td>

					<td><?=$preciototal?></td>

					<td><img src="../productos/<?=$rp['imagen']?>" class="imagen_carro"/></td>
					
					<td>
						<a style="color:#08f" href="?p=modificar_producto&id=<?=$rp['id']?>"><i class="fa fa-edit"></i></a>
						&nbsp;
						<a style="color:#08f" href="?p=agregar_producto&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a>
					</td>
				</tr>
			<?php
		}
	?>

</table>