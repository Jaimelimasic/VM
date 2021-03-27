<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('functions.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_GET["entrar"])) {
if (!isset($_SESSION['user'])) {
	echo 'Acesso negado.';
    exit;
}
}




function getUpdateInfo(){
$out = array();
exec('ls /var/www/000*', $out);
$xx = explode(PHP_EOL, file_get_contents($out[0]));
$vv = explode('-', $xx[ count($xx) - 1 ]);
return $vv[0];

}


if (isset($_GET["updtInfo"])) {
echo 'Atualização: '.getUpdateInfo();
}


function isOnline(){
$online = 1;
$out = array();
exec('ping -c 2 -W 3 8.8.8.8', $out);
foreach ($out as $key => $value) {
  if (strpos($value, '100% packet loss') !== false) $online = 0;
}

  return $online;
}


if (isset($_GET["online"])) {

if (isOnline()) {
  echo '<img src="g2.png" width="12" height="12" /> Online';
} else {
  echo '<img src="g3.png" width="12" height="12"/> Offline';
}

}



if (isset($_GET["entrar"])) {

$entrar = filterBad($_GET["entrar"]);
$entrar = hash('ripemd160', trim($entrar));
$fileSenha = fopen("/var/pw.txt", "r") or die("Arquivo de senha inexistente!");
$senha = fread($fileSenha,filesize("/var/pw.txt"));
fclose($fileSenha);

		if (trim($senha) == $entrar) {
			$_SESSION['user'] = 'admin';
			echo 'Entrando...';
			exit;
		} else {
			echo 'Senha incorreta!';
			exit;
		}
}


if (isset($_GET["trocaSenha"])) {
$trocaSenha = filterBad($_GET["trocaSenha"]);
$trocaSenha = hash('ripemd160', trim($trocaSenha));
$pwArq = fopen("/var/pw.txt", "w") or die("Arquivo de senha inexistente!");
fwrite($pwArq, $trocaSenha);
fclose($pwArq);
echo 'Sua senha foi alterada!';
}


if (isset($_GET["wifi"])) {
$ssid = filterBad($_GET["wifi"]);
$senha = filterBad($_GET["senha"]);
$usar = filterBad($_GET["usar"]);
if (strlen($ssid) < 8) {echo 'O nome da rede deve ter ao menos 8 e no máximo 20 caracteres.'; exit;}	
if (strlen($ssid) > 20) {echo 'O nome da rede deve ter ao menos 8 e no máximo 20 caracteres.'; exit;}	
if (strpos($ssid, ' ') !== false) {echo 'O nome da rede não pode conter espaços.'; exit;}

if ($usar == 'no') { //sem senha
$pwArq = fopen("/var/senha.txt", "w") or die("Arquivo de senha inexistente!");
fwrite($pwArq, '');
fclose($pwArq);
} else {
if (strlen($senha) < 8) {echo 'Sua senha deve ter ao menos 8 caracteres.'; exit;}
if (strpos($senha, ' ') !== false) {echo 'A senha não pode conter espaços.'; exit;}	
$pwArq = fopen("/var/senha.txt", "w") or die("Arquivo de senha inexistente!");
fwrite($pwArq, $senha);
fclose($pwArq);	
}

$ssidArq = fopen("/var/ssid.txt", "w") or die("Arquivo de SSID inexistente!");
fwrite($ssidArq, $ssid);
fclose($ssidArq);

  if (file_exists('/vm/wifi.sh')) {
      exec('sudo sh /vm/wifi.sh');
      echo 'Sua configuração de WiFi foi alterada!';
  } else {
    echo '/vm/wifi.sh inexistente!';
  }
}




if (isset($_GET["updtContentWifi"])) {
$ssid = filterBad($_GET["updtContentWifi"]);
$senha = filterBad($_GET["senha"]);
	
$cfgArq = fopen("/etc/wpa_supplicant/wpa_supplicant.conf", "w") or die("Arquivo de config WiFi inexistente!");
fwrite($cfgArq, '#country=GB'.PHP_EOL);
fwrite($cfgArq, '#ctrl_interface=DIR=/var/run/wpa_supplicant GROUP=netdev'.PHP_EOL);
fwrite($cfgArq, '#update_config=1'.PHP_EOL);
fwrite($cfgArq, 'network={'.PHP_EOL);
fwrite($cfgArq, 'ssid="'.$ssid.'"'.PHP_EOL);
fwrite($cfgArq, 'psk="'.$senha.'"'.PHP_EOL);
fwrite($cfgArq, 'priority=1'.PHP_EOL);
fwrite($cfgArq, '}'.PHP_EOL);
fclose($cfgArq);	
echo '<br/><h3>WiFi configurado com sucesso!</h3>';
}




