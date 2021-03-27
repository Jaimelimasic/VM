<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
	echo 'Acesso negado.';
    exit;
}


 
?>

<section class="content" >
<div class="col-md-12">


<form role="form" name="frmAddCat" id="frmAddCat" action="ajax.php" method="post">
      <div class="box box-default">
      <div class="box-header with-border">
           <div class="col-md-6">               
              
                  <div class="col-xs-12 form-group">
                    <h3>Nome da nova categoria</h3>
                    <input type="text" class="form-control" name="novaCat" id="novaCat">
                  </div>                  
  
              <hr />
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" id="btnAddCat" name="btnAddCat">Enviar</button>                
                <a href="admin.php?opcao=conteudo" class="btn btn-danger" id="btnCancelContent" name="btnCancelContent">Cancelar</a>
               </div>
     </div>
     </div>
     </div>
</form>



</div>
</section>

<script type="text/javascript">
$("#btnAddCat").click(function () {

if ($("#novaCat").val() == '') {$("#novaCat").focus(); alert("Informe o nome da nova categoria!"); return false; }



 });

</script>

