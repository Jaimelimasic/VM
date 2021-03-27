<!DOCTYPE HTML>

<?php

error_reporting(0);
require('functions.php');
if (isset($_GET['categoria'])) {
	$categoria = $_GET['categoria'];
} else {  $categoria = null; }

$menu = $_GET['opcao']; 
switch ($menu) {
	case 'filmes':  
	    if ($categoria != null) {$titleR0x = 'Filmes <h3>('.$categoria.')</h3>';} else {$titleR0x = 'Filmes';}		
		$subTitleR0x = getFilmesSubt();
		$menuAtivoFilme = 'class="current"'; 
		$filmes = getFilmes($categoria);
		break;
	case 'shows': 
		$titleR0x = 'Shows';
		$subTitleR0x = getShowsSubt();
		$menuAtivoShow = 'class="current"'; 
		$shows = getFilmes('Show');
		break;
	case 'musicas': 
		$titleR0x = 'Músicas';
		$subTitleR0x = getMusicasSubt();
		$menuAtivoMusica = 'class="current"'; 
		$musicas = getMusicas('Tipo');
		break;
	case 'config': 
		$titleR0x = 'Configurações';
		$subTitleR0x = 'Área administrativa';
		$menuAtivoConfig = 'class="current"'; 
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
		<title>NETBUS Garcia v.<?php echo round(pi(),2);?> - Entretenimento a bordo</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<?php
		if ($menu == 'home'){
			echo '<link rel="stylesheet" href="assets/css/main2.css" />';
		} else if (($menu == 'filmes') or ($menu == 'shows')) {
			//http://videojs.com/

			echo '<script>
			var w = window,
    d = document,
    e = d.documentElement,
    g = d.getElementsByTagName("body")[0],
    x = w.innerWidth || e.clientWidth || g.clientWidth,
    y = w.innerHeight|| e.clientHeight|| g.clientHeight;
    
    if (x > 769) {
document.write("<link rel=\"stylesheet\" href=\"assets/css/main3.css\" />");
	} else {
document.write("<link rel=\"stylesheet\" href=\"assets/css/main3Mobile.css\" />");
	}

			</script>';

			echo '
			<link href="assets/css/video-js.css" rel="stylesheet">
			<script src="assets/js/video.js"></script>
			<!-- If youd like to support IE8 -->
  			<!--[if lte IE 8]><script src="assets/js/videojs-ie8.min.js"></script><![endif]-->
  			';
  		} else if ($menu == 'config') {
             
			 echo '<link href="bootstrap.min.css" rel="stylesheet">
			<script src="bootstrap.min.js"></script>';

			echo '<link rel="stylesheet" href="assets/css/main.css" />';
	
	} else {
		echo '<link rel="stylesheet" href="assets/css/main.css" />';

		
	}

		 ?>
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
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
							if ($menu == 'filmes'){		
							if (isset($_GET['id'])) {
								increaseStat($_GET['id']);
								echo '
								<div style="padding=10px;">'.getNome($_GET['id']).'<hr/>Sinopse: <i>'. getSinopse($_GET['id']) .'</i></div><br />
								<div align="center">';								

								echo '<hr/>		
								<video id="my-video" class="video-js" controls preload="auto" width="230px" height="250px"
								  poster="midia/'.$_GET['id'].'.jpg" data-setup="{}">
								    <source src="midia/'.$_GET['id'].'.mp4" type="video/mp4">
								  </video>
								 </div><hr/>';


							} else {	
								    echo getCategorias();
								    foreach ($filmes as $f) {
								    $fExploded = explode('$', $f);	

								    if (strlen($fExploded[2]) > 20) {
   									$nomeFilme = trim(substr($fExploded[2], 0, 17) . '...'); } else {
   									$nomeFilme = trim($fExploded[2]); }

								    if ((strlen($fExploded[2]) > 2) and ($fExploded[1] != 'Show')){
								    	//if (strlen($nomeFilme) < 21) { $bk = '<br/>';} else {$bk = '';}	
								    echo '<a href="index.php?opcao=filmes&id='.$fExploded[0].'"><div width="200px" height="250px" style="display: inline-block; float:left; padding: 10px;">';									    	
									echo '<b><font color="white">'.utf8_encode($nomeFilme).'</font></b><br/>'.$bk.'<font color="#b8dcf2">('.getEstatistica($fExploded[0]).' visualizações)</font><br /><img src="midia/'.$fExploded[0].'.jpg" style="width:180px; height: 265px">	
										</div></a>';	
									}
									}

						    }
						    }


						    if ($menu == 'shows'){
						    	if (isset($_GET['id'])) {

								increaseStat($_GET['id']);
								echo '
								<div style="padding=10px;">'.getNome($_GET['id']).'<hr/>Sinopse: <i>'.getSinopse($_GET['id']).'</i></div><br />
								<div align="center">';

								echo '<hr/>

								<video id="my-video" class="video-js" controls preload="auto" width="230px" height="250px"
								  poster="midia/'.$_GET['id'].'.jpg" data-setup="{}">
								    <source src="midia/'.$_GET['id'].'.mp4" type="video/mp4">
								  </video>
								</div><hr/>';

							} else {
						    foreach ($shows as $f) {
						    $fExploded = explode('$', $f);	
						    if (strlen($fExploded[2]) > 2) {

						    	if (strlen($fExploded[2]) > 20) {
   									$nomeShow = trim(substr($fExploded[2], 0, 17) . '...'); } else {
   									$nomeShow = trim($fExploded[2]); }

						       //if (strlen($fExploded[2]) < 20) { $bk = '<br/>';} else {$bk = '';}
						    echo '<a href="index.php?opcao=shows&id='.$fExploded[0].'"><div width="200px" height="250px" style="display: inline-block; float:left; padding: 10px;">';  	
									echo '<b><font color="white">'.utf8_encode($nomeShow).'</font></b><br/>'.$bk.'<font color="#b8dcf2">('.getEstatistica($fExploded[0]).' visualizações)</font><br /><img src="midia/'.$fExploded[0].'.jpg" style="width:180px; height: 265px">	
										</div></a>';		
							}
							}
						    }
						    }
								

						if ($menu == 'musicas'){
						    	echo '<h2>'.$musicas.'</h2>';
						    }

						    if ($menu == 'config'){
						    	//se logado include admin.php

						    	//form login
						    	echo '
<div class="box-header with-border">    
<div class="col-md-6">                     
<div class="col-xs-6 form-group">
<h4>Senha</h4>  
                    <input type="password" class="form-control" name="senhaTxt" id="senhaTxt"><br>
                    <button type="submit" class="btn btn-primary" name="senhaBtn" id="senhaBtn" >Entrar</button>
                    <hr/>
<div id="divSenha"> </div>
</div>               
</div></div>
                  
                  ';
						    }

						    if ($menu == 'home'){
						    	//echo '<div align="center"><img src="imgaviso.jpg" style="width:auto;height:auto;"></div>';
						    }

							?>
							
						</article>

				</div>
			</div>

		

				<!-- Sidebar -->
			<div id="sidebar">
			<!-- Logo -->
					<h1 id="logo"><a href="index.php"></a></h1>
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li <?php echo $menuAtivoHome; ?>><a href="index.php">Home</a></li>
							<li <?php echo $menuAtivoFilme; ?>><a href="index.php?opcao=filmes">Filmes</a></li>
							<li <?php echo $menuAtivoShow; ?>><a href="index.php?opcao=shows">Shows</a></li>
							<li <?php echo $menuAtivoMusica; ?>><a href="index.php?opcao=musicas">Músicas</a></li>
							<li <?php echo $menuAtivoConfig; ?>><a href="index.php?opcao=config">Configurações</a></li>
						</ul>
					</nav>

					<ul id="copyright">
						<li>&copy; Veronline <br /> PLAY-ON v.<?php echo round(pi(),4);?></li>
					</ul>

			</div>


		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>


<script type="text/javascript">
	
$('#senhaBtn').click(function () {
   
  if ($('#senhaTxt').val() == '') { return; }
  document.getElementById('divSenha').innerHTML = '';
  if ($('#senhaTxt').val().length < 8) {
   alert('A senha deve ter pelo menos 8 caracteres.');	
   return; 
}

  $.get('ajax.php?entrar='+$('#senhaTxt').val(), function(data, status){
        document.getElementById('divSenha').innerHTML = data;
        $('#divSenha').fadeIn(1000);  
        if (data == 'Entrando...') {
        	window.location.href = 'admin.php';
        	return;
        }     
    });
 });

</script>	


<script type="text/javascript">
$(document).ready(function(){
	
   $("#my-video").bind("contextmenu",function() { alert('Proibido baixar vídeos.'); return false; });
});
</script>