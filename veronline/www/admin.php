<!DOCTYPE HTML>

<?php
error_reporting(1);

//se nao logado entao redir index..
session_start();
if (!isset($_SESSION['user'])) {
	header('Location: index.php');
    exit;
}

function getWifi(){
$out = array();
$stuff = array();
exec('sudo iwlist wlan1 scan | grep ESSID', $out);
  foreach ($out as $key => $val) {
    $xx = explode('"', $val);
    array_push($stuff, $xx[1]);
  }
  
return $stuff;

}


$menu = $_GET['opcao']; 
switch ($menu) {
	case 'wifi':  	
		$subTitleR0x = 'Configurações da sua rede';
		$menuAtivoWifi = 'class="current"'; 
		break;
	case 'atualizacao': 
		$titleR0x = 'Atualização de conteúdo';
		$subTitleR0x = 'Temos 3 formas de atualização...';
		$menuAtivoAtualizacao = 'class="current"'; 
		break;
	case 'sec': 
		$titleR0x = 'Segurança';
		$subTitleR0x = 'Troca de senha';
		$menuAtivoSec = 'class="current"'; 
		break;
	case 'conteudo':
		$titleR0x = 'Conteúdo';
		$subTitleR0x = 'Gerenciador de conteúdo';
		$menuAtivoAtualizacao = 'class="current"'; 
		break;
	case 'editar':
		$titleR0x = 'Editar Conteúdo';
		$subTitleR0x = 'Gerenciador de conteúdo';
		$menuAtivoAtualizacao = 'class="current"'; 
		break;
	case 'novaCat':
		$titleR0x = 'Nova Categoria';
		$subTitleR0x = 'Adicionar categoria';
		$menuAtivoAtualizacao = 'class="current"'; 
		break;	
	case 'adicionar':
		$titleR0x = 'Adicionar Conteúdo';
		$subTitleR0x = 'Gerenciador de conteúdo';
		$menuAtivoAtualizacao = 'class="current"'; 
		break;		
	case 'sair': 
	session_unset();
	session_destroy();
	header('Location: index.php');
	exit;

		break;
	default: 
		$titleR0x = '';
		$subTitleR0x = '';
		$menuAtivoHome = 'class="current"'; 	
		$menu = 'home';
}


 ?>
<html>
	<head>
		<title>Cine Ipiranga v.<?php echo round(pi(),2);?> - Entretenimento a bordo</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		 <link rel="stylesheet" href="bootstrap.min.css">
		<script src="bootstrap.min.js"></script>

		<link rel="stylesheet" href="assets/css/main.css" />
	    
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->

			
		<script src="assets/js/jquery.min.js"></script>
		
	</head>
	<body>

		<!-- Content -->
			<div id="content">
				<div class="inner">

						<article class="box post post-excerpt">
							<header>
								<h2><?php echo $titleR0x;?></h2>
								<p><?php echo $subTitleR0x;?></p>
							</header>
							<?php
							if ($menu == 'wifi'){
$ssidFile = '';
$ssidFile = file_get_contents('/var/ssid.txt');								
echo '<div class="box-header with-border">  
<div class="col-md-6">                     
<div class="col-xs-6 form-group">
<h4>Esta rede WiFi será o nome que o usuário irá enxergar a rede do carro, onde ele irá se conectar e assistir ao conteúdo.<br> Esta rede estará disponível após reinciar o equipamento.</h4>  
					<label>Nome da rede (entre 8 e 20 caracteres, sem espaços)</label>
					<input type="text" class="form-control" name="ssid" id="ssid" value="'.$ssidFile.'">

                    <input type="checkbox" name="usarsenha" id="usarsenha">&nbsp;&nbsp;Usar senha<br/>

					<label>Senha (mínimo de 8 caracteres, sem espaços)</label>
                    <input type="password" class="form-control" name="senhawifi" id="senhawifi"><br>
                    <button type="submit" class="btn btn-primary" name="btnWifi" id="btnWifi" >Enviar</button>
                    <hr/>
<div id="divWifi"> </div>              
</div></div></div>';
						    }


						    if ($menu == 'atualizacao'){
echo '<div class="box-header with-border">  
<div class="col-md-6">                     
<div class="col-xs-6 form-group">
<h4>1 - Manual: insira filmes diretamente de seu dispositivo realizando upload.<br/>
ATENÇÃO: caso utilize este método, ao atualizar via pendrive ou contratar o serviço de atualização via WiFi este será substituído e não poderá ser restaurado.</h4> 					
                    <button type="submit" class="btn btn-primary" name="btnContent" id="btnContent" >Abrir gerenciador de conteúdo</button>
                    <hr/>              
</div></div>';

echo '<div class="col-md-6">                     
<div class="col-xs-6 form-group">
<h4>2- Pendrive: faça download do software de atualização via pendrive no link abaixo. Utilize a senha "Veromidia" para descompactar.</h4>  
                    <button type="submit" class="btn btn-primary" name="btnBaixarPen" id="btnBaixarPen" >Baixar sistema de pendrive</button>
                    <hr/>          
</div></div>';

echo '<div class="col-md-6">                     
<div class="col-xs-6 form-group">
<h4>3- Este é o método mais simples de manter seu equipamento atualizado, sempre com o melhor conteúdo selecionado por nossa equipe. Informe aqui o nome da rede WiFi e a senha de sua rede com saída para a Internet mais próxima de seu veículo.</h4>  
					<label>Selecione sua rede...</label>
					<select class="form-control" name="ssidUpdt" id="ssidUpdt">
					<option value="">Selecione...</option>';
					foreach (getWifi() as $blastFurnace){
						echo '<option value="'.$blastFurnace.'">'.$blastFurnace.'</option>';
					}
					echo '</select>
					<label>Sua senha</label>
                    <input type="password" class="form-control" name="senhaUpdt" id="senhaUpdt"><br>
                    <button type="submit" class="btn btn-primary" name="btnUpdtContentWifi" id="btnUpdtContentWifi" >Enviar</button>
                    <div id="divWifiUpdt"> </div> 
                    <hr/>                     
Atenção: esse é um serviço contratado, para ativá-lo entre em contato com o vendedor do equipamento.<BR>Para que este serviço funcione corretamente você deverá possuir uma rede WiFi de velocidade superior a 5MB próxima ao seu veículo enquanto ele estiver em pátio.                   

</div>              
</div></div>';
						    }
								

						if ($menu == 'sec'){
						echo	'<div class="box-header with-border">    
<div class="col-md-6">                     
<div class="col-xs-6 form-group">
<h4>Nova senha</h4>  
                    <input type="password" class="form-control" name="senhaTxt" id="senhaTxt"><br>
                    <button type="submit" class="btn btn-primary" name="senhaBtn" id="senhaBtn" >Alterar</button>
                    <hr/>
<div id="divSenha"> </div>
</div>               
</div></div>';
						    }

						    if ($menu == 'conteudo') {
						    	require('conteudo.php');
						    }

						    if ($menu == 'editar') {
						    	require('editar.php');
						    }

						    if ($menu == 'adicionar') {
						    	require('adicionar.php');
						    }

						    if ($menu == 'novaCat') {
						    	require('categorias.php');
						    }
						    
						    

						    if ($menu == 'home'){
						    	echo '<div align="center"><img src="config.png" style="width:auto;height:auto;"></div>';
						    }

							?>
							
						</article>

				</div>
			</div>

		<!-- Sidebar -->
			<div id="sidebar">
			<!-- Logo -->
					<h1 id="logo"><a href="index.php"></a></h1><br/>
					<div id="divOnline"></div>
					<div id="divUpdate"></div>
					
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li <?php echo $menuAtivoHome; ?>><a href="admin.php">Home</a></li>
							<li <?php echo $menuAtivoWifi; ?>><a href="admin.php?opcao=wifi">WiFi</a></li>
							<li <?php echo $menuAtivoAtualizacao; ?>><a href="admin.php?opcao=atualizacao">Conteúdo</a></li>
							<li <?php echo $menuAtivoSec; ?>><a href="admin.php?opcao=sec">Segurança</a></li>
							<li><a href="admin.php?opcao=sair">Sair</a></li>
						</ul>
					</nav>

					<ul id="copyright">
						<li>&copy; Veronline <br /> Ipiranga v.<?php echo round(pi(),4);?></li>
					</ul>

			</div>

		<!-- Scripts -->
			
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->


