<fieldset>
        <legend>Informacion General</legend>

        <label for="titulo">TITULO:</label>
        <input type="text" 
                id="titulo" 
                name="propiedad[titulo]" 
                placeholder="Nombre Producto" 
                value="<?php echo s ( $propiedad -> titulo ); ?>">

        
        <label for="descripcion">CONTENIDO:</label>
        <textarea name="propiedad[comentario]" 
        id="descripcion" 
        cols="30" rows="10"> <?php echo s($propiedad ->  comentario); ?></textarea>
        
        <!-- <label for="precio">Precio:</label>
        <input type="text" 
                id="precio" 
                name="propiedad[precio]" 
                placeholder="Precio Producto" 
                value="<?php echo s($propiedad -> precio); ?>" > -->

</fieldset>
