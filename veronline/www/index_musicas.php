<?php
  include "../include/active_dbssqlsys.php";
  include "../include/active_funcaosys.php";
  conectaVM();
  $apresentacao=$_REQUEST["apresentacao"];
  $musica=$_REQUEST["musica"];  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>VEROnLINE - VM</title>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />    
    <meta name="description" content="See this example of responsive header without using javascript. Using only html and css. by Palloi Hofmann">
    <meta name="keywords" content="css4html, css+for+html, css 4 html, css4, css4 html, css, css3, html, html5" />
    <meta property="og:image" content="../images/image-shared.png" />
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <meta property="og:keywords" content="css4html, css+for+html, css 4 html, css4, css4 html, css, css3, html, html5" />
    <meta property="og:description" content="See this example of responsive header without using javascript. Using only html and css. by Palloi Hofmann" />
    <link rel="stylesheet" type="text/css" href="../include/style.css"/>
    <link rel="stylesheet" type="text/css" href="../include/normalize.css">
    <link rel="stylesheet" type="text/css" href="../include/result-light.css">
    <script type="text/javascript" src="../include/main.js"></script>
    <script type="text/javascript" src="../include/jquery.js"></script>
    <script type="text/javascript" src="../include/jquery.slider.js"></script>
    <script type="text/javascript" src="../include/1.7.2.jquery.min.js"></script>
    <script type="text/javascript" src="../include/jquery.mmenu.min.all.js"></script>
    <script type="text/javascript" src="../include/active_scriptsys_hom.js"></script>
    <script type="text/javascript" src="../include/jquery-1.7.js"></script>
	<style type="text/css">
        #playlist, audio {
}
.active a {
    color:#3D7EDB;
    text-decoration:none;
}
li a {
    color:#eeeedd;
    padding:5px;
    display:block;
}
li a:hover {
    text-decoration:none;
}
</style>
	<script type="text/javascript">
      $(document).ready(function() {
	$("#nav").hide(); 
	  $(".toggle").click(function() {
	    $(this).next().slideToggle("fast");
	    return false;
	  });
	$("#slider").easySlider({
	    auto: false,
	    continuous: true,
	    numeric: true,
	    pause: 5000
	});			
      });
    </script>	
	
    <script type="text/javascript">
      $(document).ready(function() {
	$("#nav").hide(); 
	$(".toggle").click(function() {
	  $(this).next().slideToggle("fast");
	  return false;
	});
      });
    </script>
    <script type="text/javascript">
      $(function() {
	$('nav#menu').mmenu();
      });
    </script>
    <script type= "text/javascript">
      function checkAudioCompat() {
	var myAudio = document.createElement('video');
	var msg = document.getElementById("display");
	msg.innerHTML = "";    
	if (myAudio.canPlayType) {
	  // CanPlayType returns maybe, probably, or an empty string.
	  var playMsg = myAudio.canPlayType('video/mov');
	  if ( "" != playMsg) {
	    msg.innerHTML += "mov is " + playMsg + " supported<br/>";
	  }
	  playMsg = myAudio.canPlayType('video/ogg; codecs="vorbis"'); 
	  if ( "" != playMsg){
	    msg.innerHTML += "ogg is " + playMsg + " supported<br/>";                    
	  }			  
	  playMsg = myAudio.canPlayType('video/mp4; codecs="mp4a.40.5"');
	  if ( "" != playMsg){
	    msg.innerHTML += "mp4 is "+playMsg+" supported<br/>";
	  }
	} else {
	  msg.innerHTML += "no audio support";                
	}
      }
    </script>	
     <script type="text/javascript">
        //<![CDATA[
