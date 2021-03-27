<?php
error_reporting(1);

function getMidiaStats(){

$filmesTxt = fopen("/var/www/html/filmes.txt", "r") or die("Arquivo de filmes não encontrado! (getMidiaStats)");
$filmes = explode('|', fread($filmesTxt,filesize("/var/www/html/filmes.txt")));
fclose($filmesTxt);

if (!file_exists("/var/www/estatistica/stats.txt")) {system('touch /var/www/estatistica/stats.txt');}
$saidaStats = fopen("/var/www/estatistica/stats.txt", "r") or die("Arquivo de vizu não encontrado! (getMidiaStats)");
$stats = fread($saidaStats,filesize("/var/www/estatistica/stats.txt"));
fclose($saidaStats);

//add filmes novos ao stats e marca com *** pq novo filme nao precisa incrementar
	foreach ($filmes as $f) {
	      $fs = explode('$', utf8_encode($f));
	      if (strlen(trim($fs[2])) > 2)  { //nome do filme $fs[2] e stats $fs[4]
			      	if (strpos($stats, trim($fs[2])) == false) {
		    			$stats .= trim($fs[2]).'#'.trim($fs[4]).'***|'.PHP_EOL;
					}
	      }
	}

$stx = explode('|', $stats);
				foreach ($stx as $st) {
			      	if (strpos($st, '***') == false) { //incrementa

				      	   		$stStatNum = explode('#', $st); //nome stat $stStatNum[0]  - stat $stStatNum[1]

				      	   			$inc = $stStatNum[1]+getStat($stStatNum[0]);//pegar estat pelo nome, usar outra funçao
				      				$stats .= trim($stStatNum[0]).'#'.$inc.'|'.PHP_EOL; 

				  		}

				} 

//date_default_timezone_set('America/Sao_Paulo');
//$dt = date("Y-m-d--H-i-s");
$stats = str_replace("***","",$stats);
echo $stats;

$file = '/var/www/estatistica/stats.txt';
file_put_contents($file, $stats);

}


function getStat($nomeFilme) {
$filmesTxt = fopen("/var/www/html/filmes.txt", "r") or die("Arquivo de filmes não encontrado! (getStat)");
$filmes = explode('|', fread($filmesTxt,filesize("/var/www/html/filmes.txt")));
fclose($filmesTxt);

	foreach ($filmes as $f) {
	      $fs = explode('$', utf8_encode($f));
	      if (strlen(trim($fs[2])) > 2)  { //nome do filme $fs[2] e stats $fs[4]
			      	if (strpos($nomeFilme, trim($fs[2])) !== false) {
		    			return $fs[4];
					}
	      }
	}

}



getMidiaStats();


?>