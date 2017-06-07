<?php
/**
 * for (1) 18 - for_1_18.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-10-10
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
    <title>Arco iris semicircular. for (1)
      Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  </head>

  <body>
    <h1>Arco iris semicircular</h1>

    <p>Actualice la página para mostrar un nuevo dibujo.</p>

<?php
$numero = rand(3,10);
$radio  = 30;
$paso = 360 / $numero;

print "    <h2>$numero franjas</h2>\n";
print "\n";
print "    <p>\n";
print "      <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
print "        width=\"" . ($radio * $numero * 2 + 20) . "px\" height=\"" . ($radio * $numero + 20). "px\" "
    . " viewbox=\"" . (- $radio * $numero -10) . " " . (- $radio * $numero -10) . " " . ($radio * $numero * 2 + 20). " " . ($radio * $numero + 20)
    . "\" style=\"border: black 1px solid; background-color: white;\">\n";

for ($i = 0; $i < $numero; $i++) {
    $valor =  $radio * ($numero - $i);
    print "        <path d=\"M -$valor,0 L $valor,0 A $valor $valor 0 0 0 -$valor,0 z\" fill=\"hsl(" . $i * $paso . ", 75%, 50%)\" />\n";
}

print "      </svg>\n";
print "    </p>\n";
?>

    <footer>
      <p class="ultmod">
        Última modificación de esta página:
        <time datetime="2016-10-10">10 de octubre de 2016</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>