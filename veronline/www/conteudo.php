<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
  echo 'Acesso negado.';
    exit;
}

require ("functions.php");
$filmesContent = array();
$filmesContent = getFilmes(null);
?>

<section class="content" >
<div class="col-md-12">

<button id="novaCat" class="btn btn-primary" >Adicionar nova categoria</button>
<button id="adicionar" class="btn btn-success">Adicionar novo conteúdo</button>

<?php 
echo getEspacoLivre();
?>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Categoria</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $i = 1;
  foreach ($filmesContent as $f) {
  $explodedContent = explode('$', $f); 
  if (strlen($explodedContent[2]) < 1) continue; 
  echo '
    <tr>
      <th scope="row">'.$i.'</th>
      <td>'.$explodedContent[2].'</td>
      <td>'.$explodedContent[1].'</td>
      <td> <a href="admin.php?opcao=editar&id='.trim($explodedContent[0]).'" style="color: #92c7ef;" class="fa fa-pencil">
            Editar
            </a> | 
            <a href="" style="color: #f22;" id="delContent'.trim($explodedContent[0]).'" class="fa fa-trash">
            Excluir
            </a>

      </td>
    </tr>';
    $i++;
   }
?>   

  </tbody>
</table>


</div>
</section>

<script type="text/javascript">

  $( "a[id*='delContent']" ).click(function(){
     $.get('ajax.php?idContentDel='+$(this).attr('id'), function(data, status){
   alert(data); 
   window.location.replace('admin.php?opcao=conteudo');
    });
   return false;
});


  $( "#novaCat" ).click(function(){
   window.location.replace("admin.php?opcao=novaCat"); 
   return false;
});


  $( "#adicionar" ).click(function(){
   window.location.replace("admin.php?opcao=adicionar"); 
   return false;
});


<?php

if (isset($_GET["opResult"])) {
  if ($_GET["opResult"]=='editOk') {echo 'alert("Conteúdo editado com sucesso.")' ;}
  if ($_GET["opResult"]=='catOk') {echo 'alert("Categoria criada com sucesso.")' ;}
  if ($_GET["opResult"]=='cadOk') {echo 'alert("Conteúdo inserido com sucesso.")' ;}
}
?>
</script>