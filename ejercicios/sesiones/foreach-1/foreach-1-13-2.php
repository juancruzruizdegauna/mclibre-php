<?php
/**
 * Encuesta (Resultado) - foreach-1-13-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-11-30
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
session_name("cs-foreach-1-13");
session_start();

// Si el número de preguntas y respuestas no está guardado en la sesión, vuelve al formulario
if (!isset($_SESSION["preguntas"]) || !isset($_SESSION["respuestas"])) {
    header("Location: foreach-1-13-1.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Encuesta (Resultado). foreach (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Encuesta (Resultado)</h1>

<?php
// Funciones auxiliares
function recogeMatriz($var)
{
    $tmpMatriz = [];
    if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
        foreach ($_REQUEST[$var] as $indice => $valor) {
            $indiceLimpio = trim(htmlspecialchars($indice, ENT_QUOTES, "UTF-8"));
            $valorLimpio  = trim(htmlspecialchars($valor,  ENT_QUOTES, "UTF-8"));
            $tmpMatriz[$indiceLimpio] = $valorLimpio;
        }
    }
    return $tmpMatriz;
}

// Recogida de datos
$b                = recogeMatriz("b");
$bOk              = false;

// Se cuenta el número de elementos en la matriz $b
$botonesRecibidos = count($b);

// Comprobación de $b (botones radio)

// Si se han recibido demasiados botones
if ($botonesRecibidos > $_SESSION["preguntas"]) {
    print "  <p class=\"aviso\">Se han recibido demasiadas respuestas.</p>\n";
    print "\n";
} else {
    // Bucle para comprobar si todos los índices y valores son correctos
    $bOk = true;
    foreach ($b as $indice => $valor) {
        // Si el índice no es numérico (como es de tipo int hay que convertirlo a string antes)
        if (!ctype_digit((string)$indice)
            // o si el valor no es numérico
            || !ctype_digit($valor)
            // o si el índice está fuera de rango
            || $indice < 1 || $indice > $_SESSION["preguntas"]
            // o si el valor está fuera de rango
            || $valor < 1 || $valor > $_SESSION["respuestas"]) {
            $bOk = false;
        }
    }
    if (!$bOk) {
        print "  <p class=\"aviso\">Las respuestas recibidas no son correctas.</p>\n";
        print "\n";
    }
}

// Si los botones radio recibidos con correctos ...
if ($bOk) {
    // Si no se ha recibido ningún botón
    if ($botonesRecibidos == 0) {
        print "  <p>No se ha recibido ninguna respuesta.</p>\n";
        print "\n";
    } else {
        print "  <p>Se han contestado <strong>$botonesRecibidos</strong> pregunta(s)";
        print " de un total de <strong>$_SESSION[preguntas]</strong>.</p>\n";
        print "\n";

        print "  <ul>\n";
        // Bucle para escribir qué se ha contestado en cada pregunta
        foreach ($b as $indice => $valor) {
            print "    <li>En la pregunta <strong>$indice</strong> se ha contestado <strong>$valor</strong></li>\n";
        }
        print "  </ul>\n";
        print "\n";
    }
}
?>
  <p><a href="foreach-1-13-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-11-30">30 de noviembre de 2017</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
