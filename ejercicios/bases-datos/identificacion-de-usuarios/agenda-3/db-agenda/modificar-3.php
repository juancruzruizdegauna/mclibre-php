<?php
/**
 * Identificación de usuarios - Agenda (3) - db-agenda/modificar-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-12-11
 * @link      https://www.mclibre.org
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

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();
if (!isset($_SESSION["conectado"])) {
    header("Location:../index.php");
    exit;
}

$db = conectaDb();
cabecera("Agenda - Modificar 3", MENU_AGENDA, 1);

$nombre    = recoge("nombre");
$apellidos = recoge("apellidos");
$telefono  = recoge("telefono");
$correo    = recoge("correo");
$id        = recoge("id");

$nombreOk    = false;
$apellidosOk = false;
$telefonoOk  = false;
$correoOk    = false;

if (mb_strlen($nombre, "UTF-8") > $tamAgendaNombre) {
    print "    <p class=\"aviso\">El nombre no puede tener más de $tamAgendaNombre caracteres.</p>\n";
    print "\n";
} else {
    $nombreOk = true;
}

if (mb_strlen($apellidos, "UTF-8") > $tamAgendaApellidos) {
    print "    <p class=\"aviso\">Los apellidos no pueden tener más de $tamAgendaApellidos caracteres.</p>\n";
    print "\n";
} else {
    $apellidosOk = true;
}

if (mb_strlen($telefono, "UTF-8") > $tamAgendaTelefono) {
    print "    <p class=\"aviso\">El teléfono no puede tener más de $tamAgendaTelefono caracteres.</p>\n";
    print "\n";
} else {
    $telefonoOk = true;
}

if (mb_strlen($correo, "UTF-8") > $tamAgendaCorreo) {
    print "    <p class=\"aviso\">El correo no puede tener más de $tamAgendaCorreo caracteres.</p>\n";
    print "\n";
} else {
    $correoOk = true;
}

if ($nombreOk && $apellidosOk && $telefonoOk && $correoOk) {
    if ($id == "") {
        print "    <p>No se ha seleccionado ningún registro.</p>\n";
    } elseif ($nombre == "" && $apellidos == "" && $telefono == "" && $correo == "") {
        print "    <p>Hay que rellenar al menos uno de los campos. No se ha guardado la modificación.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $tablaAgenda
            WHERE id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $id]);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn() == 0) {
            print "    <p>Registro no encontrado.</p>\n";
        } else {
            // La consulta cuenta los registros con un id diferente porque MySQL no distingue
            // mayúsculas de minúsculas y si en un registro sólo se cambian mayúsculas por
            // minúsculas MySQL diría que ya hay un registro como el que se quiere guardar.
            $consulta = "SELECT COUNT(*) FROM $tablaAgenda
                WHERE nombre=:nombre
                AND apellidos=:apellidos
                AND telefono=:telefono
                AND correo=:correo
                AND id<>:id";
            $result = $db->prepare($consulta);
            $result->execute([":nombre" => $nombre, ":apellidos" => $apellidos,
                ":telefono" => $telefono, ":correo" => $correo, ":id" => $id]);
            if (!$result) {
                print "    <p>Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn() > 0) {
                print "    <p>Ya existe un registro con esos mismos valores. "
                    . "No se ha guardado la modificación.</p>\n";
            } else {
                $consulta = "UPDATE $tablaAgenda
                    SET nombre=:nombre, apellidos=:apellidos,
                        telefono=:telefono, correo=:correo
                    WHERE id=:id";
                $result = $db->prepare($consulta);
                if ($result->execute([":nombre" => $nombre, ":apellidos" => $apellidos,
                    ":telefono" => $telefono, ":correo" => $correo, ":id" => $id])) {
                    print "    <p>Registro modificado correctamente.</p>\n";
                } else {
                    print "    <p>Error al modificar el registro.</p>\n";
                }
            }
        }
    }
}

$db = null;
pie();
