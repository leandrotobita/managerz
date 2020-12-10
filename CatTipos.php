<?php
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
	// Busco todas as categorias do banco

	$BuscaCategoriaSQL = "SELECT SoliCatId, SoliCatDescricao, SoliCatAtivado FROM solicategoria WHERE SoliCatAtivado = 'Sim' ORDER BY SoliCatDescricao ASC ";

	$BuscaCategoriaRES = mysqli_query( $connect, $BuscaCategoriaSQL );

	if ( mysqli_num_rows( $BuscaCategoriaRES ) > 0 ) {






		while ( $BuscaCategoriaROW = mysqli_fetch_array( $BuscaCategoriaRES ) ) {



			$BuscaCategoriaROW_SoliCatId[] = $BuscaCategoriaROW[ "SoliCatId" ];
			$BuscaCategoriaROW_SoliCatDescricao[] = $BuscaCategoriaROW[ "SoliCatDescricao" ];
			$BuscaCategoriaROW_SoliCatAtivado[] = $BuscaCategoriaROW[ "SoliCatAtivado" ];
			 



		}

	}

	?>

	<?php
	// Busco todas os tipos do banco

	$BuscaTipoSQL = "SELECT SoliTipoId, SoliTipoDescricao, SoliTipoAtivado, SoliTipoCat, solicategoria.SoliCatDescricao FROM solitipo 

LEFT JOIN solicategoria on solicategoria.SoliCatId = solitipo.SoliTipoCat

ORDER BY SoliTipoDescricao ASC ";

	$BuscaTipoRES = mysqli_query( $connect, $BuscaTipoSQL );

	if ( mysqli_num_rows( $BuscaTipoRES ) > 0 ) {






		while ( $BuscaTipoROW = mysqli_fetch_array( $BuscaTipoRES ) ) {



			$BuscaTipoROW_SoliTipoId[] 		     = $BuscaTipoROW[ "SoliTipoId" ];
			$BuscaTipoROW_SoliTipoDescricao[]    = $BuscaTipoROW[ "SoliTipoDescricao" ];
			$BuscaTipoROW_SoliTipoAtivado[]      = $BuscaTipoROW[ "SoliTipoAtivado" ];
			$BuscaTipoROW_SoliTipoCat[]          = $BuscaTipoROW[ "SoliTipoCat" ];
			$BuscaTipoROW_SoliTipoCatDescricao[] = $BuscaTipoROW[ "SoliCatDescricao" ];
			 



		}

	}

	?>

<?php
// Altero os dados quando clico em salvar
	
	
	if(isset($_POST["alterardados"])){
		
		
		 $AlteraCadastroSQL = "
		 UPDATE solitipo SET
		 
		 SoliTipoDescricao 	= '".$_POST['DESCRICAO']."', 
		 SoliTipoAtivado    = '".$_POST['STATUS']."',
		 SoliTipoCat        = '".$_POST['CATEGORIA']."'
		 
		 WHERE   SoliTipoId = '".$_POST['SoliTipoId']."'";

	 mysqli_query( $connect, $AlteraCadastroSQL );
		
?>

 
<script>window.location="SoliTipos.php";</script><?php
		
	}

?>

<?php
// Altero os dados quando clico em salvar
	
	
	if(isset($_POST["adicionardados"])){
		
		
		 $AlteraCadastroSQL = "
		 INSERT INTO solitipo  
		 
		 (
		 SoliTipoDescricao,
		 SoliTipoAtivado,
		 SoliTipoCat
		 ) VALUES (
		 
		 '".$_POST['TIPO']."',
		 'Sim',
		 '".$_POST['CATEGORIA']."'
		 )";

	 mysqli_query( $connect, $AlteraCadastroSQL );
		
?>

 
<script>window.location="SoliTipos.php";</script><?php
		
	}

?>



	<!doctype html>
	<html lang="en">

	<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Language" content="en">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Manager Z - Tipos</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
		<meta name="description" content="This is an example dashboard created using build-in elements and components.">

		<!-- Disable tap highlight on IE -->
		<meta name="msapplication-tap-highlight" content="no">

		<link href="main.d810cf0ae7f39f28f336.css" rel="stylesheet">
		
		 
	
	
	</head>

	<body>
		<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

			<?php include "z_topo.php"; ?>



			<div class="app-main">
				<div class="app-sidebar sidebar-shadow">
					<div class="app-header__logo">
						<div class="logo-src"></div>
						<div class="header__pane ml-auto">
							<div>
								<button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
							

							</div>
						</div>
					</div>
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
						<div class="app-page-title">
							<div class="page-title-wrapper">
								<div class="page-title-heading">
									<div class="page-title-icon">
										<i class="lnr-list icon-gradient bg-mean-fruit"></i>
									</div>
									<div>Controle de Manutenção - Tipos
										<div class="page-title-subheading">Listas de Tipos.</div>
									</div>
								</div>
							</div>
						</div>




						<div class="main-card mb-3 card">
							<div class="d-block text-right card-footer">

								<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#AddModal">Adicionar</button>
								   
 								
							</div>
							<div class="card-header">Tipos cadastrados</div>
							
							<ul class="todo-list-wrapper list-group list-group-flush">


								<?php  foreach ($BuscaTipoROW_SoliTipoId as $index => $value) { ?>
								<li class="list-group-item">
									<div class="todo-indicator bg-warning"></div>
									<div class="widget-content p-0">
										<div class="widget-content-wrapper">

											<div class="widget-content-left">
												<div class="widget-heading">
													<?php echo $BuscaTipoROW_SoliTipoDescricao[$index];?>

												</div>
												<div class="widget-subheading">
													<i>
														Categoria <?php echo $BuscaTipoROW_SoliTipoCatDescricao[$index];?> 
														 
													</i>
												</div>
												 
											</div>
											 
											
											<div class="widget-content-right  ">
												
												<?php if ($BuscaTipoROW_SoliTipoAtivado[$index] == "Sim") { ?>
												 <div class="mb-2 mr-2 badge badge-success">Ativado</div> 
												<?php } else { ?>
												<div class="mb-2 mr-2 badge badge-secondary">Desativado</div>
												<?php } ?>
												
												
												<button class="border-0 btn-transition btn btn-outline-success" data-toggle="modal" data-target="#editModal<?php echo $BuscaTipoROW_SoliTipoId[$index];?>">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
											


											</div>
										</div>
									</div>
								</li>








								<?php } ?>

							</ul>
							
						</div>

						<div class="tabs-animation">




						</div>
					</div>




					<?php include "z_rodape.php";?>





				</div>
			</div>
		</div>


		<?php include "z_direita.php";?>

 

	</body>


	</html>

 
