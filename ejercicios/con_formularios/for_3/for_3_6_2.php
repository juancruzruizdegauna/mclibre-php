<?php
/**
 * Tablas de multiplicar (Resultado) - for_3_6_2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-06
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
 ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Tablas de multiplicar (Resultado). for (3).
      Ejercicios. PHP. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css" title="Color" />
    <style type="text/css">
      table { margin-bottom: 20px; }
      td, th { width: 40px; height: 40px; text-align: center; }
    </style>
  </head>

  <body>
    <h1>Tablas de multiplicar (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$numero = recoge("numero");

$numeroOk = false;

$numeroMinimo = 1;
$numeroMaximo = 20;

if ($numero == "") {
    print "    <p class=\"aviso\">No ha escrito el número de tablas.</p>\n\n";
} elseif (!is_numeric($numero)) {
    print "    <p class=\"aviso\">No ha escrito  el número de tablas número.</p>\n\n";
} elseif (!ctype_digit($numero)) {
    print "    <p class=\"aviso\">No ha escrito el número de tablas "
        . "como número entero positivo.</p>\n\n";
} elseif ($numero < $numeroMinimo || $numero > $numeroMaximo) {
    print "    <p class=\"aviso\">El número de tablas debe estar entre "
        . "$numeroMinimo y $numeroMaximo.</p>\n\n";
} else {
    $numeroOk = true;
}

if ($numeroOk) {
    for ($k = 1; $k <= $numero; $k++) {
        print "    <table class=\"conborde\">\n";
        print "      <caption>Tabla del $k</caption>\n";
        print "      <tbody>\n";
        print "        <tr>\n";
        print "          <th>X</th>\n";
        for ($j = 1; $j <= $k; $j++) {
            print "          <th>$j</th>\n";
        }
        print "        </tr>\n";

        for ($i = 1; $i <= $k; $i++) {
            print "        <tr>\n";
            print "          <th>$i</th>\n";
            for ($j = 1; $j <= $k; $j++) {
                print "          <td>" . ($i * $j) . "</td>\n";
            }
            print "        </tr>\n";
        }
        print "      </tbody>\n";
        print "    </table>\n";
        print "\n";
    }
}

?>
    <p><a href="for_3_6_1.php">Volver al formulario.</a></p>

    <footer>
      <p class="ultmod">
        Última modificación de esta página:
        <time datetime="2016-11-06">6 de noviembre de 2016</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>