<main class="contenedorCrear seccion">

    <h1>Crear Post</h1>

    <?php foreach($errores  as $error): ?>
        <div class="alerta  error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <form action="" class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>
        <input type="submit" value="Agregar Post" class="boton boton-verde">
    </form>

</main>