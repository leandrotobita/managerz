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
	// Busco todas as empresas do banco

	$BuscaEmpresasSQL = "SELECT GZ_EMPRESA_ID, RAZAOSOCIAL, FANTASIA, ENDERECO, BAIRRO, CIDADE, CEP, UF, TELEFONE, INSCRESTADUAL, INSCRMUNICIPAL, CNPJ, FAX, COMPLEMENTO  FROM gz_empresas ORDER BY FANTASIA ASC";

	$BuscaEmpresasRES = mysqli_query( $connect, $BuscaEmpresasSQL );

	if ( mysqli_num_rows( $BuscaEmpresasRES ) > 0 ) {






		while ( $BuscaEmpresasROW = mysqli_fetch_array( $BuscaEmpresasRES ) ) {



			$BuscaEmpresas_GZ_EMPRESA_ID[] = $BuscaEmpresasROW[ "GZ_EMPRESA_ID" ];
			$BuscaEmpresas_RAZAOSOCIAL[] = $BuscaEmpresasROW[ "RAZAOSOCIAL" ];
			$BuscaEmpresas_FANTASIA[] = $BuscaEmpresasROW[ "FANTASIA" ];
			$BuscaEmpresas_ENDERECO[] = $BuscaEmpresasROW[ "ENDERECO" ];
			$BuscaEmpresas_BAIRRO[] = $BuscaEmpresasROW[ "BAIRRO" ];
			$BuscaEmpresas_CIDADE[] = $BuscaEmpresasROW[ "CIDADE" ];
			$BuscaEmpresas_CEP[] = $BuscaEmpresasROW[ "CEP" ];
			$BuscaEmpresas_UF[] = $BuscaEmpresasROW[ "UF" ];
			$BuscaEmpresas_TELEFONE[] = $BuscaEmpresasROW[ "TELEFONE" ];
			$BuscaEmpresas_INSCRESTADUAL[] = $BuscaEmpresasROW[ "INSCRESTADUAL" ];
			$BuscaEmpresas_INSCRMUNICIPAL[] = $BuscaEmpresasROW[ "INSCRMUNICIPAL" ];
			$BuscaEmpresas_CNPJ[] = $BuscaEmpresasROW[ "CNPJ" ];
			$BuscaEmpresas_FAX[] = $BuscaEmpresasROW[ "FAX" ];
			$BuscaEmpresas_COMPLEMENTO[] = $BuscaEmpresasROW[ "COMPLEMENTO" ];



		}

	}

	?>

<?php
// Altero os dados quando clico em salvar
	
	
	if(isset($_POST["alterardados"])){
		
		
		 $AlteraCadastroSQL = "
		 UPDATE gz_empresas SET
		 
		 RAZAOSOCIAL 	= '".$_POST['RAZAOSOCIAL']."', 
		 FANTASIA 		= '".$_POST['FANTASIA']."', 
		 ENDERECO 		= '".$_POST['ENDERECO']."', 
		 BAIRRO 		= '".$_POST['BAIRRO']."', 
		 CIDADE 		= '".$_POST['CIDADE']."', 
		 CEP 			= '".$_POST['CEP']."', 
		 UF 			= '".$_POST['UF']."', 
		 TELEFONE 		= '".$_POST['TELEFONE']."', 
		 INSCRESTADUAL  = '".$_POST['INSCRESTADUAL']."', 
		 INSCRMUNICIPAL = '".$_POST['INSCRMUNICIPAL']."', 
		 CNPJ 			= '".$_POST['CNPJ']."', 
		 FAX 			= '".$_POST['FAX']."', 
		 COMPLEMENTO    = '".$_POST['COMPLEMENTO']."'
		 WHERE   GZ_EMPRESA_ID = '".$_POST['GZ_EMPRESA_ID']."'";

	 mysqli_query( $connect, $AlteraCadastroSQL );
		
?>

 
<script>window.location="SoliEmpresas.php";</script><?php
		
	}

