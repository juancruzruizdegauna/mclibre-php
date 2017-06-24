<?php
/**
 * Agenda - borrartodo2.php
 * 
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2009-05-21
 * @link      http://www.mclibre.org
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

include('funciones.php');

function borraTodoMySQL($db)
{
    global $dbDb, $dbAgenda;
    
    $consulta = "DROP DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "<p>Base de datos borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la base de datos.</p>\n";
    }
    $consulta = "CREATE DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "<p>Base de datos creada correctamente.</p>\n";
        $consulta = "CREATE TABLE $dbAgenda (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            nombre VARCHAR(".TAM_NOMBRE."), 
            apellidos VARCHAR(".TAM_APELLIDOS."), 
            telefono VARCHAR(".TAM_TELEFONO."),
            correo VARCHAR(".TAM_CORREO."),   
            PRIMARY KEY(id)
            )";
        if ($db->query($consulta)) {
            print "<p>Tabla de Agenda creada correctamente.</p>\n";
        } else {
            print "<p>Error al crear la tabla de Agenda.</p>\n";
        }
    } else {
        print "<p>Error al crear la base de datos.</p>\n";
    }
}

function borraTodoSqlite($db)
{
    global $dbAgenda;
    
    $consulta = "DROP TABLE $dbAgenda";
    if ($db->query($consulta)) {
       print "<p>Tabla de Agenda borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Agenda.</p>\n";
    }
    $consulta = "CREATE TABLE $dbAgenda (
        id INTEGER PRIMARY KEY,
        nombre VARCHAR(".TAM_NOMBRE."),
        apellidos VARCHAR(".TAM_APELLIDOS."), 
        telefono VARCHAR(".TAM_TELEFONO."),
        correo VARCHAR(".TAM_CORREO.")
        )";
    if ($db->query($consulta)) {
       print "<p>Tabla de Agenda creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Agenda.</p>\n";
    }
}

if (!isset($_REQUEST['si'])) {
    header('Location:index.php');
    exit();
} else {
    $db = conectaDb();
    cabecera('Borrar todo 2', CABECERA_SIN_CURSOR);
    if ($dbMotor==MYSQL) {
        borraTodoMySQL($db);
    } elseif ($dbMotor==SQLITE) {
        borraTodoSqlite($db);
    }
    $db = NULL;
    pie();
}
?>
