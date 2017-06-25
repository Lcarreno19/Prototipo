<?php

function Consultores() {
  $db = new Conexion();
  $sql = $db->query("SELECT cao_usuario.no_usuario,cao_usuario.co_usuario FROM cao_usuario LEFT JOIN permissao_sistema ON cao_usuario.co_usuario = permissao_sistema.co_usuario WHERE permissao_sistema.co_sistema = '1' and permissao_sistema.in_ativo= 'S' and permissao_sistema.co_tipo_usuario='0,1,2'");
  if($db->rows($sql) > 0) {
    while($con = $db->recorrer($sql)) {
      $consultor[$con['co_usuario']] = array(
        'co_usuario' => $con['co_usuario'],
        'no_usuario' => $con['no_usuario']
      );
    }
  } else {
    $consultor = false;
  }
  $db->liberar($sql);
  $db->close();

  return $consultor;
}

?>