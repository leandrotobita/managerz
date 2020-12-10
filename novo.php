<?php date_default_timezone_set('America/Sao_Paulo');
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
	<!doctype html>
	<html lang="en">


	<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Language" content="en">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Manager Z - Nova solicitação</title>
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
										<i class="pe-7s-help2 icon-gradient bg-mean-fruit"></i>
									</div>
									<div>Nova solicitação
										<div class="page-title-subheading">Preencha o formulário corretamente.</div>
									</div>
								</div>
								 
							</div>
						</div>








						<div class="row">
							<form action="novoOK.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">

								<div class="col-md-12 col-lg-7">
									<div class="main-card mb-3 card">
										<div class="card-body">
											<div id="smartwizard2" class="forms-wizard-alt">
												<ul class="forms-wizard">
													<li>
														<a href="#step-12">
                                                            <em>1</em><span>Dados do solicitante</span>
                                                        </a>
													
													</li>
													<li>
														<a href="#step-22">
                                                            <em>2</em><span>Informações sobre a solicitação</span>
                                                        </a>
													
													</li>
													<li>
														<a href="#step-32">
                                                            <em>3</em><span>Finalizar</span>
                                                        </a>
													
													</li>

												</ul>
												<div class="form-wizard-content">
													<div id="step-12">
														<div class="form-row">
															<div class="col-md-6">
																<div class="position-relative form-group">
																	<label for="Nome">Nome</label>
																	<input name="SolicitanteNome" id="SolicitanteNome" placeholder="Nome do solicitante" type="text" class="form-control">
																</div>
															</div>
															<div class="col-md-6">
																<div class="position-relative form-group">
																	<label for="SolicitanteTelefone">Telefone <small>(ex: 17 9123-4567)</small></label>
																	<input name="SolicitanteTelefone" id="SolicitanteTelefone" placeholder="Telefone" type="text" class="form-control">
																</div>
															</div>
														</div>
														<div class="form-row">
															<div class="col-md-6">
																<div class="position-relative form-group">
																	<label for="Nome">Cargo</label>
																	<input name="SolicitanteCargo" id="SoicitanteCargo" placeholder="Cargo" type="text" class="form-control">
																</div>
															</div>
															<div class="col-md-6">
																<div class="position-relative form-group">
																	<label for="SolicitanteEmail">E-mail</label>
																	<input name="SolicitanteEmail" id="SolicitanteEmail" placeholder="E-mail" type="email" class="form-control">
																</div>
															</div>
														</div>
														<div class="form-row">
															<div class="col-md-6">
																<div class="position-relative form-group">
																	<label for="SolicitanteCidade">Cidade</label>
																	<input name="SolicitanteCidade" id="SolicitanteCidade" type="text" class="form-control"  placeholder="Cidade" >
																</div>
															</div>
															<div class="col-md-4">
																<div class="position-relative form-group">
																	<label for="exampleState">Estado</label>
																	<select id="SolicitanteEstado" name="SolicitanteEstado"  class="form-control" >
																		<option>Selecione ... </option>
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
    <option value="EX">Estrangeiro</option>
</select>
																</div>
															</div>
															<div class="col-md-2">
																<div class="position-relative form-group">
																	<label for="SolicitanteCEP">CEP</label>
																	<input name="SolicitanteCEP" id="SolicitanteCEP" type="text" class="form-control"  placeholder="Ex: 15105000" >
																</div>
															</div>
														</div>

													</div>
													<div id="step-22">
														<div id="accordion" class="accordion-wrapper mb-3">
															<div class="card">
																<div id="headingTwo" class="b-radius-0 card-header">
																	<button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
                                                                        <span class="form-heading">Detalhes da solicitação<p>Preencha corretamente o formulário</p></span>
                                                                    </button>
																
																</div>
																<div data-parent="#accordion" id="collapseTwo" class="collapse show">
																	<div class="card-body">

																		<div class="position-relative form-group">
																			<label for="OSDescricao">Descrição</label>
																			<input name="OSDescricao" id="OSDescricao" placeholder="ex: trocar a lâmpada do provador" type="text" class="form-control">
																		</div>
																		<div class="position-relative form-group">
																			<label for="OSCategoria">Categoria</label>
																			<select class="mb-2 form-control" name="OSCategoria" id="select-fixo">
																				<option>Selecione uma categoria</option>
																				
																				<?php foreach ($BuscaCategoriaROW_SoliCatId as $index => $value ) { ?>
																				<option value="<?php echo $BuscaCategoriaROW_SoliCatId[$index]?>"><?php echo $BuscaCategoriaROW_SoliCatDescricao[$index]?></option>
																				<?php } ?>
																				
																				
																				
																				
																			</select>
																		</div>
																		<div class="position-relative form-group">
																			<label for="OSTipo">Tipo</label>
																			<select class="mb-2 form-control" name="OSTipo" id="select-dinamico">
																				<option selected>Selecione um tipo</option>
																				 
																			</select>
																		</div>
																		<script>