<script type="text/javascript">

$( document ).ready(function() {

$('#senhaBtn').click(function () {
   
  if ($('#senhaTxt').val() == '') { return; }
  document.getElementById('divSenha').innerHTML = '';
  if ($('#senhaTxt').val().length < 8) {
   alert('A senha deve ter pelo menos 8 caracteres.');	
   return; 
}

  $.get('ajax.php?trocaSenha='+$('#senhaTxt').val(), function(data, status){
        document.getElementById('divSenha').innerHTML = data;
        $('#divSenha').fadeIn(1000);      
    });
 });


$('#btnWifi').click(function () {
document.getElementById('divWifi').innerHTML = '';
document.getElementById('divWifi').innerHTML = 'Aguarde...';

if ($('#ssid').val() == '') {alert('Informe o nome da rede.'); return; }
if ($('#ssid').val().length < 8 || $('#ssid').val().length > 20) {alert('O nome da rede deve ter entre 8 e 20 caracteres.'); return; }
if ($('#ssid').val().indexOf(" ") !=-1) {alert('O nome da rede não pode conter espaços.'); return; }


		if ($('#usarsenha').prop('checked')) {
			if ($('#senhawifi').val() == '') { return; }
			if ($('#senhawifi').val().length < 8) {
		  	 alert('A senha deve ter pelo menos 8 caracteres.');	
		   return; 
			}
			if ($('#senhawifi').val().indexOf(" ") !=-1) {alert('A senha não pode conter espaços.'); return; }
		var chPw = 'yes';
		} else {
		var chPw = 'no';
		}


  $.get('ajax.php?wifi='+$('#ssid').val()+'&senha='+$('#senhawifi').val()+'&usar='+chPw, function(data, status){
        document.getElementById('divWifi').innerHTML = data;
        $('#divWifi').fadeIn(1000);      
    });

 });


$('#btnBaixarPen').click(function () {
window.location.href = 'vm.zip';
 });

$('#btnContent').click(function () {
window.location.href = 'admin.php?opcao=conteudo';
 });



$('#btnUpdtContentWifi').click(function () {

  if ( $('#ssidUpdt').val() === '' ) {
  	alert('Informe uma rede!'); return;
  }	

  $.get('ajax.php?updtContentWifi='+$('#ssidUpdt').val()+'&senha='+$('#senhaUpdt').val(), function(data, status){
        document.getElementById('divWifiUpdt').innerHTML = data;
        $('#divWifiUpdt').fadeIn(1000);      
    });

 });




function online(){
$.get('ajax.php?online=info', function(data, status){
			        document.getElementById('divOnline').innerHTML = data;  
			    }); 
}

function updateInfo(){
$.get('ajax.php?updtInfo=info', function(data, status){
			        document.getElementById('divUpdate').innerHTML = data;  
			    }); 
}

setInterval(function(){
		online();	
}, 3000);

setInterval(function(){
		updateInfo();	
}, 60000);

updateInfo();

});

</script>		

</body>
</html>