$(window).load(function(){
var audio;
var playlist;
var tracks;
var current;

init();

function init() {
    current = 0;
    audio = $('audio');
    playlist = $('#playlist');
    tracks = playlist.find('li a');
    len = tracks.length - 1;
    audio[0].volume = .10;
    playlist.find('a').click(function (e) {
        e.preventDefault();
        link = $(this);
        //current = link.parent().index();
        run(link, audio[0]);
    });
    audio[0].addEventListener('ended', function (e) {
        current++;
        if (current == len) {
            current = 0;
            link = playlist.find('a')[0];
        } else {
            link = playlist.find('a')[current];
        }
        run($(link), audio[0]);
    });
}

function run(link, player) {
    player.src = link.attr('href');
    par = link.parent();
    par.addClass('active').siblings().removeClass('active');
    audio[0].load();
    audio[0].play();
}
});//]]> 
     </script>
  </head>
  <body onorientationchange="Orientation();" style="background-color: #85AEE8;">
    <header>
      <label class="logo" style="padding: 4px 4px 4px 4px;"></label>
      <input type="checkbox" id="control-nav" />
      <label for="control-nav" class="control-nav"></label>
      <label for="control-nav" class="control-nav-close"></label>
      <h1 class="float-r"><a href="index.php"><img src="../images/botretorna.png" border="0" style=" position: fixed; top:10px; right: 30px;"></a></h1>  
			<?php if($categorias!=""){?><p style="color: #fff; margin-left: 140px; font-size: 14px; font-family: Myriad Pro Bold !important;"><?php echo $categorias?><?php }?>
			<nav class="float-l">
	<ul class="list-auto">
	  <li><a href="index_filmes.php" title="Filmes"><img src="../images/filmeshom.png"></a></li>
	  <!--<li><a href="index_livros.php" title="Livros"><img src="../images/livros.png"></a></li>-->
	  <li><a href="index_shows.php" title="Shows"><img src="../images/showshom.png"></a></li>
	  <li><a href="index_musicas.php" title="Músicas"><img src="../images/musicahom.png"></a></li>
	  <li><a href="index_vale.php" title="Vale Vídeo"><img src="../images/valevideohom.png"></a></li>
	</ul>
      </nav>
	  <div id="header">
	  <a class="header-button toggle"><center><p style="color: #fff; margin-top: -60px; margin-bottom: 30px; font-family: Myriad Pro Bold !important;">MÚSICAS<br>Gêneros</p></center></a>		
	  <!-- NAVIGATION -->
	  <div id="nav" style="background-color: #85AEE8; font-family: Myriad Pro Bold !important;">
	    <?php conectaVM(); $results=mysql_query("SELECT * FROM administrativo_vm WHERE vm_tipo='Musica' AND vm_flag='.' GROUP BY vm_categoria ORDER BY vm_categoria ASC");?>
	    <?php while( $linha=mysql_fetch_array( $results ) ){?>			
	      <?php if($linha["id_vm"]!=""){?>
		<ul>
		 <center><a style="color: #fff;" href="index_musicas.php?categorias=<?php echo $linha["vm_categoria"]?>"><?php echo $linha["vm_categoria"]?></a></center>
		</ul>
	      <?php }?>
	    <?php }?>		      
	  </div>	
	</div>	  
    </header>
    <section id="Chaves" style="border: nome; padding: 70px 0 0 0;">
      <div style=" width: 100%; height: 100%; left: 0; top: 70px; z-index: 9000; position: !important ;">
	<br><br>
	<audio style="padding: 0 0 25px 35px;" id="audio" preload="auto" tabindex="0" controls="" type="audio/mpeg" src="">
	<source type="audio/mp3" src="">Sorry, your browser does not support HTML5 audio.</audio>
		<ul id="playlist"> 
	    <!--INCLUSAO DE FILMES -->
	    <?php if($categorias==""){
	      conectaVM(); $result=mysql_query("SELECT * FROM administrativo_vm vma WHERE vma.vm_tipo='Musica' AND vma.vm_flag='.'");
	    } else {	      
	      conectaVM(); $result=mysql_query("SELECT * FROM administrativo_vm vma WHERE vma.vm_tipo='Musica' AND vma.vm_flag='.' AND vma.vm_categoria='$categorias'");
	    }?>
		
		<?php while( $linha=mysql_fetch_array( $result ) ){?>			
			  
		  <ul style="padding: 0 0 25px 15px ; cursor: pointer; display: block; border-radius: 3px; padding: 3px 10px 3px 36px; font-family: Myriad Pro Bold !important;">
		  <li class="active"><!--<a href="">--></a></li>
		  
		  <!--<li class=""><a style="cursor: pointer;" class="botmusicapt" href="../musicas/<?php echo $temas?>"><strong><?php echo str_replace(".mp3"," ",$temas)?></strong></a></li>-->  

		  <li class=""><a style="cursor: pointer; " class="botmusicapt" href="../musicas/<?php echo $linha["vm_tema"]?>"><strong><span style=""></span><?php echo $linha["vm_nome"]?></strong><br><?php echo $linha["vm_cantor"]?></a></li>

		</ul>
			
		  <?php }?>
		  </ul>
	  </div>
    </section>
  </body>
  <div class="clear"></div>
  <div id="footer" style="bottom: 0.1px; position: fixed; width: 960px; color: #000;">	
    <p id="footer-button"><a href="index.php"><img style="padding: 7px 0px 0px 0px;" src="../images/logovalerod.png"></a></p>	
    <p>&copy; 2015-<?php echo $ano?> - Powered by VEROnLINE</p>		
  </div>    
</html>