if (isset($_GET["idContentDel"])) {
$idContent = filterBad($_GET["idContentDel"]);
if ($idContent == 'fail!') {echo 'Erro ao encontrar conteúdo.'; exit;}
$idContent = trim(str_replace('delContent', '', $idContent));
$statusDel = 'Conteúdo não encontrado.';
$filmesC = array();
$flag = 0;


  $filmesTxt = fopen("filmes.txt", "r") or die("Arquivo de filmes não encontrado! (filmes)");
  $filmes = explode('|', fread($filmesTxt,filesize("filmes.txt")));
  fclose($filmesTxt);


  	foreach ($filmes as $f) {  
	  		$fc = explode('$', $f);
	  		if (trim($fc[0]) == $idContent) { 
	  			$flag = 1;
	  			$statusDel = 'O conteúdo foi excluído da lista.';
		  	} else {
		  		array_push($filmesC, $f.'|'); //nova lista
		  	}
	  	}

$cfgArq = fopen("filmes.txt", "w") or die("Impossível editar arquivo de filmes!");

foreach ($filmesC as $newList) {
	fwrite($cfgArq, $newList);
}

fclose($cfgArq);


echo $statusDel;
	if ($flag == 1){
			if(!unlink(getcwd().'/midia/'.$idContent.'.mp4')) {
				echo ' Porém Ocorreu um erro ao excluir a mídia de seu equipamento.)';
			}
			unlink(getcwd().'/midia/'.$idContent.'.jpg');
	}



//if (file_exists(getcwd().'/midia/'. $idContent .'.mp4')) {echo ' - existe!';} else {echo 'nao existe'; }
}





if (isset($_POST["btnEditContent"])) {

$idContent = isset($_POST["id"]) ? filterBad($_POST["id"]) : '';
if ($idContent == 'fail!' || $idContent == '') {echo 'Erro ao encontrar conteúdo.'; exit;}

$nome = isset($_POST["nome"]) ? htmlentities(filterBad($_POST["nome"])) : '';
if ($nome == 'fail!' || $nome == '') {echo 'Erro no nome.'; exit;}

$sin = isset($_POST["sin"]) ? htmlentities(filterBad($_POST["sin"])) : '';
if ($sin == 'fail!' || $sin == '') {echo 'Erro na sinopse.'; exit;}

$categoria = isset($_POST["categoria"]) ? htmlentities(filterBad($_POST["categoria"])) : '';
if ($categoria == 'fail!' || $categoria == '') {echo 'Erro na categoria.'; exit;}

$statusEdit = 'Conteúdo não encontrado.';
$filmesC = array();

  $filmesTxt = fopen("filmes.txt", "r") or die("Arquivo de filmes não encontrado! (filmes)");
  $filmes = explode('|', fread($filmesTxt,filesize("filmes.txt")));
  fclose($filmesTxt);


  	foreach ($filmes as $f) {  
  		$editado = '';
	  		$fc = explode('$', $f);
	  		if (trim($fc[0]) == $idContent) { 
	  			$statusEdit = 'O conteúdo foi atualizado com sucesso.';
	  			$editado = $idContent.'$'.$categoria.'$'.$nome.'$'.$sin.'$'.$fc[4].'|';
	  			array_push($filmesC, $editado.'|'); //insere modificado
		  	} else {
		  		array_push($filmesC, $f.'|'); //insere sem modificar
		  	}
	  	}

$cfgArq = fopen("filmes.txt", "w") or die("Impossível editar arquivo de filmes!");
foreach ($filmesC as $newList) {
	fwrite($cfgArq, $newList);
}
fclose($cfgArq);


//poster
//se enviou salvar imagem na pasta \img\postagem/md5.ext
if ($_FILES['imagemMidia']['size'] > 1200000) {
    echo 'Erro ao enviar imagem: superior a 1.2MB';  exit;
} else {
    if ($_FILES['imagemMidia']['size'] != 0) {              
                    $ext = pathinfo($_FILES['imagemMidia']['name'], PATHINFO_EXTENSION);
                    if (strtolower($ext) == 'jpg') {   
                        if (!move_uploaded_file($_FILES['imagemMidia']['tmp_name'], '/var/www/html/Ipiranga/midia/'.$idContent.'.jpg')) {    
                             echo 'Erro ao enviar imagem.';  exit;
                          } else {
                            //echo ' Imagem de poster atualizada com sucesso.';
                          }
                    } else {
                        echo 'Erro ao enviar imagem: extensão não permitida.';  exit;
                    }
                }
}

header("location:../Ipiranga/admin.php?opcao=conteudo&opResult=editOk"); 

}


