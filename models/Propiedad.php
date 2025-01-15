<?php

namespace Model;

class Propiedad extends ActiveRecord
{
    protected static $tabla = 'posts';
    protected static $columnasDB = ['id', 'titulo', 'comentario', 'fecha'];

    public $id;
    public $titulo;
    public $comentario;
    public $fecha;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->comentario = $args['comentario'] ?? '';

        // Establecer la fecha en formato MySQL al crear
        if (empty($args['fecha'])) {
            $this->fecha = date('Y-m-d'); // Formato MySQL
        } else {
            $this->fecha = date('Y-m-d', strtotime($args['fecha']));
        }
    }

    // Método modificado para manejar atributos
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;

            if ($columna === 'fecha') {
                // Asegurar que la fecha esté en formato MySQL
                $atributos[$columna] = date('Y-m-d', strtotime($this->$columna));
            } else {
                $atributos[$columna] = $this->$columna;
            }
        }
        return $atributos;
    }

    // Método para mostrar la fecha formateada
    public function getFechaFormateada()
    {
        return date('F j, Y', strtotime($this->fecha));
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir nombre del producto";
        }

        if (!$this->comentario) {
            self::$errores[] = 'La descripción es obligatoria Y debe tener al menos 20 caracteres';
        }

        return self::$errores;
    }
}
