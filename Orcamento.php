<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();

if ( isset( $_COOKIE[ 'login' ] ) ) {
	$login_cookie = $_COOKIE[ 'login' ];;
} else {
	$_COOKIE[ 'login' ] = ' ';
}



if ( isset( $login_cookie ) ) {

	include "PermissoesUsuarios.php"






	?>


<?php 
// update aprova 
		
		
													if ($_GET["ia"] != '') {
			
			$APDESA = "UPDATE orcamento_itens SET OrcItemAprovadoReprovado = '".$_GET["ia"]."' where OrcItemId  = '".$_GET["item"]."'";
														mysqli_query( $connect, $APDESA );
			
		}
														
		
// Inserir itens no orçamento.		
if (isset($_POST["additem"]))  {
	
	
	$AdicionarItemSQL = "
	INSERT INTO orcamento_itens
	(
	OrcSoliId,
	OrcItemDescricao,
	OrcItemQTDE,
	OrcItemValor,
	OrcItemAprovadoReprovado,
	OrcItemQuemCriou,
	OrcItemData,
	OrcId
	) VALUES

	(
	'".$_POST['solicitacao_id']."',
	'".$_POST['item']."',
	'".$_POST['itemqtde']."',
	'".$_POST['itemvalor']."',
	'Aguardando aprovação',
	'".$login_cookie."',
	NOW(),
	'".$_POST['orc']."'
	
	)
	";
	
	mysqli_query( $connect, $AdicionarItemSQL );
	
	?><script>window.location = "Orcamento.php?sol=<?php echo  $_POST['solicitacao_id']; ?>&orc=<?php echo  $_POST['orc']; ?>"</script><?php
	
}
// aqui eu listo os itens do orçamento
	

$ListaItensSQL = "SELECT 
    
	OrcItemId,
	OrcSoliId,
	OrcItemDescricao,
	OrcItemQTDE,
	OrcItemValor,
	OrcItemAprovadoReprovado,
	OrcItemQuemCriou,
	OrcItemData,
	OrcId  
	FROM orcamento_itens WHERE OrcId = '".$_GET['orc']."' order by OrcItemId desc";
					 	
$ListaItensRES = mysqli_query( $connect, $ListaItensSQL );
		 
	if ( mysqli_num_rows( $ListaItensRES ) > 0 ) {
		while ( $LROW = mysqli_fetch_array( $ListaItensRES ) ) {


	$OrcItemId[]				= $LROW["OrcItemId"];
	$OrcSoliId[]                = $LROW["OrcSoliId"];
	$OrcItemDescricao[]         = $LROW["OrcItemDescricao"];
	$OrcItemQTDE[]              = $LROW["OrcItemQTDE"];
	$OrcItemValor[]             = $LROW["OrcItemValor"];
	$OrcItemAprovadoReprovado[] = $LROW["OrcItemAprovadoReprovado"];
	$OrcItemQuemCriou[]			= $LROW["OrcItemQuemCriou"];
	$OrcItemData[]				= $LROW["OrcItemData"];
	$OrcId[]  					= $LROW["OrcId"];
	

					 
		}}
	
	
?>





<?php
	if ( isset($_GET["x"]) ) {

				// aprova
				$aprova = "UPDATE gz_solicitacoes SET AprovadoReprovado = '".$_GET['x']."' WHERE SoliId = '" . $_GET[ 'sol' ] . "'";
				mysqli_query( $connect, $aprova );
		
		?>
<script>window.location = "SolicitacaoDetalhe.php?sol=<?php echo  $_GET['sol']; ?>"</script><strong></strong>
<?php

	}

?>




 
			 




			 
			<?php
			//todas as solicitações

			$SolicitacoesSQL = "
	SELECT 
OrcId,
OrcSoli,
OrcData,
OrcQuemCriou,
OrcAprovadoReprovado,
OrcTitulo,
SoliId, OSDescricao
 

from orcamento

LEFT JOIN gz_solicitacoes on gz_solicitacoes.SoliId = orcamento.OrcSoli
WHERE OrcId = '".$_GET[ 'orc' ]."'
	";

	
	
	
			?>
		
			<!doctype html>
			<html lang="en">


			<meta http-equiv="content-type" content="text/html;charset=UTF-8"/ <meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta http-equiv="Content-Language" content="pt-br">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<title>Manager Z - Orçamento</title>
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
				
				
				
			 
				
				
				
			<!-- Disable tap highlight on IE -->
			<meta name="msapplication-tap-highlight" content="no">
				   
   
			<link href="main.d810cf0ae7f39f28f336.css" rel="stylesheet" >
				
				
				 
				
			</head>

			<body>
				 
				<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar ">

					<?php include "z_topo.php"; ?>



					<div class="app-main ">
						<div class="app-sidebar sidebar-shadow " >
							
							
							
							
							<div class="app-header__mobile-menu">
								<div>
									<button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
								

								</div>
							</div>
							<div class="app-header__menu">
								<span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
							

								</button>
								</span>
							</div>


							

<?php include "z_menu.php";?>
						</div>
						<div class="app-main__outer">
							


							<div class="app-main__inner">





								
							

								 <?php 
					 
					 	
$SolicitacoesRES = mysqli_query( $connect, $SolicitacoesSQL );
		 
	if ( mysqli_num_rows( $SolicitacoesRES ) > 0 ) {
		while ( $SolicitacoesROW = mysqli_fetch_array( $SolicitacoesRES ) ) {


$OrcId    				= $SolicitacoesROW["OrcId"];
$OrcSoli				= $SolicitacoesROW["OrcSoli"];
$OrcData		        = $SolicitacoesROW["OrcData"];
$OrcQuemCriou			= $SolicitacoesROW["OrcQuemCriou"];
$OrcAprovadoReprovado   = $SolicitacoesROW["OrcAprovadoReprovado"];
$OrcTitulo		        = $SolicitacoesROW["OrcTitulo"];
$OSDescricao            = $SolicitacoesROW["OSDescricao"];
	

					 
					 ?>
<div class="app-page-title">
									<div class="page-title-wrapper">
										<div class="page-title-heading">
											<div class="page-title-icon">
												<i class="pe-7s-help2 icon-gradient bg-mean-fruit"></i>
											</div>
											<div>Solicitação <a href="SolicitacaoDetalhe.php?sol=<?php echo $_GET["sol"]; ?>">#<?php echo sprintf('%04d', $_GET["sol"]);?></a><br>
												Orçamento #<?php echo sprintf('%04d', $OrcId);?> 
												 
											</div>

										</div>
										 
									</div>







								</div>
								

								<div class="row">


									<div class="col-lg-24 col-xl-12">

										<div class="card mb-3 widget-content">
											<div class="widget-content-outer">
												 
         

												<div class="widget-progress"  >

													<div class="">
														<div class=" "><b>#<?php echo sprintf('%04d', $OrcId);?><?php echo $OrcTitulo; ; ?></b>  <br>
														Criado por 	<b class="text-primary">
																<?php echo $OrcQuemCriou; ; ?> 
															</b>
															<Br>em <b class="text-primary"><?php echo date('d/m/Y', strtotime($OrcData));?></b> às <b class="text-primary"><?php echo date('H:m:s', strtotime($OrcData));?></b><br>

															  
															 
															 <div class="badge badge-pill badge-info ml-2"><?php echo $OrcAprovadoReprovado ; ?></div>
															 
															 




														</div>
														 
															
											</div>

 
														
														
														
														
													<div>

														</div>


												 

										</div>
													
													
													 



									</div>


								</div>
											
										</div>
									
									<div class="col-lg-24 col-xl-12">
										
										<form action="Orcamento.php" method="post" enctype="multipart/form-data" name="form2" id="form2" title="form2">
											
											 
												
												
										<input type="hidden" name="solicitacao_id" value="<?php echo $_GET["sol"]; ?>">
											<input type="hidden" name="orc" value="<?php echo $_GET["orc"]; ?>">
                                    <div class="main-card mb-3 card">
                                        <div class="card-header">Adicionar itens</div>
                                        
                                                <div class="todo-indicator bg-warning"></div>
                                                <div class="widget-content  ">
                                              
<div class="form-row">
	                <div class="col-md-8">
                    <div class="position-relative form-group">
							<input name="item" id="item" type="text" class="form-control" placeholder="Item do orçamento" >
					</div>
					</div>
					
					 <div class="col-md-2">
                    <div class="position-relative form-group">
							<input name="itemqtde" id="itemqtde" type="text" class="form-control" placeholder="Quantidade" >
					</div>
					</div>
	
					 <div class="col-md-2 ">
                    <div class="position-relative form-group">
							<input name="itemvalor" id="itemvalor" type="text" class="form-control" placeholder="Valor unitário" >
					</div>
					</div>
													
</div>
															  
												    
						  						
							</div>	
						
						 
										 			 

                                                   
                                                    
                                                
                                             
                                        <div class="d-block text-right card-footer">
                                             <button class="btn btn-success btn-lg" type="submit" name="additem">Adicionar</button>
                                        </div>
                                    </div>
										
										</form>
										
										
                                </div>
										
										 
										
										 <div class="col-lg-24 col-xl-12">
                                    <div class="main-card mb-3 card">
                                        <div class="card-header">Itens deste orçamento</div>
                                        <ul class="todo-list-wrapper list-group list-group-flush">
											
											
												<?php  foreach ($OrcItemId as $index => $value) { ?>
                                            <li class="list-group-item">
                                                <div class="todo-indicator bg-warning"></div>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                         
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading"><?php echo $OrcItemDescricao[$index];?> Qtde: <?php echo $OrcItemQTDE[$index];?> Valor Unitátio: <?php echo $OrcItemValor[$index];?>  Total: <?php echo $OrcItemQTDE[$index]*$OrcItemValor[$index];?>
                                                                
                                                            </div>
                                                            <div class="widget-subheading"><i>cotação feita por <?php echo $OrcItemQuemCriou[$index];?></i></div>
                                                        </div>
														
														
                                                        <div class="widget-content-right  ">
															
															
															<?php if ($OrcItemAprovadoReprovado[$index] == "APROVADO") { ?> 
															<div class="badge badge-success ml-2"><?php echo $OrcItemAprovadoReprovado[$index];?></div>
															<?php } else if ($OrcItemAprovadoReprovado[$index] == "NÃO APROVADO") { ?>
															<div class="badge badge-danger ml-2"><?php echo $OrcItemAprovadoReprovado[$index];?></div> 
															<?php } else { ?>
															
															<div class="badge badge-info ml-2"><?php echo $OrcItemAprovadoReprovado[$index];?></div>
															<?php } ?>
															
															
                                                            <button class="border-0 btn-transition btn btn-outline-success" onClick="window.location='Orcamento.php?sol=<?php echo $_GET['sol']?>&orc=<?php echo $_GET['orc']?>&ia=APROVADO&item=<?php echo $OrcItemId[$index]; ?>';">
                                                                <i class="fa fa-thumbs-up"></i>
                                                            </button>
                                                            <button class="border-0 btn-transition btn btn-outline-danger" onClick="window.location='Orcamento.php?sol=<?php echo $_GET['sol']?>&orc=<?php echo $_GET['orc']?>&ia=NÃO APROVADO&item=<?php echo $OrcItemId[$index]; ?>';">
                                                                <i class="fa fa-thumbs-down"></i>
                                                            </button>
                                                        </div>
                                                    </div>
													
													
												
													
													
                                                </div>
                                            </li>
											<?php } ?>
                                           
                                        </ul>
                                        <div class="d-block text-right card-footer">
                                            <button class="mr-2 btn btn-link btn-sm">Cancel</button>
                                            <button class="btn btn-success btn-lg">Save</button>
                                        </div>
                                    </div>
                                </div>
									
									
									
									</div>
									
									 
								 <?php } } ?>

								 
							</div>


							


							<?php include "z_rodape.php";?>





						</div>
					</div>
				</div>


				<?php include "z_direita.php";?>



			</body>


			</html>



<div class="modal fade" id="Budget" tabindex="-1" role="dialog" aria-labelledby="Budget" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					<i class="nav-link-icon pe-7s-cash"></i> Criar um orçamento
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
			<form action="SolicitacaoDetalhe.php" method="post" enctype="multipart/form-data" name="form2" id="form2" title="form2">
				<input type="hidden" name="solicitacao_id" value="<?php echo $_GET["sol"]; ?>">
				<div class="modal-body">
					<div class="form-row">
						<div class="col-md-8">
							<div class="position-relative form-group">
								<label for="ORCAMENTO_DESC">Deseja criar um orçamento para a solicitação <b><?php echo $_GET["sol"]; ?></b></label>
								 
							</div>
						</div>
						 



					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
					<button type="submit" name="orcamento_form" class="btn btn-primary">Sim, criar</button>
				</div>
			</form>
		</div>
	</div>
</div>


    
      <script id="rendered-js" >
$(window).load(function () {
  $('#Budget').modal('show').zIndex('99999');
});
 
    </script>


 
       


 


			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"> <i class="nav-link-icon lnr-mustache"></i> Chamar um especialista</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
						

						</div>
						<form action="SolicitacaoDetalhe.php" method="post" enctype="multipart/form-data" name="form2" id="form2" title="form2">
							<input type="hidden" name="solicitacao_id" value="<?php echo $_GET["sol"]; ?>">
							<div class="modal-body">
								<div class="form-row">
									<div class="col-md-12">
										<div class="position-relative form-group">
											<label for="ESPECIALISTA">Especialista</label>
											<input name="ESPECIALISTA" id="ESPECIALISTA" PlaceHolder="Ex:Eletricista, mecânico, etc." type="text" class="form-control">
										</div>
									</div>



								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								<button type="submit" name="especialista_form" class="btn btn-primary">Chamar especialista</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<?php // -- MODAL finalizar uma soli --- ?>
			<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Finalizar solicitação.</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
						

						</div>
						<div class="modal-body">
							<p>Você deseja realmente finalizar esta solicitação? Esta ação não pode ser desfeita.</p>
						</div>
						<div class="modal-footer">
							<form action="SolicitacaoDetalhe.php" method="post" enctype="multipart/form-data" name="form2" id="form2" title="form2">
								<input type="hidden" name="solicitacao_id" value="<?php echo $_GET["sol"]; ?>">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Não quero</button>
								<button type="submit" name="soli_finalizar" class="btn btn-primary">Finalizar solicitação</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<?php // -- MODAL ADICIONAR UMA TAREFA --- ?>
			<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="AddModal" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="AddModal">
						    <i class="nav-link-icon lnr-pushpin"></i> Adicionar uma tarefa
					</h5>
						

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
						
                </button>
						



						</div>

						<form action="SolicitacaoDetalhe.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
							<input type="hidden" name="solicitacao_id" value="<?php echo $_GET["sol"]; ?>">
							<div class="modal-body">






								<div>
									<div>

										<div class="form-row">
											<div class="col-md-12">
												<div class="position-relative form-group">
													<label for="TAREFA">Descrição da tarefa</label>
													<input name="TAREFA" id="TAREFA" PlaceHolder="Ex: Arrumar fiação do teto." type="text" class="form-control">
												</div>
											</div>



										</div>



									</div>





								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
									<button name="adicionartarefa" type="submit" class="btn btn-primary">Adicionar</button>
								</div>


						</form>



						</div>
					</div>
				</div>

			</div>




			<?php // -- MODAL FOTO --- ?>
			<div class="modal fade" id="FotoAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="FotoAddModal">
						    <i class="nav-link-icon lnr-pushpin"></i> Utilizar material do estoque
					</h5>
						

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
						
                </button>
						



						</div>

						<form action="SolicitacaoDetalhe.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
							<input type="hidden" name="solicitacao_id" value="<?php echo $_GET["sol"]; ?>">
							<div class="modal-body">






								<div>
									<div>

										<div class="form-row">
											<div class="col-md-12">
												<div class="position-relative form-group">

				   <label for="produto_selecionado">Selecione o material</label>									  
  <select class="form-control" name="produto_selecionado" >
 <option value="#" selected>Apelido | Descrição </option>
      <?php  foreach ($MatId as $index22 => $value) { ?>
  <option value="<?php echo $MatId[$index22]?>"><?php echo $MatDescricao[$index22]; ?> | <?php echo $MatApelido[$index22]; ?></option>
	  <?php } ?>
</select>
												 
 
												</div>
											</div>



										</div>
										<div class="form-row">
											<div class="col-md-2">
												<div class="position-relative form-group">
 
   <label for="QTDE">Quantidade</label>
													<input name="QTDE" id="QTDE"  type="text" class="form-control">
													 
												 
 
												</div>
											</div>



										</div>



									</div>





								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									<button name="utilizarmaterial" type="submit" class="btn btn-primary">Utilizar</button>
								</div>


						</form>



						</div>
					</div>
				</div>


				<?php // orçamento adicioanr ?>
				
				
				<?php

				} else {

					?>

				<script>
					window.location = "index.php";
				</script>

				<?php } ?>