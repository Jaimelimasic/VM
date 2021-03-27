<?php


   function guidChars( $string ) {
        return preg_replace("/[^a-z_\-0-9]/i", '', $string);
    }


$tipo = $_GET['tipo'];
$id = guidChars($_GET['id']);

$tokenUrl = "https://vm.veronline.rocks/jwt.php?kid=".$id;

$dashUrl = '/midia/'.$id.'/manifest.mpd';
$hlsUrl = '/midia/'.$id.'/manifest.m3u8';
$token = file_get_contents($tokenUrl);
$fpsCert = 'https://vm.veronline.rocks/midia/fairplay.cer';
$licServerFP = 'https://vm.veronline.rocks:445/AcquireLicense';
$licServerWD = 'https://vm.veronline.rocks:444/AcquireLicense';

?>



<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>Entretenimento</title>

    <link href="favicon.ico" rel="icon" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/VTB.css" />

    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" >
       
        <div class="col-md-12" >
            <div class="panel panel-default" style="display: none;">
                <div class="panel-body">
                    <div class="form-group">
                        <label>KID:</label>
                        <input id="kid" class="form-control" value="<?php echo $id; ?>">
                    </div>
                    <div class="form-group">
                        <label>Dash Stream URL:</label>
                        <input id="dash-url" class="form-control" value="<?php echo $dashUrl; ?>">
                    </div>
                    <div class="form-group">
                        <label>HLS Stream URL:</label>
                        <input id="hls-url" class="form-control" value="<?php echo $hlsUrl; ?>">
                    </div>
                    <div class="form-group">
                        <label>FairPlay Streaming Certificate URL:</label>
                        <input id="hls-cert-url" class="form-control" value="<?php echo $fpsCert; ?>">
                    </div>
                    <div class="form-group">
                        <label>Token: <span class="notice"></span></label>
                        <input id="token" class="form-control" value="<?php echo $token; ?>">
                    </div>
                    <div class="form-group">
                        <label>Widevine License server:</label>
                        <div style="display: flex">
                            <input id="wv-license-server" class="form-control licenseInputs" value="<?php echo $licServerWD; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>PlayReady License server:</label>
                        <div style="display: flex">
                            <input id="pr-license-server" class="form-control licenseInputs" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>FairPlay License server:</label>
                        <div style="display: flex">
                            <input id="fp-license-server" class="form-control licenseInputs" value="<?php echo $licServerFP; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        
                        <button id="clear" class="btn btn-default pull-right" style="margin-right: 15px; margin-top: 10px;">Clear</button>
                    </div>
                </div>
            </div>

           

            <div id="player" style="background-color: #212427;">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="dash-video-player col-md-12">
                            <video id="videoPlayer" controls="false" autoplay=""></video> 
                        </div>
                    </div>
                </div>

                <div class="panel panel-default block">
                    <div class="panel-body">                     

                        <div class="col-md-12" style="background-color: #1d1c1c; padding: 3%;">
                            <label class="text-light">Legendas</label>
                            <div class="form-group" style="background-color: #1d1c1c;">
                                <button id="s-y" type="button" class="btn btn-dark">Ativar</button>
                                <button id="s-n" type="button" class="btn btn-dark">Desativar</button>
                            </div>
                            <label class="text-light">Áudio</label>
                            <div class="form-group" style="background-color: #1d1c1c;">
                                <button id="a-pt" type="button" class="btn btn-dark">Português</button>
                                <button id="a-en" type="button" class="btn btn-dark">Inglês</button>
                            </div>

                            <a href="index.php?opcao=<?php echo $tipo; ?>&id=<?php echo $id; ?>" class="btn btn-sm btn-block btn-primary">Voltar</a>

                        </div>
                        


                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-1">
        </div>

    </div>

    <script src="js/shaka-player.compiled.js"></script>
    <script src="js/video-player.js"></script>
    <script src="js/vtb_axplayer.js"></script>
    <script type="text/javascript">
     

 $( "#a-pt" ).click(function() {
  if (typeof player.setAudioLanguage !== 'undefined') {
  	player.setAudioLanguage('pt');
  }
});

$( "#a-en" ).click(function() {
  if (typeof player.setAudioLanguage !== 'undefined') {
  	player.setAudioLanguage('en');
  }
});   

$( "#s-y" ).click(function() {
  if (typeof player.setTextTrack !== 'undefined') {
  	player.setTextTrack(0);
  }
}); 

$( "#s-n" ).click(function() {
  if (typeof player.setTextTrack !== 'undefined') {
  	player.setTextTrack(-1);
  }
}); 
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }


        async function sub(){
            if (typeof player.getPlayerState !== 'undefined' && player.getPlayerState() == "PLAYING") {
                    player.setTextTrack(0);
                    player.setAudioLanguage('pt');
                    return false;              
            } else {
                await sleep(2000); 
                sub();
                return true;
            }
        }

       sub(); 

    </script>
    
<?php
if (isset($_GET['kid'])) {
  $kid = guidChars($_GET['kid']);
  echo '<script type="text/javascript">
    if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
     window.location.href = "/play.php?id='.$kid.'";
    }
    </script>';
}
?>    

</body>

</html>