if (isset($_POST["btnAddCat"])) {

$categoria = isset($_POST["novaCat"]) ? htmlentities(filterBad($_POST["novaCat"])) : '';
$categoria = trim($categoria);
if ($categoria == 'fail!' || $categoria == '') {echo 'Erro na categoria.'; exit;}

//repetida?
$cats = array();
  $catsTxt = fopen("categorias.txt", "r") or die("Arquivo de categorias não encontrado!");
  $categorias = explode('|', fread($catsTxt,filesize("categorias.txt")));
  fclose($catsTxt);

array_push($cats, $categoria);//add a nova

    foreach ($categorias as $c) {  
      if (strlen(trim($c)) > 1) {  
      if (trim($c) == $categoria) {
      	header("location:../Ipiranga/admin.php?opcao=conteudo&opResult=catExists"); 
      	exit;
      } else {
      	array_push($cats, $c);//add já existente
      }
    }
    }

sort($cats);
$cArq = fopen("categorias.txt", "w") or die("Impossível editar arquivo de categorias!");
foreach ($cats as $catsN) {
	fwrite($cArq, $catsN.'|'.$PHP_EOL);
}
fclose($cArq);


header("location:../Ipiranga/admin.php?opcao=conteudo&opResult=catOk"); 

}



if (isset($_POST["btnAddContent"])) {

$nome = isset($_POST["nome"]) ? htmlentities(filterBad($_POST["nome"])) : '';
if ($nome == 'fail!' || $nome == '') {echo 'Erro no nome.'; exit;}

$sin = isset($_POST["sin"]) ? htmlentities(filterBad($_POST["sin"])) : '';
if ($sin == 'fail!' || $sin == '') {echo 'Erro na sinopse.'; exit;}

$categoria = isset($_POST["categoria"]) ? htmlentities(filterBad($_POST["categoria"])) : '';
if ($categoria == 'fail!' || $categoria == '') {echo 'Erro na categoria.'; exit;}

$v4r = random_int(10, 1000);
$idContent = md5($nome.$v4r);

$novoFilme = $idContent.'$'.$categoria.'$'.$nome.'$'.$sin.'$0|';
file_put_contents('filmes.txt', $novoFilme, FILE_APPEND | LOCK_EX);

//poster
//se enviou salvar imagem na pasta \img\postagem/md5.ext
if ($_FILES['imagemMidia']['size'] > 1200000) {
    echo 'Erro ao enviar imagem: superior a 1.2MB';  exit;
} else {
    if ($_FILES['imagemMidia']['size'] != 0) {              
                    $ext = pathinfo($_FILES['imagemMidia']['name'], PATHINFO_EXTENSION);
                    if (strtolower($ext) == 'jpg') {   
                        if (!move_uploaded_file($_FILES['imagemMidia']['tmp_name'], '/var/www/html/Ipiranga/midia/'.$idContent.'.jpg')) {    
                             echo 'Erro ao enviar imagem.';  exit;
                          } else {
                            //echo ' Imagem de poster atualizada com sucesso.';
                          }
                    } else {
                        echo 'Erro ao enviar imagem: extensão não permitida.';  exit;
                    }
                }
}


//Ipiranga/midia
if ($_FILES['midia']['size'] > 1600000000) {
    echo 'Erro ao enviar mp4: superior a 1.5MB';  exit;
} else {
    if ($_FILES['midia']['size'] != 0) {              
                    $ext = pathinfo($_FILES['midia']['name'], PATHINFO_EXTENSION);
                    if (strtolower($ext) == 'mp4') {   
                        if (!move_uploaded_file($_FILES['midia']['tmp_name'], '/var/www/html/Ipiranga/midia/'.$idContent.'.mp4')) {    
                             echo 'Erro ao enviar mídia.';  exit;
                          } else {
                            //echo ' Imagem de poster atualizada com sucesso.';
                          }
                    } else {
                        echo 'Erro ao enviar mídia: extensão não permitida.';  exit;
                    }
                }
}


header("location:../Ipiranga/admin.php?opcao=conteudo&opResult=cadOk"); 

}



?>