<?php
/**
 * Bases de datos 2-2 - buscar-2.php
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

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Buscar 2", MENU_VOLVER);

$nombre    = recoge("nombre");
$apellidos = recoge("apellidos");
$ordena    = recogeValores("ordena", $columnasAgendaOrden, "apellidos ASC");

$consulta = "SELECT COUNT(*) FROM $tablaAgenda
    WHERE nombre LIKE :nombre
    AND apellidos LIKE :apellidos";
$result = $db->prepare($consulta);
$result->execute([":nombre" => "%$nombre%", ":apellidos" => "%$apellidos%"]);
if (!$result) {
    print "    <p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p>No se han encontrado registros.</p>\n";
} else {
    $consulta = "SELECT * FROM $tablaAgenda
        WHERE nombre LIKE :nombre
        AND apellidos LIKE :apellidos
        ORDER BY $ordena";
    $result = $db->prepare($consulta);
    $result->execute([":nombre" => "%$nombre%", ":apellidos" => "%$apellidos%"]);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
    } else {
        print "    <form action=\"$_SERVER[PHP_SELF]\" method=\"" . FORM_METHOD . "\">\n";
        print "      <p>\n";
        print "        <input type=\"hidden\" name=\"nombre\" value=\"$nombre\">\n";
        print "        <input type=\"hidden\" name=\"apellidos\" value=\"$apellidos\">\n";
        print "      </p>\n";
        print "\n";
        print "      <p>Registros encontrados:</p>\n";
        print "\n";
        print "      <table class=\"conborde franjas\">\n";
        print "        <thead>\n";
        print "          <tr>\n";
        print "            <th>\n";
        print "              <button name=\"ordena\" value=\"nombre ASC\" class=\"boton-invisible\">\n";
        print "                <img src=\"abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "              Nombre\n";
        print "              <button name=\"ordena\" value=\"nombre DESC\" class=\"boton-invisible\">\n";
        print "                <img src=\"arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "            </th>\n";
        print "            <th>\n";
        print "              <button name=\"ordena\" value=\"apellidos ASC\" class=\"boton-invisible\">\n";
        print "                <img src=\"abajo.svg\" alt=\"A-Z\" title=\"A-Z\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "              Apellidos\n";
        print "              <button name=\"ordena\" value=\"apellidos DESC\" class=\"boton-invisible\">\n";
        print "                <img src=\"arriba.svg\" alt=\"Z-A\" title=\"Z-A\" width=\"15\" height=\"12\">\n";
        print "              </button>\n";
        print "            </th>\n";
        print "          </tr>\n";
        print "        </thead>\n";
        print "        <tbody>\n";
        foreach ($result as $valor) {
            print "          <tr>\n";
            print "            <td>$valor[nombre]</td>\n";
            print "            <td>$valor[apellidos]</td>\n";
            print "          </tr>\n";
        }
        print "        </tbody>\n";
        print "      </table>\n";
        print "    </form>\n";
    }
}

$db = null;
pie();
