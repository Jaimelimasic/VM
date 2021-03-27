<?php 

$previous_encoding = mb_internal_encoding();     
   mb_internal_encoding('UTF-8');
   mb_internal_encoding($previous_encoding);


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
	echo 'Acesso negado.';
    exit;
}

require ("functions.php");

if (!isset($_GET['id'])) exit;
$id = filterBad($_GET['id']) ;
if ($id == 'fail!' || $id == '') exit;


//categorias
  $catsTxt = fopen("categorias.txt", "r") or die("Arquivo de categorias não encontrado! (filmes)");
  $categorias = explode('|', fread($catsTxt,filesize("categorias.txt")));
  fclose($catsTxt);

//self cat  
$catContent = trim(getCategoriasSelf($id));

$nomeMidia = getNome($id);

$sinMidia = getSinopse($id);


 
?>

<section class="content" >
<div class="col-md-12">


<form enctype="multipart/form-data" role="form" name="frmEditContent" id="frmEditContent" action="ajax.php" method="post">
  <input type="hidden" name="MAX_FILE_SIZE" value="1200000" />
      <div class="box box-default">
      <div class="box-header with-border">
      <h4>Informações da mídia</h4>   
           <div class="col-md-6">               
                <div class="form-group">                 

                
                  
                  <div class="col-xs-12 form-group">
                    <h3>Categoria</h3>                    
                    <select class="form-control" name="categoria" id="categoria">
<?php
 foreach ($categorias as $c) { 
 $selected = '';	
 $c = trim($c); 
      if (strlen($c) > 2) {  
      if (ucfirst(utf8_encode($c)) == $catContent) {$selected = 'selected'; }
      	echo '<option value="'.utf8_encode($c).'" '.$selected.' >'.utf8_encode($c).'</option>'; 
     }
}
    ?>                
                    </select>
                  </div>


                  <div class="col-xs-12 form-group">
                    <h3>Nome</h3>
                    <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $nomeMidia;  ?>">
                  </div>                  

                  <div class="col-xs-12 form-group">
                    <h3>Sinopse</h3>
                    <textarea rows="5" class="form-control" name="sin" id="sin"><?php echo trim($sinMidia); ?></textarea>
                  </div>

                  <div class="col-xs-12 form-group">
                    <h3>Poster</h3>
                    <img src="midia/<?php echo $id;?>.jpg" width="auto" height="300"  />
        			<div class="col-xs-12 form-group">
                    <h4>Imagem (JPG até 1MB)</h4>               
                    <input type="file" class="btn btn-default" name="imagemMidia" width="auto" accept=".jpg" />
                    </div>
                  </div>                 


              <hr />
              <div class="box-footer">
              	 <input type="text" class="form-control" name="id" style="display: none;" value="<?php echo $id;?>">
                <button type="submit" class="btn btn-primary" id="btnEditContent" name="btnEditContent">Enviar</button>                
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
$("#btnEditContent").click(function () {

if ($("#nome").val() == '') {$("#nome").focus(); alert("Informe o nome!"); return false; }



 });

</script>

