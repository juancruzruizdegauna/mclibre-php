<?php
/**
 * Registro de usuarios 3 - db-usuarios/insertar-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-04-18
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

session_start();
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
    exit();
}

require_once "../comunes/biblioteca.php";

$db = conectaDb();
cabecera("Tabla Usuarios - Añadir 1", MENU_TABLA_USUARIOS_WEB, 1);

$consulta = "SELECT COUNT(*) FROM $dbTablaUsuariosWeb";
$result = $db->query($consulta);
if (!$result) {
    print "    <p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() >= MAX_REG_TABLA_USUARIOS_WEB) {
    print "    <p>Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
    print "    <p>Por favor, borre algún registro antes.</p>\n";
} else {
    print "    <form action=\"insertar-2.php\" method=\"" . FORM_METHOD . "\">\n";
    print "      <p>Escriba los datos del nuevo registro:</p>\n";
    print "\n";
    print "      <table>\n";
    print "        <tbody>\n";
    print "          <tr>\n";
    print "            <td>Nombre de usuario:</td>\n";
    print "            <td><input type=\"text\" name=\"usuario\" size=\"$tamUsuariosWebUsuario\" maxlength=\"$tamUsuariosWebUsuario\" autofocus=\"autofocus\"/></td>\n";
    print "          </tr>\n";
    print "          <tr>\n";
    print "            <td>Contraseña:</td>\n";
    print "            <td><input type=\"text\" name=\"password\" size=\"$tamUsuariosWebPassword\" maxlength=\"$tamUsuariosWebPassword\" /></td>\n";
    print "          </tr>\n";
    print "        </tbody>\n";
    print "      </table>\n";
    print "\n";
    print "      <p>\n";
    print "        <input type=\"submit\" value=\"Añadir\" />\n";
    print "        <input type=\"reset\" value=\"Reiniciar formulario\" />\n";
    print "      </p>\n";
    print "    </form>\n";
}

$db = null;
pie();