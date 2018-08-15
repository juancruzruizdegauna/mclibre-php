<?php
/**
 * Cookies 3 - cookies-3a.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-05-19
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

// Funciones auxiliares
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

$admiteCookies  = recoge("admiteCookies");
// Si se envía un color se crea la cookie
if ($admiteCookies == "") {
    setcookie("cookiePrueba", "X");
    header("Location:cookies-3b.php");
    exit();
}

print "<!DOCTYPE html>\n";
print "<html lang=\"es\">\n";
print "<head>\n";
print "  <meta charset=\"utf-8\" />\n";
print "  <title>Comprobación de cookies. Cookies.\n";
print "    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>\n";
print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n";
print "  <link href=\"mclibre-php-soluciones.css\" rel=\"stylesheet\" type=\"text/css\" title=\"Color\" />\n";
print "</head>\n";
print "\n";
print "<body>\n";
print "  <h1>Comprobación de cookies</h1>\n";
print "\n";

if ($admiteCookies == "1") {
    print "  <p>El navegador acepta cookies.</p>\n";
    print "\n";
} elseif ($admiteCookies == "0") {
    print "  <p>El navegador no acepta cookies.</p>\n";
    print "\n";
} else {
    print "  <p>El navegador no acepta cookies.</p>\n";
    print "\n";
}

print "  <p><a href=\"$_SERVER[PHP_SELF]\">Comprobar de nuevo</a></p>\n";
print "\n";

print "  <footer>\n";
print "    <p class=\"ultmod\">\n";
print "      Última modificación de esta página:\n";
print "      <time datetime=\"2011-05-19\">19 de mayo de 2011</time>\n";
print "    </p>\n";
print "\n";
print "    <p class=\"licencia\">\n";
print "      Esta página forma parte del curso <a href=\"http://www.mclibre.org/consultar/php/\">\n";
print "      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />\n";
print "      y se distribuye bajo una <a rel=\"license\" href=\"https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES\">\n";
print "      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>\n";
print "  </footer>\n";
print "</body>\n";
print "</html>\n";
?>
