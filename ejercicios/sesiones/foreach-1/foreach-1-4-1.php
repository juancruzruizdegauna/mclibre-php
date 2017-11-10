<?php
/**
 * Hombres y mujeres (Formulario) - foreach-1-4-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-11-09
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
// Se accede a la sesión
session_name("cs-foreach-1-4");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Hombres y mujeres (Formulario). foreach (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Hombres y mujeres (Formulario)</h1>

  <p>Escriba un nombre propio en cada caja de texto y si se trata de un hombre o de una mujer.</p>

  <form action="foreach-1-4-2.php" method="get">
    <table>
      <tbody>
<?php
// Genera el número de cajas de texto y botones radio a mostrar
$numero = rand(1, 10);

// Guarda en la sesión el número de cajas de texto y botones radio
$_SESSION["numero"] = $numero;

// Bucle para generar las cajas de texto y los botones radio
for ($i = 1; $i <= $numero; $i++) {
    print "        <tr>\n";
    print "          <td>$i</td>\n";
    // Los nombres de los controles son dos matrices (c[] y b())
    // En cada fila el name del botón radio es el mismo (para que formen un botón radio)
    // pero el value es distinto (h o m)
    print "          <td><input type=\"text\" name=\"c[$i]\" size=\"30\" /></td>\n";
    print "          <td><label><input type=\"radio\" name=\"b[$i]\" value=\"h\" />Hombre</label></td>\n";
    print "          <td><label><input type=\"radio\" name=\"b[$i]\" value=\"m\" />Mujer</label></td>\n";
    print "        </tr>\n";
}
?>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Contar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-11-09">9 de noviembre de 2017</time></p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>