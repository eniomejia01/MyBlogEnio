<fieldset>
        <legend>Informacion de Post</legend>

        <label for="titulo">TITULO:</label>
        <input type="text" 
                id="titulo" 
                name="propiedad[titulo]" 
                placeholder="Titulo de post" 
                value="<?php echo s ( $propiedad -> titulo ); ?>">

        
        <label for="descripcion">CONTENIDO:</label>
        <textarea name="propiedad[comentario]" 
        id="descripcion" 
        cols="30" rows="10"> <?php echo s($propiedad ->  comentario); ?></textarea>
        

</fieldset>
