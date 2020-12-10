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
	 

		<?php // finaliza solicitação 


		if ( isset( $_POST[ "soli_finalizar" ] ) ) {
			?>

			<?php

			$SQL_FINALIZA_SOLICITACAO = "UPDATE gz_solicitacoes SET Status = '3' WHERE SoliId = '" . $_POST[ 'solicitacao_id' ] . "'";
			mysqli_query( $connect, $SQL_FINALIZA_SOLICITACAO );

			?>
			<audio id="myAudio">
				<source src="alert.ogg" type="audio/ogg">
				<source src="alert.mp3" type="audio/mpeg"> Your browser does not support the audio element.
			</audio>


			<?php




			$SQL_add_historico2 = "
	
	INSERT INTO gz_historico
	(
	historico_tarefa,
	historico_solicitacao,
	historico_descricao,
	historico_datainserida,
	historico_login
	)
	VALUES

(
	'',
	'" . $_POST[ 'solicitacao_id' ] . "',
	'Solicitação finalizada',
	NOW(),
'" . $login_cookie . "'
)
	
	
	";

			mysqli_query( $connect, $SQL_add_historico2 );

			?>


			<script>
				window.location.href = "SolicitacaoDetalhe.php?&sol=<?php echo $_POST['solicitacao_id']; ?>"
			</script>


			<?php } ?>




			<?php // marca tarefa como 02-feito

			$AtualizaStatusTarefa = $_GET[ "i" ];

			if ( $AtualizaStatusTarefa != '' ) {

				$AtualizaStatusTarefaSQL = "
			
			UPDATE gz_tarefas SET TarefaStatus = '02 - feito' WHERE TarefaId = '" . $AtualizaStatusTarefa . "'
			
			";

				mysqli_query( $connect, $AtualizaStatusTarefaSQL );





				// grava no hostiro a alteraçao
				$SQL_add_historico0 = "
	
	INSERT INTO gz_historico
	(
	historico_tarefa,
	historico_solicitacao,
	historico_descricao,
	historico_datainserida,
	historico_login
	)
	VALUES

(
	'" . $_GET[ "i" ] . "',
	'" . $_GET[ "sol" ] . "',
	'" . 'a tarefa <b>' . $_GET[ "f" ] . '</b> foi concluída.' . "',
	NOW(),
'" . $login_cookie . "'
)
	
	
	";

				mysqli_query( $connect, $SQL_add_historico0 );

				?>




				<script>
					window.location.href = "SolicitacaoDetalhe.php?&sol=<?php echo $_GET["sol"]; ?>#todo"
				</script>
				<?php
			}

			?>

			<?php // add especialista


			if ( isset( $_POST[ "especialista_form" ] ) ) {

				$SQL_add_tarfa = "INSERT  INTO gz_tarefas

(
TarefaDataCadastro,
TarefaSolicitacao,
TarefaTitulo,
TarefaStatus,
TarefaCriou
)
VALUES
(
NOW(),
'" . $_POST[ 'solicitacao_id' ] . "',
'" . $_POST[ 'ESPECIALISTA' ] . "',
'01 - criado',
'" . $login_cookie . "'
)";



				mysqli_query( $connect, $SQL_add_tarfa );


				 
				?>
				<script>
					window.location = "SolicitacaoDetalhe.php?sol=<?php echo  $_POST['solicitacao_id']; ?>"
				</script>
				<?php

			}
			?>


<?php
// Altero os dados quando clico em salvar
	
	
	if(isset($_POST["alterardados"])){
		
		
		 $AlteraCadastroSQL = "
		 
		 UPDATE gz_material SET
MatNF = '".$_POST['matNF']."',
MatControle    = '".$_POST['matControle']."',
MatFornecedor = '".$_POST['matFornecedor']."',
MatDescricao = '".$_POST['matDescricao']."',
MatCusto = '".$_POST['matCusto']."',
MatApelido = '".$_POST['matApelido']."',
MatCategoria = '".$_POST['matCategoria']."'

WHERE MatId = '".$_POST['MatId']."'
		 
		 
		 ";

	 mysqli_query( $connect, $AlteraCadastroSQL );
		
?>

 
<script>window.location="material.php";</script><?php
		
	}