// Objeto do mapeamento Dinamicamente fixo
var membrosTime = {
  
	<?php foreach ($BuscaCategoriaROW_SoliCatId as $index => $value ) { ?>
	<?php echo $BuscaCategoriaROW_SoliCatId[$index]?> : [
	
	<?php
		$BuscaTipoSQL = "SELECT SoliTipoId, SoliTipoDescricao, SoliTipoAtivado, SoliTipoCat, solicategoria.SoliCatDescricao FROM solitipo 

LEFT JOIN solicategoria on solicategoria.SoliCatId = solitipo.SoliTipoCat WHERE  SoliTipoCat = '".$BuscaCategoriaROW_SoliCatId[$index]."'";

	$BuscaTipoRES = mysqli_query( $connect, $BuscaTipoSQL );

	if ( mysqli_num_rows( $BuscaTipoRES ) > 0 ) {






		while ( $BuscaTipoROW = mysqli_fetch_array( $BuscaTipoRES ) ) {



			 
			 echo "'".$BuscaTipoROW[ "SoliTipoDescricao" ]."',";
			 



		}

	}
		
		
		?>
	
	
	
	]	,
	
	
	<?php } ?>
}

//Adicionando Evento On Change
document.querySelector('#select-fixo').addEventListener("change", function(){

// Pegando valores do Objeto
var membros = membrosTime[this.value];
  
//Limpando Select
var selectDinamico = document.querySelector('#select-dinamico');
selectDinamico.innerHTML = '';

//Populando Select com membros
membros.forEach(function(membro){
    var option  = document.createElement("option");
    option.value = membro;
    option.text = membro;
    selectDinamico.appendChild(option);
  });
});
	
	
	
</script>
																		
																		
																		
																		<div class="position-relative form-group">
																			<label for="OSEmpresa">Empresa</label>
																			<select name="OSEmpresa" id="OSEmpresa"   class="form-control">
																			<option>Selecione...</option>
																			<?php foreach ($BuscaEmpresas_GZ_EMPRESA_ID as $index => $value ) { ?>
																			<option value="<?php echo $BuscaEmpresas_GZ_EMPRESA_ID[$index];?>"><?php echo $BuscaEmpresas_FANTASIA[$index]; ?></option>
																			<?php } ?>
																			</select>
																		</div>
																		 


																	</div>
																	<div class="card-body">
                            <h5 class="card-title">Descrição da solicitação</h5>
                            <textarea name="OScontent" id="editor" >
                                
            
                                
                        </textarea>
                        </div>
																	  
																</div>
															</div>
														</div>
													</div>
													<div id="step-32">
														<div class="no-results">





															<div class="results-title">Clique em "Enviar solicitação" para terminar.</div>
															<div class="mt-3 mb-3"></div>
															<div class="text-center">
																<button class="btn-shadow btn-wide btn btn-success btn-lg" type="submit" name="submit" id="submit">Enviar solicitação</button>
															</div>


														</div>
													</div>
												</div>
											</div>
											<div class="divider"></div>
											<div class="clearfix">
												<button type="button" id="reset-btn2" class="btn-shadow float-left btn btn-link">Voltar do início</button>
												<button type="button" id="next-btn2" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">Continuar</button>
												<button type="button" id="prev-btn2" class="btn-shadow float-right btn-wide btn-pill mr-3 btn btn-outline-secondary">Voltar</button>
											</div>
										</div>
									</div>
								</div>


							</form>
						</div>
					</div>





					<?php include "z_rodape.php";?>





				</div>
			</div>
		</div>


		<?php include "z_direita.php";?>



	</body>


	</html>
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('OScontent');
</script>


	<?php

} else {

	?>

	<script>
		window.location = "index.php";
	</script>

	<?php } ?>