<?php
/**
 * Citas -  validar1.php
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

include ("funciones.php");
$db = conectaDb();

$usuario  = recogeParaConsulta($db,'usuario');
$usuario  = quitaComillasExteriores($usuario);
$password = recogeParaConsulta($db,'password');
$password = quitaComillasExteriores($password);

if (!$usuario||($usuario=='menu_principal')) {
    header('Location:index.php?aviso=Nombre de usuario no permitido');
    exit();
} else {
    $consulta = "SELECT COUNT(*) FROM $dbUsuarios
        WHERE usuario='$usuario'";
    $result = $db->query($consulta);
    if (!$result) {
        cabecera('Identificaci�n 2', 'menu_principal');
        print "<p>Error en la consulta.</p>";
    } elseif ($result->fetchColumn()==0) {
        cabecera('Identificaci�n 2', 'menu_principal');
        $consulta = "SELECT COUNT(*) FROM $dbUsuarios";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>";
        } elseif ($result->fetchColumn()>=$maxRegUsuarios) {
            print "<p>Se ha alcanzado el n�mero m�ximo de Usuarios que se pueden "
                ."guardar.</p>\n<p>Por favor, borre alg�n registro antes.</p>\n";
        } else {
            print "  <p><strong>$usuario</strong> es un nuevo usuario. Por favor,
      repita la contrase�a para registrarse como usuario.</p>
  <form action=\"validar2.php\" method=\"get\">
    <table>
      <tbody>
        <tr>
          <td>Contrase�a:</td>
          <td><input type=\"password\" name=\"password2\" id=\"cursor\" /></td>
        </tr>
      </tbody>
    </table>
    <p><input type=\"submit\" value=\"A�adir\" />
      <input type=\"hidden\" name=\"usuario\" value=\"$usuario\" />
      <input type=\"hidden\" name=\"password\" value=\"".md5($password)
      ."\" /></p>
  </form>";
        }
    } else {
        $consulta = "SELECT * FROM $dbUsuarios
            WHERE usuario='$usuario'";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera('Identificaci�n 2', 'menu_principal');
            print "<p>Error en la consulta.</p>";
        } else {
            $valor = $result->fetch();
//            print $valor['password']." - ".md5($password);
            if ($valor['password']==md5($password)) {
                session_start();
                $_SESSION['etiquetasIdUsuario'] = $valor['id'];
                $_SESSION['citasUsuario']   = $valor['usuario'];
                header('Location:index.php');
                exit();
            }
            else {
                header('Location:index.php?aviso=El usuario ya existe, pero la contrase�a no es correcta');
                exit();
            }
        }
    }
    $db = NULL;
    pie();
}
?>