?>


			<?php // add materaial  


			if ( isset( $_POST[ "adicionarmaterial" ] ) ) {

			 

				 


				$SQL_add_material = "
				INSERT INTO

				gz_material 
				(
				 
				MatFornecedor,
				MatCategoria,
				MatDescricao,
				MatApelido,
				MatCusto,
				MatDataCadastro,
				MatUltimaCompra,
				MatUnidade,
				MatGrade,
				MatATivado
				) VALUES (
				 
				'".$_POST['matFornecedor']."',
				'".$_POST['matCategoria']."',
				'".$_POST['matDescricao']."',
				'".$_POST['matApelido']."',
				'".$_POST['matCusto']."',
				NOW(),
				NOW(),
				'U',
				'U',
				'Sim'
				)
				";
				mysqli_query( $connect, $SQL_add_material ) ;
				
				

 
				 

				?>
				<script>
					window.location = "material.php?p=material";
				</script>
				<?php

			}



			?>


<?php //ENTRADA EWSTOQUE 

if ( isset( $_POST[ "darentrada" ] ) ) {

$SQL_entradamaterial = "
				INSERT INTO gz_material_estoque

				(
				MatEstoqueMaterial,
				MatEstoqueGrade,
				MatEstoqueEntradaSaida,
				MatData,
				MatQuemInteragiu,
				MatQTDE,
				MatNF,
				MatControle
				)
				VALUES
				(
				'".$_POST['MatIdEntrada']."',
				'U',
				'E',
				NOW(),
				'".$login_cookie."',
				'".$_POST['matQTDEEntrada']."',
				'".$_POST['matNF']."',
				'".$_POST['matControle']."'
				)
				";
				mysqli_query( $connect, $SQL_entradamaterial ) ;


				?>
				<script>
					window.location = "material.php?p=material";
				</script>
				<?php

			}
?>



			<?php
			// 01 LISTO TODOS OS PRODUTOS

			$MaterialSQL = "
	SELECT 
MatId, estoque(MatId) as qtde,
 
MatFornecedor,
MatCategoria,
MatDescricao,
MatApelido,
MatCusto,
MatDataCadastro,
MatUltimaCompra,
MatUnidade,
MatGrade,
MatAtivado,
gz_material_categoria.CatID as CatId,
gz_material_categoria.CatNome as CatNome,
gz_material_fornecedor.CatID as ForId,
gz_material_fornecedor.CatNome as ForNome FROM  gz_material

LEFT JOIN gz_material_fornecedor on gz_material_fornecedor.CatID = gz_material.MatFornecedor
LEFT JOIN gz_material_categoria on gz_material_categoria.CatID = gz_material.MatCategoria order by MatId asc

	";

	
	$MaterialRES = mysqli_query( $connect, $MaterialSQL );
			 if ( mysqli_num_rows( $MaterialRES ) > 0 ) {
             while ( $MaterialROW = mysqli_fetch_array( $MaterialRES ) ) {
			 
			 	$MatId[]			= $MaterialROW["MatId"];
				 
				$MatFornecedor[]	= $MaterialROW["MatFornecedor"];
				$MatCategoria[]		= $MaterialROW["MatCategoria"];
				$MatDescricao[]		= $MaterialROW["MatDescricao"];
				$MatApelido[]		= $MaterialROW["MatApelido"];
				$MatCusto[]			= $MaterialROW["MatCusto"];
				$MatDataCadastro[]	= $MaterialROW["MatDataCadastro"];
				$MatUltimaCompra[]	= $MaterialROW["MatUltimaCompra"];
				$MatUnidade[]		= $MaterialROW["MatUnidade"];
				$MatGrade[]			= $MaterialROW["MatGrade"];
				$MatAtivado[]		= $MaterialROW["MatAtivado"];
				$MatCatId[]    = $MaterialROW["CatId"];
				$MatCatNome[]    = $MaterialROW["CatNome"];
				$MatForId[]    = $MaterialROW["ForId"];
				 $MatForNome[]    = $MaterialROW["ForNome"];
				 $MatQTDE[]     = $MaterialROW["qtde"];

			 }}
			?>
		 

            <?php
			// 02 LISTO TODOS OS FORNECEDORES

			$fornecedorSQL = "
	SELECT CatID, CatNome, SoliCatAtivado FROM
