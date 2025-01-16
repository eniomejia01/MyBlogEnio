<?php

if (!isset($_SESSION)) { // si ya estaba arrancada la sesion, entonces no hecemos nada
    session_start(); // si no esta iniciada la session, entonces la vamos a iniciar
}


$auth = $_SESSION['login_copy'] ?? null; //este codigo es para que no se caiga la pagina si no hay una session iniciada


?>

<header class="header <?php echo $inicio  ? 'inicio' : ''; ?>">

    <div class="contenido-header contenedor">

        <div class="barra">

            <div class="nombre-usuario">
                <p><?php echo $nombre ?? ''; ?></p>
            </div>

            <nav class="navegacion boton-cerrar-sesion">

                <?php if ($auth): ?>
                    <a href="/">Cerrar Sesión</a>
                <?php endif; ?>

            </nav>
        </div>

    </div>

</header>


<main class="contenedor seccion">

    <h1>Administrador de Enio Blog</h1>

    <?php
    if ($resultado) {
        $mensaje = mostrarNotificacion(intval($resultado));

        if ($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje) ?></p>
    <?php }
    }
    ?>

    <a href="/propiedades/crear" class="boton boton-verde">Crear nuevo post</a>

    <h2>Posts</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>fecha</th>
                <th>Contenido</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!--  Mostrar los Resultados -->
            <?php foreach ($propiedades as $propiedad): ?>
                <tr>
                    <td> <?php echo $propiedad->titulo;  ?> </td>
                    <td> <?php echo $propiedad->fecha ?></td>
                    <td> <?php echo $propiedad->comentario ?></td>
                    <td>

                        <!-- <form method="POST" class="w-100" action="/propiedades/eliminar"> -->


                            <!-- <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-eliminar" value="Eliminar">

                        </form> -->
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-actualizar">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</main>