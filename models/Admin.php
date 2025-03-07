<?php 


namespace Model;

class Admin extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];


    // Estos tienen que llevar el mismo nombre que tienen las columnas de BD para que funcione
    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar(){
        if(!$this-> email){
            self::$errores[] = 'El Email es obligatorio';
        }

        if(!$this-> password){
            self::$errores[] = 'El Password es obligatorio';
        }

        return self::$errores;
    }

    // public function existeUsuario() {
    //     //Revisar si un usuario existe o no 
    //     $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

    //     $resultado = self::$db->query($query);

    //     if(!$resultado->num_rows) {
    //         self::$errores[] = 'El usuario no existe';
    //         return;
    //     }
    //     return $resultado;
    // }

    public function existeUsuario()
    {
        // Usamos consultas preparadas para prevenir inyección SQL
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = ? LIMIT 1";

        // Preparamos la consulta
        $stmt = self::$db->prepare($query);
        $stmt->bind_param('s', $this->email);
        $stmt->execute();

        // Obtenemos el resultado
        $resultado = $stmt->get_result();

        // Si no hay usuario, registramos el error y retornamos false
        if (!$resultado->num_rows) {
            self::$errores[] = 'El Usuario no Existe';
            return false;
        }

        // Convertimos el resultado en un objeto y lo retornamos
        // Esto nos dará acceso a propiedades como ->id, ->nombre, etc.
        return $resultado->fetch_object();
    }

    public function comprobarPassword($resultado) {
        // $usuario = $resultado->fetch_object();

        // $autenticado = password_verify($this->password, $usuario->password); // verifica que lo escrito en el input sea lo mismo que esta hasheado
        $autenticado = password_verify($this->password, $resultado->password); // verifica que lo escrito en el input sea lo mismo que esta hasheado

        if(!$autenticado) {
            self::$errores[] =  'El password es Incorrecto';
        }

        return $autenticado;
    }

    public function autenticar() {
        session_start();

        // llenar el arreglo de sesion

        $_SESSION['usuario'] = $this->email;
        $_SESSION['login_copy'] = true;

        header('Location: /admin');
    }

}