gz_material_fornecedor
WHERE SoliCatAtivado = 'Sim'

	";

	
	$fornecedorRES = mysqli_query( $connect, $fornecedorSQL );
			 if ( mysqli_num_rows( $fornecedorRES ) > 0 ) {
             while ( $fROW = mysqli_fetch_array( $fornecedorRES ) ) {
			 
			 	$FornecedorID[]			    = $fROW["CatID"];
				$FornecedorNome[]			= $fROW["CatNome"];
				$FornecedorSoliCatAtivado[]	= $fROW["SoliCatAtivado"];
				 

			 }}
			?>


<?php
			// 03 LISTO CATEGORIAS

			$matCategoriaSQL = "
	SELECT CatID, CatNome, SoliCatAtivado FROM
gz_material_categoria
WHERE SoliCatAtivado = 'Sim'
	";

	
	$matCategoriaRES = mysqli_query( $connect, $matCategoriaSQL );
			 if ( mysqli_num_rows( $matCategoriaRES ) > 0 ) {
             while ( $mROW = mysqli_fetch_array( $matCategoriaRES ) ) {
			 
			 	$matCategoriaID[]			    = $mROW["CatID"];
				$matCategoriaNome[]			= $mROW["CatNome"];
				$matCategoriaSoliCatAtivado[]	= $mROW["SoliCatAtivado"];
				 

			 }}
			?>
			<!doctype html>
			<html lang="en">


			<meta http-equiv="content-type" content="text/html;charset=UTF-8"/ <meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta http-equiv="Content-Language" content="pt-br">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<title>Manager Z -Material</title>
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
 
			<!-- Disable tap highlight on IE -->
			<meta name="msapplication-tap-highlight" content="no">

			<link href="main.d810cf0ae7f39f28f336.css" rel="stylesheet" >
				
				
					 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
				 <script>

