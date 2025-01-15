<?php

/**
 * Script para cargar datos de lado del servidor con PHP y MySQL
 *
 * @author mroblesdev
 * @link https://github.com/mroblesdev/server-side-php
 * @license: MIT
 */

require '../includes/config/database.php';

// Columnas a mostrar en la tabla
$columns = ['id', 'nombre_producto', 'precio', 'descripcion'];

// Nombre de la tabla
$tables = "productos";

// Clave principal de la tabla
$id = 'id';

// Campo a buscar
$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

// Filtrado
$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}


// Consulta
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM $table
$where";
$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows;

// Consulta para total de registro filtrados
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $conn->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();

// Consulta para total de registro
$sqlTotal = "SELECT count($id) FROM $table ";
$resTotal = $conn->query($sqlTotal);
$row_total = $resTotal->fetch_array();


if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $output['data'] .= '<tr>';
        $output['data'] .= '<td>' . $row['id'] . '</td>';
        $output['data'] .= '<td>' . $row['nombre_producto'] . '</td>';
        $output['data'] .= '<td>' . $row['precio'] . '</td>';
        $output['data'] .= '<td>' . $row['descripcion'] . '</td>';
    }
} else {
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="7">Sin resultados</td>';
    $output['data'] .= '</tr>';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);