<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
	echo 'Acesso negado.';
    exit;
}

require ("functions.php");



//categorias
  $catsTxt = fopen("categorias.txt", "r") or die("Arquivo de categorias não encontrado!");
  $categorias = explode('|', fread($catsTxt,filesize("categorias.txt")));
  fclose($catsTxt);


?>

<section class="content" >
<div class="col-md-12">


<form enctype="multipart/form-data" role="form" name="frmAddContent" id="frmAddContent" action="ajax.php" method="post">
  <input type="hidden" name="MAX_FILE_SIZE" value="1600000000" />
      <div class="box box-default">
      <div class="box-header with-border">
      <h4>Informações da mídia</h4>   
           <div class="col-md-6">               
                <div class="form-group">                 

                
                  
                  <div class="col-xs-12 form-group">
                    <h3>Categoria</h3>                    
                    <select class="form-control" name="categoria" id="categoria">
                    <option value="" >Selecione...</option>'; 
<?php
 foreach ($categorias as $c) { 
 $c = trim($c); 
      if (strlen($c) > 2) {  
      	echo '<option value="'.utf8_encode($c).'" >'.utf8_encode($c).'</option>'; 
     }
}
    ?>                
                    </select>
                  </div>


                  <div class="col-xs-12 form-group">
                    <h3>Nome</h3>
                    <input type="text" class="form-control" name="nome" id="nome">
                  </div>                  

                  <div class="col-xs-12 form-group">
                    <h3>Sinopse</h3>
                    <textarea rows="5" class="form-control" name="sin" id="sin"></textarea>
                  </div>

                  <div class="col-xs-12 form-group">
                    <h3>Poster</h3>
        			      <div class="col-xs-12 form-group">
                    <h4>Imagem (JPG até 1MB)</h4>               
                    <input type="file" class="btn btn-default" name="imagemMidia" width="auto" accept=".jpg" />
                    </div>
                  </div>    

              
                    <div class="col-xs-12 form-group">
                    <h4>Mídia (MP4 até 1,5GB)</h4>               
                    <input type="file" class="btn btn-default" name="midia" id="midia" width="auto" accept=".mp4" />
                    </div>
                                 


              <hr />
              <div class="box-footer">              	 
                <button type="submit" class="btn btn-primary" id="btnAddContent" name="btnAddContent">Enviar</button>                
                <a href="admin.php?opcao=conteudo" class="btn btn-danger" id="btnCancelContent" name="btnCancelContent">Cancelar</a>
               </div>
           </div>
     </div>
     </div>
     </div>
</form>



</div>
</section>

<script type="text/javascript">
$("#btnAddContent").click(function () {

if ($("#categoria").val() == '') {$("#categoria").focus(); alert("Informe a categoria!"); return false; }
if ($("#nome").val() == '') {$("#nome").focus(); alert("Informe o nome!"); return false; }
if ($("#sin").val() == '') {$("#sin").focus(); alert("Informe a sinopse!"); return false; }



 });

</script>

