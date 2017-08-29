<?php
/**
 * Biblioteca - obr_modificar3.php
 * 
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolom� Sintes Marco
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
$db = conectaDb();
cabecera('Obras - Modificar 3', CABECERA_SIN_CURSOR, 'menuObras');

$autor     = recogeParaConsulta($db, 'autor');
$titulo    = recogeParaConsulta($db, 'titulo');
$editorial = recogeParaConsulta($db, 'editorial');
$id        = recogeParaConsulta($db, 'id');

if ($id=="''") {
    print "<p>No se ha seleccionado ning�n registro.</p>\n";    
} elseif (($autor=="''") && ($titulo=="''") && ($editorial=="''")) {
    print "<p>Hay que rellenar al menos uno de los campos. "
            ."No se ha guardado la modificaci�n.</p>\n";
} else {
// La consulta cuenta los registros con un id diferente porque MySQL no distingue 
// may�sculas de min�sculas y si en un registro s�lo se cambian may�sculas por 
// min�sculas MySQL dir�a que ya hay un registro como el que se quiere guardar. 
    $consulta = "SELECT COUNT(*) FROM $dbObras 
        WHERE autor=$autor 
        AND titulo=$titulo 
        AND editorial=$editorial 
        AND id<>$id";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()>0) {
        print "<p>Ya existe un registro con esos mismos valores. "
            ."No se ha guardado la modificaci�n.</p>\n";
    } else { 
        $consulta = "UPDATE $dbObras 
            SET autor=$autor, titulo=$titulo, editorial=$editorial 
            WHERE id=$id";
        if ($db->query($consulta)) {
            print "<p>Registro modificado correctamente.</p>\n";
        } else {
            print "<p>Error al modificar el registro.</p>\n";
        }
    }
}

$db = NULL;        
pie();
?>