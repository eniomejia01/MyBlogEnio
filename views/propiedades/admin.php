<?php

if (!isset($_SESSION)) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Enio Blog</title>
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
            <div class="barra">
                <nav class="navegacion" role="navigation" aria-label="Navegación principal">
                    <a href="/anonaadmin"
                        class="boton-cerrar-sesion"
                        title="Cerrar sesión actual">
                        Cerrar Sesión
                    </a>

                </nav>
            </div>
    </header>

    <main class="contenedor seccion">
        <h1>Administrador de Enio Blog</h1>

        <?php if (isset($resultado)): ?>
            <?php $mensaje = mostrarNotificacion(intval($resultado)); ?>
            <?php if ($mensaje): ?>
                <p class="alerta exito"><?php echo s($mensaje) ?></p>
            <?php endif; ?>
        <?php endif; ?>

        <a href="/propiedades/crear" class="boton boton-verde">Crear nuevo post</a>

        <h2>Posts</h2>

        <?php if (empty($propiedades)): ?>
            <p class="no-resultados">No hay posts disponibles</p>
        <?php else: ?>
            <table class="propiedades tabla-admin" role="table">
                <thead>
                    <tr>
                        <th scope="col">Titulo</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Contenido</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($propiedades as $propiedad): ?>
                        <tr>
                            <td><?php echo s($propiedad->titulo); ?></td>
                            <td><?php echo s($propiedad->fecha); ?></td>
                            <td><?php echo s($propiedad->comentario); ?></td>
                            <td class="acciones">
                                <a href="/propiedades/actualizar?id=<?php echo urlencode($propiedad->id); ?>"
                                    class="boton-amarillo-actualizar"
                                    title="Actualizar post">
                                    Actualizar
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>

</html>