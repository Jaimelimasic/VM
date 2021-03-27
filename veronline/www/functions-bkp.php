<?php

function getEspacoLivre() {
$esp = '3';  
return '<div align="rigth"><h3>Espaço livre: '.$esp.' de 64GB</h3></div>';
}


function getFilmes($cat) {
$filmesC = array();

  $filmesTxt = fopen("filmes.txt", "r") or die("Arquivo de filmes não encontrado! (filmes)");
  $filmes = explode('|', fread($filmesTxt,filesize("filmes.txt")));
  fclose($filmesTxt);

  if ($cat != null) {
  	foreach ($filmes as $f) {  
  		$fc = explode('$', utf8_encode($f));
  		if (trim($fc[1]) == trim($cat)) array_push($filmesC, $f);
  	}
  	return $filmesC;
  } else return $filmes;
}



function getSinopse($id_vm){
$filmesS = array();
$filmesTxt = fopen("filmes.txt", "r") or die("Arquivo de filmes não encontrado! (sinopse)");
$filmes = explode('|', fread($filmesTxt,filesize("filmes.txt")));
 fclose($filmesTxt);

foreach ($filmes as $f) {  
      $fs = explode('$', utf8_encode($f));
      if (trim($fs[0]) == trim($id_vm)) return $fs[3];
    }

}

function getNome($id_vm){
$filmesS = array();
$filmesTxt = fopen("filmes.txt", "r") or die("Arquivo de filmes não encontrado! (sinopse)");
$filmes = explode('|', fread($filmesTxt,filesize("filmes.txt")));
 fclose($filmesTxt);

foreach ($filmes as $f) {  
      $fs = explode('$', utf8_encode($f));
      if (trim($fs[0]) == trim($id_vm)) return $fs[2];
    }

}


function getEstatistica($id_vm){
$filmesS = array();
$filmesTxt = fopen("filmes.txt", "r") or die("Arquivo de filmes não encontrado! (getEstat)");
$filmes = explode('|', fread($filmesTxt,filesize("filmes.txt")));
 fclose($filmesTxt);

foreach ($filmes as $f) {  
  		$fs = explode('$', utf8_encode($f));
  		if (trim($fs[0]) == trim($id_vm)) return $fs[4];
  	}

}


function increaseStat($id_vm){
$inc = 0;	
$filmesS = array();
$rebuildTxt = '';
$filmesTxt = fopen("filmes.txt", "r") or die("Arquivo de filmes não encontrado! (iStat)");
$filmes = explode('|', fread($filmesTxt,filesize("filmes.txt")));
fclose($filmesTxt);

foreach ($filmes as $f) {  
  		$fs = explode('$', utf8_encode($f));
  		if (trim($fs[0]) == trim($id_vm)) {
  			$inc = $fs[4]+1;
  			$f = utf8_decode($fs[0].'$'.$fs[1].'$'.$fs[2].'$'.$fs[3].'$'.$inc);  			
  		} 

  		if ((substr($f, -1) != '|') && (strlen($f) > 5)) {
  			//echo 'nop: '.substr($f, -1);
  			$rebuildTxt.= $f.'|';//."\n";
  		} else {
  			//echo 'y3p: '.substr($f, -1);
  			$rebuildTxt.= $f;//."\n";
  		}


  }

$open = fopen("filmes.txt","w+");
fwrite($open, $rebuildTxt);
fclose($open);	
}


function getCategorias() {
$cats = array();
$selectElement = '<div class="categoria">Categoria:  <select onchange="location = this.value;"> <option value="" selected>Selecione...</option>';

  $catsTxt = fopen("categorias.txt", "r") or die("Arquivo de categorias não encontrado! (filmes)");
  $categorias = explode('|', fread($catsTxt,filesize("categorias.txt")));
  fclose($catsTxt);

    foreach ($categorias as $c) {  
      if (strlen($c) > 2) {  
      if ($c != 'Show') {$selectElement = $selectElement . '<option value="index.php?opcao=filmes&categoria='.utf8_encode($c).'">'.utf8_encode($c).'</option>';} 
    }
    }

  return $selectElement . '</select></div><br />';   
}


//Em desenvolvimento

function getMusicas($tipo){
  return 'Em breve';
}

function getLivros($tipo){
  return 'Em breve';
}



//Retornar uma contagem?
function getFilmesSubt() {
return '';

}

function getShowsSubt() {
return '';

}

function getMusicasSubt() {
return '';

}

function getLivrosSubt() {
return '';

}



function filterBad($str)
    {
      $str = str_replace('"', "", $str);
        $str = str_replace("'", "", $str);
        $str = str_replace("<", "", $str);
        $str = str_replace(">", "", $str);
    $badwords = array('select', 'schema', 'table', '--', 'update', 'grant', 'revoke', 'char(', 'hex(', '&#', 'ASCII(', 'BIN(', '%20', '%3C', '%28', 'BASE64(', 'concat(', 'file(', 'format(', 'INSERT(', 'SUBSTRING(', 'REPLACE(', 'REVERSE(', 
      'RIGHT(', 'SOUNDEX(', 'oct(', 'ord(', 'REGEXP', 'POSITION(', 'QUOTE(');

      foreach ($badwords as $value) 
    {
      if (strripos($str, $value) !== false) 
      {
          return "fail!";
      exit;
      } 
      }
  return $str;  
  }


//echo getCategorias();

/*
function temShow(){
$cats = file_get_contents("categorias.txt") or die("Arquivo de categorias não encontrado! (temShow)");
if (strpos($cats, '|Show') !== false) {
  return true;
} else {
  return false;
}
}

*/
?>