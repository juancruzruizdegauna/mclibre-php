<?php
/**
 * Citas - eti_listar.php
 *
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolom� Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-06-06
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
include('funciones.php');
$db = conectaDb();

if (!isset($_SESSION['citasUsuario'])) {
    cabecera('Etiquetas - Listar', 'menu_principal');
} else {
    cabecera('Etiquetas - Listar', 'menu_etiquetas');
}

$consulta = "SELECT COUNT(*) FROM $dbEtiquetas";
$result = $db->query($consulta);
if (!$result) {
    print "<p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn()==0) {
    print "<p>No se han creado todav�a etiquetas.</p>\n";
} else {
    $max = 0;
    $min = $maxRegUsuarios;
    $consulta = "SELECT * FROM $dbEtiquetas
        ORDER BY etiqueta ASC";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } else {
        foreach ($result as $valor) {
        $consulta = "SELECT COUNT (*) FROM $dbEtiCitas
            WHERE id_etiqueta=$valor[id]";
        $result2 = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } else {
            $num = $result2->fetchColumn();
            if ($num>$max) {
                $max = $num;
            }
            if ($num<$min) {
                    $min = $num;
            }
        }
    }
    $consulta = "SELECT * FROM $dbEtiquetas
        ORDER BY etiqueta ASC";
    $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } else {
            print "<p>Estas son las etiquetas definidas hasta el momento, con "
                ."un tama�o proporcional a su popularidad:</p>\n";
            print "<p>\n";
            foreach ($result as $valor) {
                $consulta = "SELECT COUNT (*) FROM $dbEtiCitas
                    WHERE id_etiqueta=$valor[id]";
                $result2 = $db->query($consulta);
                if (!$result) {
                    print "<p>Error en la consulta.</p>\n";
                } else {
                    $num = $result2->fetchColumn();
                    if ($max!=$min) {
                        $tamanyo = $minFontSize+round(($num-$min)*($maxFontSize-$minFontSize)/($max-$min));
                    } else {
                        $tamanyo = round(($minFontSize+$maxFontSize)/2);
                    }
                    print "  <span style=\"font-size:{$tamanyo}%\">$valor[etiqueta]</span>\n";
                }
            }
            print "</p>\n";
        }
    }
}

$db = NULL;
pie();
?>