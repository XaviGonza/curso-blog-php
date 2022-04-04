<?php require_once 'includes/redireccion.php'; ?>

<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>

<div id="principal">

	<h1>Crear categorias </h1>

	<p>
		Crea nuevas categorias al blog para que los usuarios puedan
		compartirlas al crear sus entradas
	</p>
	<br>
	<form action="guardar-categoria.php" method="POST">
		<label for="nombre">Nombre de la categoria</label>
		<input type="text" name="nombre">

		<input type="submit" value="Guardar">
		
	</form>
	
</div>

<?php require_once 'includes/footer.php'; ?>