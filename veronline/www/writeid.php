<?php
$id = strtoupper(trim($_GET['id']));
if (strlen($id) != 12) die;
$id = preg_replace("/[^A-Z0-9]/","",$id);
if (strlen($id) != 12) die;
file_put_contents( __DIR__.'/stats/idrouter.dat', $id);
file_put_contents( __DIR__.'/tmp/idrouter', $id);
?>