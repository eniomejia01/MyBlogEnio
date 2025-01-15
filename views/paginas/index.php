
<div class="headerr">

    <div class="navbar">

        <p>Enio Blog</p>
    
        <p>correo</p>

    </div>

</div>

<main class="contenedorPrincipal">


    <table class="pagePrincipal">

        <!--  Mostrar los Resultados -->
        <?php foreach ($propiedades as $propiedad): ?>

            <h1 class="title"><?php echo $propiedad->titulo;  ?></h1>

            <p class="fecha"><?php echo $propiedad->getFechaFormateada() ?></p>

            <p class="post"><?php echo $propiedad->comentario ?></p>
        <?php endforeach; ?>

    </table>
</main>

<footer class="footer seccion">

    <p class="copyright">Enio Mejía
        <?php echo date('Y') ?> &copy;</p>
</footer>