<div class="modal fade" id="modalsucesso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						 xxxxxxxxx
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
						
                </button>
				

				</div>
				 
				<form action="SoliTipos.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
				
				<div class="modal-body">
					 xxxxx
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<button name="alterardados" type="submit" class="btn btn-primary">Salvar alterações</button>
				</div>
				
				
				</form>
				
				
				
			</div>
		</div>
	</div>



  



	<!-- Modal -->
	<?php  foreach ($BuscaTipoROW_SoliTipoId as $index => $value) { ?>
	<div class="modal fade" id="editModal<?php echo $BuscaTipoROW_SoliTipoId[$index];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						 <i class="lnr-list icon-gradient bg-mean-fruit"></i> Editar tipo
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
						
                </button>
				

				</div>
				 
				<form action="SoliTipos.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
				
				<div class="modal-body">
					
					
						
						<input type="hidden" value="<?php echo $BuscaTipoROW_SoliTipoId[$index];?>" name="SoliTipoId"> 
					

					<div>

						 <div class="form-row">
							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="DESCRICAO">Descrição </label>
									<input name="DESCRICAO" id="DESCRICAO" value="<?php echo $BuscaTipoROW_SoliTipoDescricao[$index];?>" type="text" class="form-control">
								</div>
							</div>
							 	
							 
							 
							

						</div>
						
						
						
						<div class="form-row">
						<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="CATEGORIA">Categoria </label>
									
									<select class="mb-2 form-control" name="CATEGORIA">
	<option value="<?php echo $BuscaTipoROW_SoliTipoCat[$index];?>"><?php echo $BuscaTipoROW_SoliTipoCatDescricao[$index];?></option>
									
										 <?php  foreach ($BuscaCategoriaROW_SoliCatId as $index2 => $value) { ?>
										<option value="<?php echo $BuscaCategoriaROW_SoliCatId[$index2];?>"><?php echo $BuscaCategoriaROW_SoliCatDescricao[$index2];?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							 
						
						</div>
						
						
						
						

							 
							<div class="form-row">
								 
								<div class="col-md-6"> 
									<div class="position-relative form-group">
										<label for="STATUS">Ativado</label>
 										
<select class="mb-2 form-control" name="STATUS">
	<option value="<?php echo $BuscaTipoROW_SoliTipoAtivado[$index];?>"><?php echo $BuscaTipoROW_SoliTipoAtivado[$index];?></option>
											
	<?php if ($BuscaTipoROW_SoliTipoAtivado[$index] == "Sim") { ?>
	<option value="Não">Não</option>
	<?php } else { ?>
  <option value="Sim">Sim</option>
	<?php } ?>
										
										
										</select>
									</div>
								</div>
							</div>
							
 

 

					</div>
					
					
					
					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<button name="alterardados" type="submit" class="btn btn-primary">Salvar alterações</button>
				</div>
				
				
				</form>
				
				
				
			</div>
		</div>
	</div>
	<?php } ?>

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="AddModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="AddModal">
						  Adicionar um tipo
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
						
                </button>
				

				</div>
				 
				<form action="SoliTipos.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
				
				<div class="modal-body">
					
					
						
						 
					

					<div>

						<div class="form-row">
							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="TIPO">Descrição</label>
									<input name="TIPO" id="TIPO" PlaceHolder="Ex: Troca de lâmbada" type="text" class="form-control">
								</div>
							</div>

							 

						</div>
						
						<div class="form-row">
						<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="CATEGORIA">Categoria </label>
									
									<select class="mb-2 form-control" name="CATEGORIA">
 									 <option>Selecione</option>
										 <?php  foreach ($BuscaCategoriaROW_SoliCatId as $index3 => $value) { ?>
										<option value="<?php echo $BuscaCategoriaROW_SoliCatId[$index3];?>"><?php echo $BuscaCategoriaROW_SoliCatDescricao[$index3];?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							 
						
						</div>

 

					</div>
					
					
					
					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<button name="adicionardados" type="submit" class="btn btn-primary">Adicionar</button>
				</div>
				
				
				</form>
				
				
				
			</div>
		</div>
	</div>
 




	<?php

} else {

	?>

	<script>
		window.location = "index.php";
	</script>

	<?php } ?>