?>

<?php
// Altero os dados quando clico em salvar
	
	
	if(isset($_POST["adicionardados"])){
		
		
		 $AlteraCadastroSQL = "
		 INSERT INTO gz_empresas  
		 
		 (
		 RAZAOSOCIAL,
		 FANTASIA,
		 ENDERECO,
		 BAIRRO,
		 CIDADE,
		 CEP,
		 UF,
		 TELEFONE,
		 INSCRESTADUAL,
		 INSCRMUNICIPAL,
		 CNPJ,
		 FAX,
		 COMPLEMENTO
		 ) VALUES (
		 
		 
		 '".$_POST['RAZAOSOCIAL']."', 
		 '".$_POST['FANTASIA']."', 
		 '".$_POST['ENDERECO']."', 
		 '".$_POST['BAIRRO']."', 
		 '".$_POST['CIDADE']."', 
		 '".$_POST['CEP']."', 
		 '".$_POST['UF']."', 
		 '".$_POST['TELEFONE']."', 
		 '".$_POST['INSCRESTADUAL']."', 
		 '".$_POST['INSCRMUNICIPAL']."', 
		 '".$_POST['CNPJ']."', 
		 '".$_POST['FAX']."', 
		 '".$_POST['COMPLEMENTO']."'
		 )";

	 mysqli_query( $connect, $AlteraCadastroSQL );
		
?>

 
<script>window.location="SoliEmpresas.php";</script><?php
		
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
		<title>Manager Z - Empresas</title>
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
										<i class="lnr-apartment icon-gradient bg-mean-fruit"></i>
									</div>
									<div>Controle de Manutenção - Empresas
										<div class="page-title-subheading">Listas de empresas.</div>
									</div>
								</div>
							</div>
						</div>




						<div class="main-card mb-3 card">
							<div class="d-block text-right card-footer">

								<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#AddModal">Adicionar</button>
								   
 								
							</div>
							<div class="card-header">Empresas cadastradas</div>
							
							<ul class="todo-list-wrapper list-group list-group-flush">


								<?php  foreach ($BuscaEmpresas_GZ_EMPRESA_ID as $index => $value) { ?>
								<li class="list-group-item">
									<div class="todo-indicator bg-warning"></div>
									<div class="widget-content p-0">
										<div class="widget-content-wrapper">

											<div class="widget-content-left">
												<div class="widget-heading">
													<?php echo $BuscaEmpresas_FANTASIA[$index];?>

												</div>
												<div class="widget-subheading">
													<i>
														<?php echo $BuscaEmpresas_CNPJ[$index];?>
														<?php echo $BuscaEmpresas_RAZAOSOCIAL[$index];?>
													</i>
												</div>
											</div>
											<div class="widget-content-right widget-content-actions">
												<button class="border-0 btn-transition btn btn-outline-success" data-toggle="modal" data-target="#editModal<?php echo $BuscaEmpresas_GZ_EMPRESA_ID[$index];?>">
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
				 
				<form action="SoliEmpresas.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
				
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
	<?php  foreach ($BuscaEmpresas_GZ_EMPRESA_ID as $index => $value) { ?>
	<div class="modal fade" id="editModal<?php echo $BuscaEmpresas_GZ_EMPRESA_ID[$index];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						  <?php echo $BuscaEmpresas_FANTASIA[$index];?> 
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
						
                </button>
				

				</div>
				 
				<form action="SoliEmpresas.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
				
				<div class="modal-body">
					
					
						
						<input type="hidden" value="<?php echo $BuscaEmpresas_GZ_EMPRESA_ID[$index];?>" name="GZ_EMPRESA_ID"> 
					

					<div>

						<div class="form-row">
							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="CNPJ">CNPJ</label>
									<input name="CNPJ" id="CNPJ" value="<?php echo $BuscaEmpresas_CNPJ[$index];?>" type="text" class="form-control">
								</div>
							</div>

							<div class="form-row">
								<div class="col-md-6">
									<div class="position-relative form-group">
										<label for="INSCRESTADUAL">Inscrição Estadual</label>
										<input name="INSCRESTADUAL" id="INSCRESTADUAL" value="<?php echo $BuscaEmpresas_INSCRESTADUAL[$index];?>" type="text" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="position-relative form-group">
										<label for="INSCRMUNICIPAL">Inscrição Municipal</label>
										<input name="INSCRMUNICIPAL" id="INSCRMUNICIPAL" value="<?php echo $BuscaEmpresas_INSCRMUNICIPAL[$index];?>" type="text" class="form-control">
									</div>
								</div>
							</div>

						</div>




						<div class="form-row">
							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="RAZAOSOCIAL">Razão Social  </label>
									<input name="RAZAOSOCIAL" id="RAZAOSOCIAL" value="<?php echo $BuscaEmpresas_RAZAOSOCIAL[$index];?>" type="text" class="form-control">
								</div>
							</div>

						</div>
						<div class="form-row">

							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="FANTASIA">Fantasia</label>
									<input name="FANTASIA" id="FANTASIA" value="<?php echo $BuscaEmpresas_FANTASIA[$index];?>" type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="ENDERECO">Endereço</label>
									<input name="ENDERECO" id="ENDERECO" value="<?php echo $BuscaEmpresas_ENDERECO[$index];?>" type="text" class="form-control">
								</div>
							</div>

						</div>
						<div class="form-row">
							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="COMPLEMENTO">Complemento</label>
									<input name="COMPLEMENTO" id="COMPLEMENTO" value="<?php echo $BuscaEmpresas_COMPLEMENTO[$index];?>" type="text" class="form-control">
								</div>
							</div>

						</div>

						<div class="form-row">
							<div class="col-md-6">
								<div class="position-relative form-group">
									<label for="BAIRRO">Bairro</label>
									<input name="BAIRRO" id="BAIRRO" value="<?php echo $BuscaEmpresas_BAIRRO[$index];?>" type="text" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative form-group">
									<label for="CIDADE">Cidade</label>
									<input name="CIDADE" id="CIDADE" value="<?php echo $BuscaEmpresas_CIDADE[$index];?>" type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<div class="position-relative form-group">
									<label for="CEP">CEP</label>
									<input name="CEP" id="CEP" type="text" class="form-control" value="<?php echo $BuscaEmpresas_CEP[$index];?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative form-group">
									<label for="ESTADO">Estado</label>
									<select class="mb-2 form-control" name="ESTADO">
																				<option value="<?php echo $BuscaEmpresas_UF[$index];?>" selected><?php echo $BuscaEmpresas_UF[$index];?></option>
																				 
																			</select>
								

								</div>
							</div>

							<div class="form-row">
								<div class="col-md-6">
									<div class="position-relative form-group">
										<label for="TELEFONE">Telefone</label>
										<input name="TELEFONE" id="TELEFONE" value="<?php echo $BuscaEmpresas_TELEFONE[$index];?>" type="text" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="position-relative form-group">
										<label for="FAX">Fax</label>
										<input name="FAX" id="FAX" value="<?php echo $BuscaEmpresas_FAX[$index];?>" type="text" class="form-control">
									</div>
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
						  Adicionar uma empresa
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
						
                </button>
				

				</div>
				 
				<form action="SoliEmpresas.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
				
				<div class="modal-body">
					
					
						
						 
					

					<div>

						<div class="form-row">
							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="CNPJ">CNPJ</label>
									<input name="CNPJ" id="CNPJ" PlaceHolder="CNPJ" type="text" class="form-control">
								</div>
							</div>

							<div class="form-row">
								<div class="col-md-6">
									<div class="position-relative form-group">
										<label for="INSCRESTADUAL">Inscrição Estadual</label>
										<input name="INSCRESTADUAL" id="INSCRESTADUAL"  PlaceHolder="Inscrição Estadual" type="text" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="position-relative form-group">
										<label for="INSCRMUNICIPAL">Inscrição Municipal</label>
										<input name="INSCRMUNICIPAL" id="INSCRMUNICIPAL"  PlaceHolder="Inscrição Municipal"  type="text" class="form-control">
									</div>
								</div>
							</div>

						</div>




						<div class="form-row">
							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="RAZAOSOCIAL">Razão Social  </label>
									<input name="RAZAOSOCIAL" id="RAZAOSOCIAL"  PlaceHolder="Razão Social"  type="text" class="form-control">
								</div>
							</div>

						</div>
						<div class="form-row">

							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="FANTASIA">Fantasia</label>
									<input name="FANTASIA" id="FANTASIA"  PlaceHolder="Fantasia"  type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="ENDERECO">Endereço</label>
									<input name="ENDERECO" id="ENDERECO"  PlaceHolder="Endereço"  type="text" class="form-control">
								</div>
							</div>

						</div>
						<div class="form-row">
							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="COMPLEMENTO">Complemento</label>
									<input name="COMPLEMENTO" id="COMPLEMENTO"  PlaceHolder="Complemento"  type="text" class="form-control">
								</div>
							</div>

						</div>

						<div class="form-row">
							<div class="col-md-6">
								<div class="position-relative form-group">
									<label for="BAIRRO">Bairro</label>
									<input name="BAIRRO" id="BAIRRO"  PlaceHolder="Bairro"  type="text" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative form-group">
									<label for="CIDADE">Cidade</label>
									<input name="CIDADE" id="CIDADE"  PlaceHolder="Cidade"  type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<div class="position-relative form-group">
									<label for="CEP">CEP</label>
									<input name="CEP" id="CEP" type="text" class="form-control" PlaceHolder="15105-000">
								</div>
							</div>
							<div class="col-md-6">
								<div class="position-relative form-group">
									<label for="ESTADO">Estado</label>
									<select class="mb-2 form-control" name="ESTADO">
										<option value="#">Estado</option>
																				<option value="AC">Acre</option>
	<option value="AL">Alagoas</option>
	<option value="AP">Amapá</option>
	<option value="AM">Amazonas</option>
	<option value="BA">Bahia</option>
	<option value="CE">Ceará</option>
	<option value="DF">Distrito Federal</option>
	<option value="ES">Espírito Santo</option>
	<option value="GO">Goiás</option>
	<option value="MA">Maranhão</option>
	<option value="MT">Mato Grosso</option>
	<option value="MS">Mato Grosso do Sul</option>
	<option value="MG">Minas Gerais</option>
	<option value="PA">Pará</option>
	<option value="PB">Paraíba</option>
	<option value="PR">Paraná</option>
	<option value="PE">Pernambuco</option>
	<option value="PI">Piauí</option>
	<option value="RJ">Rio de Janeiro</option>
	<option value="RN">Rio Grande do Norte</option>
	<option value="RS">Rio Grande do Sul</option>
	<option value="RO">Rondônia</option>
	<option value="RR">Roraima</option>
	<option value="SC">Santa Catarina</option>
	<option value="SP">São Paulo</option>
	<option value="SE">Sergipe</option>
	<option value="TO">Tocantins</option>
																				 
																			</select>
								

								</div>
							</div>

							<div class="form-row">
								<div class="col-md-6">
									<div class="position-relative form-group">
										<label for="TELEFONE">Telefone</label>
										<input name="TELEFONE" id="TELEFONE" PlaceHolder="Telefone" type="text" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="position-relative form-group">
										<label for="FAX">Fax</label>
										<input name="FAX" id="FAX" PlaceHolder="Fax" type="text" class="form-control">
									</div>
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