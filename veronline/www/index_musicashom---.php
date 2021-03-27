<?php
  include "../include/active_dbssqlsys.php";
  include "../include/active_funcaosys.php";
  conectaVM();

function filterBad($str)
    {
      $str = str_replace('"', "", $str);
        $str = str_replace("'", "", $str);
        $str = str_replace("<", "", $str);
        $str = str_replace(">", "", $str);
    $badwords = array('select', 'schema', 'table', '--', 'update', 'grant', 'revoke', 'char(', 'hex(', '&#', 'ASCII(', 'BIN(', '%20', '%3C', '%28', '%e', '%b', '%%', 'BASE64(', 'concat(', 'file(', 'format(', 'INSERT(', 'SUBSTRING(', 'REPLACE(', 'REVERSE(', 
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
    <link rel="stylesheet" type="text/css" href="../include/style_hom.css"/>
    <link rel="stylesheet" type="text/css" href="../include/skin.css"  />
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

</head>
<body onorientationchange="Orientation();" style="background-color: #85AEE8; width: 960px;">
  <div id="meio">
    <header>
      <label class="logo" style="padding: 4px 4px 4px 4px;"></label>
      <input type="checkbox" id="control-nav" />
      <label for="control-nav" class="control-nav"></label>
      <label for="control-nav" class="control-nav-close"></label>
      <h1 class="float-r"><a href="index.php"><img src="../images/botretorna.png" border="0" style=" margin-top:15px; right: 190px;"></a></h1>
      <nav class="float-l">
    	<ul class="list-auto">
    	  <li><a href="index_musicashom.php" title="M�sicas"><img src="../images/musicahom.png"></a></li>
    	</ul>
      </nav>
  
    </header>
    <section id="Chaves" style="border: none; padding: 70px 0 0 0;">
      <div style=" width: 100%; height: 100%; left: 0; top: 70px; z-index: 9000; position: !important; margin-left: 2%;">
	<br><br>	
  <?php
  if (isset($_GET['music']) && isset($_GET['genx'])) {
    $musicx = str_replace('.mp3', '', $_GET['music']);
echo '<br/><div class="center"><b>&nbsp;Tocando: '.filterBad(ucfirst(utf8_decode($musicx))).'</b></div><br/><div class="center"><audio controls autoplay>
  <source src="horse.ogg" type="audio/ogg">
  <source src="../musicas/'.filterBad($_GET['genx']).'/'.filterBad($_GET['music']).'" type="audio/mpeg">
Seu navegador n�o suporta elemento de audio.
</audio></div>';
echo '<br/>'; $index = filterBad($_GET['index']);
echo $index;
  } else {
  if (isset($_GET['gen'])) {
 //musicas
    $music = scandir('/var/www/musicas/'.$_GET['gen']);
        foreach ($music as $key => $value) {
          if ($value == '.' || $value == '..') {continue;}
          if (stripos($value, '_store') !== false) {continue;}
          $valuex = str_replace('.mp3', '', $value);
          echo '<a href="index_musicashom.php?index='.$key.'&genx='.filterBad($_GET['gen']).'&music='.filterBad($value).'"><font color="#fff"><b>>> '.filterBad(utf8_decode($valuex)).'</b></font></a><br/>';
        }
        echo '<br/><br/><a href="index_musicashom.php" ><font color="#fff"><b><< Voltar...</b></font></a>';
echo '<br/><br/><br/><br/><br/>';
  } else {
    echo '<b>Selecione um g�nero...</b><br/><br/>';
    $gen = scandir('/var/www/musicas');
    foreach ($gen as $key => $value) {
          if ($value == '.' || $value == '..') {continue;}
          echo '<a href="index_musicashom.php?gen='.filterBad($value).'"><font color="#fff"><b>>> '.filterBad($value).'</b></font></a><br/>';
        }
  }
}
  ?>
	
      </div>
    </section>
  </div>
  </body>
  <div class="clear"></div>
  <div id="footer" style="bottom: 0.1px; position: fixed; width: 960px; color: #000;">	
    <p id="footer-button"><a href="index.php"><img style="padding: 7px 0px 0px 0px;" src="../images/logovalerod.png"></a></p>	
    <p>&copy; 2015-<?php echo $ano?> - Powered by VEROnLINE</p>		
  </div>    
</html>