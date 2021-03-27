<?php
  include "../include/active_dbssqlsys.php";
  include "../include/active_funcaosys.php";
  conectaVM();
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
    <meta property="og:keywords" content="css4html, css+for+html, css 4 html, css4, css4 html, css, css3, html, html5" />
    <meta property="og:description" content="See this example of responsive header without using javascript. Using only html and css. by Palloi Hofmann" />
    <link rel="stylesheet" type="text/css" href="../include/style.css" />
    <script type="text/javascript" src="../include/main.js"></script>
    <script type="text/javascript" src="../include/jquery.js"></script>
    <script type="text/javascript" src="../include/jquery.slider.js"></script>
    <script type="text/javascript" src="../include/1.7.2.jquery.min.js"></script>
    <script type="text/javascript" src="../include/jquery.mmenu.min.all.js"></script>
    <script type="text/javascript" src="../include/active_scriptsys_hom.js"></script>
  </head>
  <body onorientationchange="Orientation();">    
   <!--style="background-image: url(../images/telabase.png); background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">-->
    <header>
      <label class="logo" style="padding: 4px 4px 4px 4px;"></label>
      <input type="checkbox" id="control-nav" />
      <label for="control-nav" class="control-nav"></label>
      <label for="control-nav" class="control-nav-close"></label>
      <nav class="float-l">
	<ul class="list-auto">
	  <li><a href="index_filmes.php" title="Filmes"><img src="../images/filmeshom.png"></a></li>
	  <!--<li><a href="index_livros.php" title="Livros"><img src="../images/livros.png"></a></li>-->
	  <li><a href="index_shows.php" title="Shows"><img src="../images/showshom.png"></a></li>
	  <li><a href="index_musicashom.php" title="Músicas"><img src="../images/musicahom.png"></a></li>
	  <li><a href="index_vale.php" title="Vale Vídeo"><img src="../images/valevideohom.png"></a></li>
	</ul>
      </nav>      
    </header>
    <section id="Chaves" style="border: nome; padding: 0px 0px 0px 0px;">
      <br><br><br><center><img src="../images/telabasemob.jpg" border="0" width="100%" height="100%"></center>      
    </section>
  </body>
</html>