//paste this code under the head tag or in a separate js file.
	// Wait for window load
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
				</script>
	 
				<style>
				/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(https://smallenvelop.com/wp-content/uploads/2014/08/Preloader_11.gif) center no-repeat #fff;
}
				</style>
				
				
			</head>

			<body>
				 <div class="se-pre-con"></div>
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

 

								<div class="app-page-title">
									<div class="page-title-wrapper">
										<div class="page-title-heading">
											<div class="page-title-icon">
												<i class="pe-7s-box2 icon-gradient bg-mean-fruit"></i>
											</div>
											<div>Materiais
												 
												 
											</div>

										</div>
										<div class="page-title-actions">


										 
 


 



												<?// MOSTRA O MENU DE AÇÕES APENAS PARA O NIVEL PROFISSIONAL ?>

												<?php if ($managerlevel2 =='profissional') { ?>
												<div class="d-inline-block dropdown">
													<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                                    <i class="fa fa-business-time fa-w-20"></i>
                                                </span>
                                                Ações
                                            </button>
												

													<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
														<ul class="nav flex-column">
															<li class="nav-item">
																<a class="nav-link" data-toggle="modal" data-target="#AddModal">
                                                            <i class="nav-link-icon pe-7s-box2"></i>
                                                            <span> Adicionar material</span>
                                                         </a>
															

															</li>
															 
														</ul>
													</div>
												</div>
												<?php } ?>

												<?// MOSTRA O MENU DE AÇÕES APENAS PARA O NIVEL PROFISSIONAL ?>

 









										</div>
									</div>







								</div>
 
								
								
								
								
								
								
								
								
								
								
							 
								
								
								
								
								
								
								

							<div class="row">
								
								<div class="col-md-12">
									  <div class="main-card mb-3 card">
                            <div class="card-body">
									<table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <tr>
										
										<th valign="center" style="text-align: center;">Material</th>
                                        <th valign="center" style="text-align: center;">Apelido</th>
                                        <th valign="center" style="text-align: center;">ID</th>
										  
                                        
                                        <th valign="center" style="text-align: center;">Fornecedor</th>
                                        <th valign="center" style="text-align: center;">Custo</th>
										<th valign="center" style="text-align: center;">Quantidade</th>
										<th> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
										<?php  foreach ($MatId as $index2 => $value) { ?>
                                    <tr>
										 <td><?php echo  $MatDescricao[$index2];?></td>
                                        <td><?php echo  $MatApelido[$index2];?></td>
										
                                        <td valign="center" style="text-align: center;"><?php echo  $MatId[$index2];?> </td>
										 
                                       
                                        <td><?php echo  $MatForNome[$index2];?></td>
                                        <td valign="center" style="text-align: center;"><?php echo  $MatCusto[$index2];?></td>
										<td  valign="center" style="text-align: center;"><?php echo  $MatQTDE[$index2];?></td>
										<td  valign="center" style="text-align: center;"><button class="border-0 btn-transition btn btn-outline-success" data-toggle="modal" data-target="#editModal<?php echo $MatId[$index2];?>">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
											</td>
                                        
                                    </tr>
										<?php } ?>
                                     
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                          <th valign="center" style="text-align: center;">ID</th>
										 
                                        <th valign="center" style="text-align: center;">Material</th>
                                        <th valign="center" style="text-align: center;">Apelido</th>
                                        <th valign="center" style="text-align: center;">Fornecedor</th>
                                        <th valign="center" style="text-align: center;">Custo</th>
										<th valign="center" style="text-align: center;">Quantidade</th>
										<th> </th>
                                    </tr>
                                    </tfoot>
                                </table>
									</div></div>
								</div>
							
							</div>

								 
									
									 

								 

								 
							</div>


							 


							<?php include "z_rodape.php";?>





						</div>
					</div>
				</div>


				<?php include "z_direita.php";?>



			</body>


			</html>


			 
			 <!-- Modal -->
	<?php  foreach ($MatId as $index12 => $value) { ?>

	<div class="modal fade" id="editModal<?php echo $MatId[$index12];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						 <i class="lnr-list icon-gradient bg-mean-fruit"></i> Editar Material  <?php echo $MatId[$index12];?>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
						
                </button>
				

				</div>
				 
				<form action="material.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
				
				<div class="modal-body">
					
					
						
						<input type="hidden" value="<?php echo $MatId[$index12];?>" name="MatIdEntrada"> 
					

					 <div>
									<div>

										<div class="form-row">
											<div class="col-md-3">
												<div class="position-relative form-group">
													<label for="matNF">Nº Nota Fiscal</label>
													<input name="matNF" id="matNF"  type="text" class="form-control" value=" ">
												</div>
											</div>
											 
											<div class="col-md-3">
												<div class="position-relative form-group">
													<label for="matControle">Nº Controle</label>
													<input name="matControle" id="matControle"  type="text" class="form-control" value=" ">
												</div>
											</div>
											
											<div class="col-md-2">
												<div class="position-relative form-group">
													<label for="matQTDEEntrada">Quantidade</label>
													<input name="matQTDEEntrada" id="matQTDEEntrada"  type="text" class="form-control" value="">
												</div>
											</div>
											<div class="col-md-3">
												<div class="position-relative form-group">
													 <label for="matQTDEEntrada"> <span style="color:#fff;">________</span></label>
													<button name="darentrada" type="submit" class="btn btn-success">Dar Entrada</button>
												</div>
											</div>
											

										</div>
										 <div class="form-row">
											<div class="col-md-6">
												<div class="position-relative form-group">
													<label for="matFornecedor">Fornecedor</label>
													<select id="matFornecedor" name="matFornecedor" class="form-control">
													
														<option value="<?php echo $MatFornecedor[$index12];?>" selected><?php echo $MatForNome[$index12];?></option>
														<?php  foreach ($FornecedorID as $index3 => $value) { ?>
														
														<option value="<?php echo $FornecedorID[$index3];?>"><?php echo $FornecedorNome[$index3];?></option>
														
														<?php } ?>
													
													</select>
													
													
												</div>
											</div>
											<div class="col-md-6">
												<div class="position-relative form-group">
													<label for="matCategoria">Categoria</label>
													<select id="matCategoria" name="matCategoria" class="form-control">
													
														<option value="<?php echo $MatCategoria[$index12];?>" selected><?php echo $MatCatNome[$index12];?></option>
														<?php  foreach ($matCategoriaID as $index4 => $value) { ?>
														
														<option value="<?php echo $matCategoriaID[$index4];?>"><?php echo $matCategoriaNome[$index4];?></option>
														
														<?php } ?>
													
													</select>
													
													 
													
													
												</div>
											</div>

										</div>
										<div class="form-row">
											<div class="col-md-12">
												<div class="position-relative form-group">
													<label for="matDescricao">Descrição</label>
													<input name="matDescricao" id="matDescricao"  type="text" class="form-control" value="<?php echo $MatDescricao[$index12];?>" >
												</div>
											</div>
											 

										</div>
<div class="form-row">
											<div class="col-md-6">
												<div class="position-relative form-group">
													<label for="matApelido">Apelido</label>
													<input name="matApelido" id="matApelido"  type="text" class="form-control" value="<?php echo $MatApelido[$index12];?>" >
												</div>
											</div>
											<div class="col-md-3">
												<div class="position-relative form-group">
													<label for="matCusto">Custo Unit. (R$)</label>
													<input name="matCusto" id="matCusto"  type="text" class="form-control" value="<?php echo $MatCusto[$index12];?>" >
												</div>
											</div>
	
	<div class="col-md-3">
												<div class="position-relative form-group">
													<label for="matQTDE">Quantidade</label>
													<input name="matQTDE" id="matQTDE"  type="text" class="form-control" value="<?php echo $MatQTDE[$index12];?>" readonly>
												</div>
											</div>
	
											 

										</div>


									</div>





								</div>
					
					 <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <h5 class="card-title">Movimentação deste material</h5>
                                            <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                
												
												<?php // historico de movimentação 
												
												$SQL_mov_hist = "
												SELECT MatEstoqueId, MatEstoqueMaterial, MatEstoqueGrade, MatEstoqueEntradaSaida, MatQTDE, MatData, MatQuemInteragiu, MatNF, MatControle, MatSolicitacao FROM gz_material_estoque WHERE MatEstoqueMaterial = '".$MatId[$index12]."'
												"; 
												$RES_mov_hist = mysqli_query( $connect, $SQL_mov_hist );
												 if ( mysqli_num_rows( $RES_mov_hist ) > 0 ) {
												 while ( $ROW_mov_hist = mysqli_fetch_array( $RES_mov_hist ) ) {
												
												?>
												
												
												
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <p>   <?php 
																
																if ($ROW_mov_hist["MatEstoqueEntradaSaida"] == "S") { ?> 
																
																<span class="opacity-10 text-danger pr-2">
                                                        <i class="fa fa-angle-down"></i>
                                                    </span> 
															
															
																<?php } else 
																if ($ROW_mov_hist["MatEstoqueEntradaSaida"] == "E") { ?>
																
																<span class="opacity-10 text-success pr-2">
                                                        <i class="fa fa-angle-up"></i>
                                                    </span>
																
																<?php }
																
																?>    
																
																 <?php 
																
																if ($ROW_mov_hist["MatEstoqueEntradaSaida"] == "S") {  ?><span class="text-danger"><?php } else 
																if ($ROW_mov_hist["MatEstoqueEntradaSaida"] == "E") {  ?><span class="text-success"><?php }
																
																?>    
																
																
																
																
																
																
																<?php echo $ROW_mov_hist["MatQTDE"];?> </span> 
																
																
																<?php if ($ROW_mov_hist["MatSolicitacao"] != "") {   ?>
																Utilizado na solicitação <b>#<?php echo $ROW_mov_hist["MatSolicitacao"];?> </b>
																<?php } else {}?>
																
																
																
																<?php if ($ROW_mov_hist["MatNF"] != "") {   ?>
																NF: <?php echo $ROW_mov_hist["MatNF"];?>, 
																<?php } else {} ?>
																<?php if ($ROW_mov_hist["MatControle"] != "") {   ?>
																Controle: <?php echo $ROW_mov_hist["MatControle"];?>.  
																<?php }  else {} ?>
																<small>Em <?php echo date('d/m/Y', strtotime($ROW_mov_hist["MatData"]));?> <?php echo $ROW_mov_hist["MatQuemInteragiu"];?></small>
																
																 </p>
                                                        </div>
                                                    </div>
                                                </div>
												
												<?php }} ?>
                                                 
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
						    <i class="nav-link-icon pe-7s-box2"></i> Adicionar um material
					</h5>
						

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
						
                </button>
						



						</div>

						<form action="material.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
							 
							<div class="modal-body">
 

								<div>
									<div>

										 
										<div class="form-row">
											<div class="col-md-6">
												<div class="position-relative form-group">
													<label for="matFornecedor">Fornecedor</label>
													<select id="matFornecedor" name="matFornecedor" class="form-control">
													
														<option value="#" selected>Selecione</option>
														<?php  foreach ($FornecedorID as $index3 => $value) { ?>
														
														<option value="<?php echo $FornecedorID[$index3];?>"><?php echo $FornecedorNome[$index3];?></option>
														
														<?php } ?>
													
													</select>
													
													
												</div>
											</div>
											<div class="col-md-6">
												<div class="position-relative form-group">
													<label for="matCategoria">Categoria</label>
													<select id="matCategoria" name="matCategoria" class="form-control">
													
														<option value="#" selected>Selecione</option>
														<?php  foreach ($matCategoriaID as $index4 => $value) { ?>
														
														<option value="<?php echo $matCategoriaID[$index4];?>"><?php echo $matCategoriaNome[$index4];?></option>
														
														<?php } ?>
													
													</select>
													
													 
													
													
												</div>
											</div>

										</div>
										<div class="form-row">
											<div class="col-md-12">
												<div class="position-relative form-group">
													<label for="matDescricao">Descrição</label>
													<input name="matDescricao" id="matDescricao"  type="text" class="form-control">
												</div>
											</div>
											 

										</div>
<div class="form-row">
											<div class="col-md-6">
												<div class="position-relative form-group">
													<label for="matApelido">Apelido</label>
													<input name="matApelido" id="matApelido"  type="text" class="form-control">
												</div>
											</div>
											<div class="col-md-6">
												<div class="position-relative form-group">
													<label for="matCusto">Custo Unit. (R$)</label>
													<input name="matCusto" id="matCusto"  type="text" class="form-control">
												</div>
											</div>
											 
	
	
											 

										</div>


									</div>





								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
									<button name="adicionarmaterial" type="submit" class="btn btn-primary">Adicionar</button>
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
						    <i class="nav-link-icon lnr-pushpin"></i> Adicionar uma Imagem
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

													sss
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










				<?php

				} else {

					?>

				<script>
					window.location = "index.php";
				</script>

				<?php } ?>