<?php
/**
 * Matrices (1) 3 - matrices_1_03.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-10-11
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
    <title>Nombres de animales. Matrices (1)
      Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  </head>

  <body>
    <h1>Nombres de animales</h1>

    <p>Actualice la página para mostrar un nuevo animal.</p>

<?php
$dibujos = array(
    "ballena.svg", "caballito_mar.svg", "camello.svg", "cebra.svg", "elefante.svg",
    "hipopotamo.svg", "jirafa.svg", "leon.svg", "leopardo.svg", "medusa.svg",
    "mono.svg", "oso.svg", "oso_blanco.svg", "pajaro.svg", "pinguino.svg",
    "rinoceronte.svg", "serpiente.svg", "tigre.svg", "tortuga_marina.svg", "tortuga.svg"
);

$nombres = array(
    "Ballena", "Caballito de mar", "Camello", "Cebra", "Elefante",
    "Hipopótamo", "Jirafa", "León", "Leopardo", "Medusa",
    "Mono", "Oso", "Oso blanco", "Pájaro", "Pingüino",
    "Rinoceronte", "Serpiente", "Tigre", "Tortuga marina", "Tortuga"
);

$animal = rand(0, count($dibujos) - 1);

print "    <h2>$nombres[$animal]</h2>\n";
print "\n";
print "    <p><img src=\"img/animales/$dibujos[$animal]\" alt=\"$nombres[$animal]\" title=\"$nombres[$animal]\" height=\"250\" /></p>\n";
?>

    <footer>
      <p class="ultmod">
        Última modificación de esta página:
        <time datetime="2016-10-11">11 de octubre de 2016</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>
