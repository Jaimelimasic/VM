<?php
$now = new DateTime();
$timestamp = $now->format('Y-m-d H:i:s');
$nome = preg_replace("/[^A-Za-z0-9?!\s]/","",$_GET['nome']);
$id = strtoupper($_GET['id']);
if (preg_match('/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/', $id)) {
  $var = $id.'|'.$nome.'|'.$timestamp.'$';
  file_put_contents( __DIR__.'/stats/file.stat', $var, FILE_APPEND);
}

?>