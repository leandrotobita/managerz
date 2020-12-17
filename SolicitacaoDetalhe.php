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
	if ( isset($_GET["x"]) ) {

				// aprova
				$aprova = "UPDATE gz_solicitacoes SET AprovadoReprovado = '".$_GET['x']."' WHERE SoliId = '" . $_GET[ 'sol' ] . "'";
				mysqli_query( $connect, $aprova );
		
		?>
<script>
			window.location = "SolicitacaoDetalhe.php?sol=<?php echo  $_GET['sol']; ?>"
		</script><strong></strong>
<?php

	}

?>








<?php // ADICONO UM ORÇAMENTO


			if ( isset( $_POST[ "orcamento_form" ] ) ) {

				$SQL_add_tarfa = "INSERT  INTO orcamento

(
OrcSoli,
OrcData,
OrcQuemCriou,
OrcAprovadoReprovado,
OrcTitulo,
OrcDestino

)
VALUES
(
'" . $_POST[ 'solicitacao_id' ] . "',
NOW(),
'" . $login_cookie . "',
'Pendente',
'" . $_POST[ 'OrcTitulo' ] . "',
'" . $_POST[ 'OrcDestino' ] . "'

)";



				mysqli_query( $connect, $SQL_add_tarfa );
				 $last_id = mysqli_insert_id($connect);
				 

				$SQL_add_historico = "
	
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
	(SELECT max(OrcId) as OrcId FROM gz_cmms.orcamento),
	'" . $_POST[ 'solicitacao_id' ] . "',
	CONCAT('Orcamento n°', (SELECT max(OrcId) as OrcId FROM gz_cmms.orcamento), 'criado.'),
	NOW(),
'" . $login_cookie . "'
)
	
	
	";

				mysqli_query( $connect, $SQL_add_historico );

				?>
				<script>
					window.location = "Orcamento.php?sol=<?php echo  $_POST['solicitacao_id']; ?>&orc=<?php echo $last_id;?>"
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



	<?php // foto upload

	if ( isset( $_POST[ "action" ] ) && $_POST[ "action" ] == "submit" ) {
		?>

 
		<?php // grava foto  


		$foto = $_FILES[ 'foto' ][ 'name' ];

		if ( $foto != "" ) {
			$source = $_FILES[ 'foto' ][ 'tmp_name' ];
			$target = "cmms_manager_fotosX/" . $foto;
			move_uploaded_file( $source, $target );
			$imagepath = $foto;
			$save = "cmms_manager_fotosX/" . $imagepath; //This is the new file you saving
			$file = "cmms_manager_fotosX/" . $imagepath; //This is the original file



		}


		$SQL_EnviaFoto = "insert into gz_fotos

																										(
																										fotodescricao,
																										fotosolicitacao,
																										fotodata,
																										fotologin
																										)
																										values
																										(
																										'" . $foto . "',
																										'" . $_POST[ 'solicitacao_id' ] . "',
																										NOW(),
																										'" . $login_cookie . "'
																										
																										)
																										";
		mysqli_query( $connect, $SQL_EnviaFoto );


$SQL_adicionafoto_historico = "
	
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
	'<b>Adicionado à galeria: </b> ".$foto." ',
	NOW(),
'" . $login_cookie . "'
)
	
	
	";

			mysqli_query( $connect, $SQL_adicionafoto_historico );

		?>




		<script>
			window.location = "SolicitacaoDetalhe.php?sol=<?php echo  $_POST['solicitacao_id']; ?>"
		</script>
		<?php	}  ?>






<?php // UTILIZAR UM MATERIAL


		if ( isset( $_POST[ "utilizarmaterial" ] ) ) {
			
			// saida no estoque
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
				MatControle,
				MatSolicitacao
				)
				VALUES
				(
				'".$_POST['produto_selecionado']."',
				'U',
				'S',
				NOW(),
				'".$login_cookie."',
				'-".$_POST['QTDE']."',
				'',
				'',
				'".$_POST['solicitacao_id']."'
				)
				";
				mysqli_query( $connect, $SQL_entradamaterial ) ;
			?>

			 
			 
			 


			<?php




			$SQL_add_historico_addmat = "
	
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
	'<b>Saída de</b> ".$_POST['produto_selecionado']." <b>Qtde</b>: ".$_POST['QTDE']."',
	NOW(),
'" . $login_cookie . "'
)
	
	
	";

			mysqli_query( $connect, $SQL_add_historico_addmat );

			?>


			<script>
				window.location.href = "SolicitacaoDetalhe.php?&sol=<?php echo $_POST['solicitacao_id']; ?>"
			</script>


			<?php } ?>


















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

			$APROVA_REPROVA = $_GET[ "z" ];

			if ( $APROVA_REPROVA != '' ) {

				$APROVA_REPROVASQL = "
			
			UPDATE gz_tarefas SET TarefaStatus = '".$_GET['z']."' WHERE TarefaId = '" . $_GET['i'] . "'
			
			";

				mysqli_query( $connect, $APROVA_REPROVASQL );





				// grava no hostiro a alteraçao
				$SQL_add_historico00 = "
	
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
	'" . 'A tarefa <b>' . $_GET[ "f" ] . '</b> foi '.  "finalizada.". "',
	NOW(),
'" . $login_cookie . "'
)
	
	
	";

				mysqli_query( $connect, $SQL_add_historico00 );

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


				$SQL_add_historico = "
	
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
	(SELECT max(TarefaId) as TarefaId FROM gz_cmms.gz_tarefas),
	'" . $_POST[ 'solicitacao_id' ] . "',
	'" . 'UM ESPECIALISTA PRECISA SER CHAMADO: <b>' . $_POST[ 'ESPECIALISTA' ] . '</b> .' . "',
	NOW(),
'" . $login_cookie . "'
)
	
	
	";

				mysqli_query( $connect, $SQL_add_historico );

				?>
				<script>
					window.location = "SolicitacaoDetalhe.php?sol=<?php echo  $_POST['solicitacao_id']; ?>"
				</script>
				<?php

			}
			?>





			<?php // Adicionando uma tarefa em uma solicitação.  


			if ( isset( $_POST[ "adicionartarefa" ] ) ) {

				// atualiza o status da solicitação ini
				$SQL_AlteraSTATUS_SOLICITACAO = "UPDATE gz_solicitacoes SET Status = '2' WHERE SoliId = '" . $_POST[ 'solicitacao_id' ] . "'";
				mysqli_query( $connect, $SQL_AlteraSTATUS_SOLICITACAO );

				// atualiza o status da solicitacao 


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
'" . $_POST[ 'TAREFA' ] . "',
'01 - criado',
'" . $login_cookie . "'
)";





				mysqli_query( $connect, $SQL_add_tarfa );


				$SQL_add_historico = "
	
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
	(SELECT max(TarefaId) as TarefaId FROM gz_cmms.gz_tarefas),
	'" . $_POST[ 'solicitacao_id' ] . "',
	'" . 'a tarefa <b>' . $_POST[ 'TAREFA' ] . '</b> foi criada.' . "',
	NOW(),
'" . $login_cookie . "'
)
	
	
	";

				mysqli_query( $connect, $SQL_add_historico );

				?>
				<script>
					window.location = "SolicitacaoDetalhe.php?sol=<?php echo  $_POST['solicitacao_id']; ?>"
				</script>
				<?php

			}



			?>
			<?php
			//todas as solicitações

			$SolicitacoesSQL = "
	SELECT 
SoliId,
SoliNome,
SoliTelefone,
SoliEmpresa,
gz_empresas.FANTASIA as SoliDescempresa,
SoliCargo,
SoliEmail,
Solicidade,
SoliEstado,
OSDescricao,
OSCategoria,
solicategoria.SoliCatDescricao as Categoria,
OSTipo,
OSLocal,
OSVencimento,
OSObs,
OSPrioridade,
DATE_FORMAT(DataCadastro,'%d/%m/%Y') as DATACADASTRO,
TIME_FORMAT(DataCadastro,'%H:%m:%s') as HORACADASATRO,
UsuarioLogado,
IpUsuario,
`Status`  ,
AprovadoReprovado
 FROM gz_solicitacoes

LEFT JOIN solicategoria on solicategoria.SoliCatId = gz_solicitacoes.OSCategoria
LEFT JOIN gz_empresas on gz_empresas.GZ_EMPRESA_ID = gz_solicitacoes.SoliEmpresa

WHERE SoliId = '" . $_GET[ 'sol' ] . "'
	";

			?>
			<?php
			//todas TAREFAS do banco

			$ListaTarefasSQL = "
	SELECT TarefaId, TarefaDataCadastro, TarefaSolicitacao, TarefaTitulo, TarefaStatus, TarefaCriou, TarefaOrcamento, TarefaOrcamentoValor, TarefaOrcamentoAprovarReprovar  FROM gz_tarefas WHERE TarefaSolicitacao = '" . $_GET[ 'sol' ] . "' ORDER BY TarefaId DESC
 
	";

			$ListaTarefasRES = mysqli_query( $connect, $ListaTarefasSQL );
			 

			if ( mysqli_num_rows( $ListaTarefasRES ) > 0 ) {


				while ( $ListaTarefasROW = mysqli_fetch_array( $ListaTarefasRES ) ) {






					$TarefaId[] = $ListaTarefasROW[ "TarefaId" ];
					$TarefaDataCadastro[] = $ListaTarefasROW[ "TarefaDataCadastro" ];
					$TarefaSolicitacao[] = $ListaTarefasROW[ "TarefaSolicitacao" ];
					$TarefaTitulo[] = $ListaTarefasROW[ "TarefaTitulo" ];
					$TarefaStatus[] = $ListaTarefasROW[ "TarefaStatus" ];
					$TarefaCriou[] = $ListaTarefasROW[ "TarefaCriou" ];
					$AprovadoReprovado[] = $ListaTarefasROW[ "AprovadoReprovado" ];
					$TarefaOrcamento[]  = $ListaTarefasROW[ "TarefaOrcamento" ];
					$TarefaOrcamentoValor[]  = $ListaTarefasROW[ "TarefaOrcamentoValor" ];
					$TarefaOrcamentoAprovarReprovar[]  = $ListaTarefasROW[ "TarefaOrcamentoAprovarReprovar" ];
					
					
					
					
					


				}

			}

			?>

			<?php // LISTA histórico da solicitacao

			$ListaHistoricoSQL = "
	select historicoId, historico_tarefa, historico_solicitacao, historico_descricao, historico_datainserida, historico_login from gz_historico WHERE historico_solicitacao = '" . $_GET[ 'sol' ] . "' ORDER BY historicoId DESC
 
	";

			$ListaHistoricoREST = mysqli_query( $connect, $ListaHistoricoSQL );
			 

			if ( mysqli_num_rows( $ListaHistoricoREST ) > 0 ) {


				while ( $ListaHistoricoROW = mysqli_fetch_array( $ListaHistoricoREST ) ) {






					$historicoId[] = $ListaHistoricoROW[ "historicoId" ];
					$historico_tarefa[] = $ListaHistoricoROW[ "historico_tarefa" ];
					$historico_solicitacao[] = $ListaHistoricoROW[ "historico_solicitacao" ];
					$historico_descricao[] = $ListaHistoricoROW[ "historico_descricao" ];
					$historico_datainserida[] = $ListaHistoricoROW[ "historico_datainserida" ];
					$historico_login[] = $ListaHistoricoROW[ "historico_login" ];


				}

			}

			?>

			<?php // listo as fotos cara!! 

			$FotosSQL = "SELECT fotoid, fotodescricao, REPLACE(right(fotodescricao,4),'.','') as fotoext, fotosolicitacao, fotodata, fotologin FROM gz_fotos   WHERE fotosolicitacao = '" . $_GET[ 'sol' ] . "'";
			$FotosRES = mysqli_query( $connect, $FotosSQL );
			 

			if ( mysqli_num_rows( $FotosRES ) > 0 ) {


				while ( $FotoROW = mysqli_fetch_array( $FotosRES ) ) {


					$fotoid[] = $FotoROW[ "fotoid" ];
					$fotodescricao[] = $FotoROW[ "fotodescricao" ];
					$fotosolicitacao[] = $FotoROW[ "fotosolicitacao" ];
					$fotodata[] = $FotoROW[ "fotodata" ];
					$fotologin[] = $FotoROW[ "fotologin" ];
					$fotoext[] = $FotoROW[ "fotoext" ];


				}
			}





			?>
			<!doctype html>
			<html lang="en">


			<meta http-equiv="content-type" content="text/html;charset=UTF-8"/ <meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta http-equiv="Content-Language" content="pt-br">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<title>Manager Z - Detalhes da solicitação</title>
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
							<?php 
					 
					 	
$SolicitacoesRES = mysqli_query( $connect, $SolicitacoesSQL );
		 
	if ( mysqli_num_rows( $SolicitacoesRES ) > 0 ) {
		while ( $SolicitacoesROW = mysqli_fetch_array( $SolicitacoesRES ) ) {


$SoliStatuss   = $SolicitacoesROW["Status"];

$SoliId        = $SolicitacoesROW["SoliId"];	
$SoliNome      = $SolicitacoesROW["SoliNome"];      
$SoliTelefone  = $SolicitacoesROW["SoliTelefone"];
$SoliEmpresa   = $SolicitacoesROW["SoliEmpresa"];
$SoliCargo     = $SolicitacoesROW["SoliCargo"];
$SoliEmail     = $SolicitacoesROW["SoliEmail"];
$Solicidade    = $SolicitacoesROW["Solicidade"];
$SoliEstado    = $SolicitacoesROW["SoliEstado"];
$OSDescricao   = $SolicitacoesROW["OSDescricao"];
$OSCategoria   = $SolicitacoesROW["OSCategoria"];
$Categoria     = $SolicitacoesROW["Categoria"];
$OSTipo        = $SolicitacoesROW["OSTipo"];
$OSLocal       = $SolicitacoesROW["OSLocal"];
$OSVencimento  = $SolicitacoesROW["OSVencimento"];
$OSObs         = $SolicitacoesROW["OSObs"];
$OSPrioridade  = $SolicitacoesROW["OSPrioridade"];
$DataCadastro  = $SolicitacoesROW["DATACADASTRO"];
$HoraCadastro  = $SolicitacoesROW["HORACADASATRO"];
$UsuarioLogado = $SolicitacoesROW["UsuarioLogado"];
$IpUsuario     = $SolicitacoesROW["IpUsuario"];
$SoliDescempresa = $SolicitacoesROW["SoliDescempresa"];			
			$AprovadoReprovado2 = $SolicitacoesROW["AprovadoReprovado"];	

					 
					 ?>


							<div class="app-main__inner">





								<div class="app-page-title">
									<div class="page-title-wrapper">
										<div class="page-title-heading">
											<div class="page-title-icon">
												<i class="pe-7s-help2 icon-gradient bg-mean-fruit"></i>
											</div>
											<div>Solicitação #<?php echo sprintf('%04d', $SoliId);?><br>
												<?php echo $SoliDescempresa ; ?>
												<div class="page-title-subheading">Categoria:
													<?php echo $Categoria; ?><br>Tipo:
													<?php echo $OSTipo; ?>
													 
												</div>
											</div>

										</div>
										<div class="page-title-actions">


											<style>
												[type="file"] {
													height: 0;
													overflow: hidden;
													width: 0;
												}
												
												[type="file"]+ label {}
											</style>

 
											
											
											 
											 
											
											
											<form action="SolicitacaoDetalhe.php?sol=<?php echo $_GET["sol"]; ?>" method="post" enctype="multipart/form-data" name="formfoto" id="formfoto" title="formfoto">
												
												
												
												<input type="hidden" name="action" value="submit"/>
												<input type="file" id="file" name="foto"/>
												<label for="file" name="foto" class="btn-shadow mr-3 btn btn-gradient-danger" style="margin-top:8px;"/> <i class="pe-7s-photo"></i> Foto +</label>
												<input type="hidden" name="solicitacao_id" value="<?php echo $_GET["sol"]; ?>">




												<a href="novo.php"> <button type="button" data-toggle="tooltip"   data-placement="bottom"
                                    class="btn-shadow mr-3 btn btn-gradient-success">
                                    <i class="pe-7s-plus"></i> Nova
                                </button></a>
											

         

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
                                                            <i class="nav-link-icon lnr-pushpin"></i>
                                                            <span> Adicionar tarefa</span>
                                                         </a>
															

															</li>
															
															<li class="nav-item">
																<a class="nav-link" data-toggle="modal" data-target="#Budget">
                                                            <i class="nav-link-icon pe-7s-cash"></i>
                                                            <span> Criar orçamento</span>
                                                         </a>
															

															</li>
															
															
															<li class="nav-item">
																<a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                                                            <i class="nav-link-icon lnr-mustache" ></i>
                                                            <span> Especialista</span>
                                                         </a>
															



															</li>
															 
															<li class="nav-item">
																<a class="nav-link" data-toggle="modal" data-target="#FotoAddModal">
                                                            <i class="nav-link-icon pe-7s-box2"></i>
                                                            <span> Utilizar material do estoque</span>
                                                        </a>
															

															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="modal" data-target=".bd-example-modal-sm">
                                                            <i class="nav-link-icon lnr-checkmark-circle"></i>
                                                            <span> Finalizar solicitação</span>
                                                        </a>
															




															</li>
														</ul>
													</div>
												</div>
												<?php } ?>
											
											 

												<?// MOSTRA O MENU DE AÇÕES APENAS PARA O NIVEL PROFISSIONAL ?>


											</form>
											<script>
												document.getElementById( "file" ).onchange = function () {
													document.getElementById( "formfoto" ).submit();
												};
											</script>

 
 




										</div>
									</div>







								</div>
   

								<?php if ($SoliStatuss =='1') { ?>

								<div class="alert alert-primary fade show" role="alert">Nova solicitação. </div>

								<?php } else if ($SoliStatuss =='2') { ?>

								<div class="alert alert-warning fade show" role="alert">Solicitação em andamento... </div>

								<?php } else if ($SoliStatuss =='3') { ?>

								<div class="alert alert-success fade show" role="alert">Solicitação finalizada. </div>

								<?php } ?>


							
								<?php // Nesta parte eu vou fazer a contagem de orçcamento para a solicitação escolhida. ?>
								
								
								<?php
			// aqui eu faço a contatem
			
			 
$QTDE_VENDAS_ULTIMOANO_SQL = "select OrcId, count(OrcId) as ORC_QTDE from orcamento where OrcSoli = '".$_GET['sol']."'";
$QTDE_VENDAS_ULTIMOANO_RES = mysqli_query($connect, $QTDE_VENDAS_ULTIMOANO_SQL);
if (mysqli_num_rows($QTDE_VENDAS_ULTIMOANO_RES) > 0) { while ($QTDE_VENDAS_ULTIMOANO_ROW = mysqli_fetch_array($QTDE_VENDAS_ULTIMOANO_RES)) {$QTDE_VENDAS_ULTIMOANO = $QTDE_VENDAS_ULTIMOANO_ROW["ORC_QTDE"];  }}

			
			
			 

	 
			?>
								
								
   

							 

								<div class="alert alert-info fade show" role="alert">
							
							<a href="OrcamentoLista.php?sol=<?php echo $_GET['sol']; ?>"><?php echo $QTDE_VENDAS_ULTIMOANO; ?> orçamentos</a>
							
							
							</div>
							
							
							
								<div class="row">


									<div class="col-lg-24 col-xl-12">

										<div class="card mb-3 widget-content">
											<div class="widget-content-outer">
												<div class="widget-content-wrapper">
													<div class="widget-content-left">

														<div class="widget-heading" style="font-size: 18px;"></div>
														<div class=" timeline-title" style="padding: 5px; color:black; font-weight: normal;">

															<h4>
																<?php echo $OSDescricao; ?>
															</h4>


															<?php echo $OSObs ; ?>

														</div>
													</div>
													
												

												</div>
												
													


												<div class="widget-progress-wrapper ">

													<div class="">
														<div class=" "> Criado por
															<b class="text-primary">
																<?php echo $SoliNome; ; ?>/
																<?php echo $SoliCargo ; ?>
															</b>
															<Br>em <b class="text-primary"><?php echo date('d/m/Y', strtotime($DataCadastro));?> </b> às <b class="text-primary"><?php echo date('H:m:s', strtotime($DataCadastro));?></b><br>

															<i class="ion-android-call"></i>
															<?php echo $SoliTelefone ; ?> <br>
															<i class="lnr-envelope"></i>
															<?php echo $SoliEmail ; ?> <br>
															<i class="lnr-apartment"></i>
															<?php echo $Solicidade ; ?>/
															<?php echo $SoliEstado ; ?> <br> Vence em:
															<b class="text-primary">
																<?php echo date('d/m/Y', strtotime($OSVencimento));?> </b>





														</div>
														<div class="sub-label-right">



												</div>
															
											</div>

 
														
														
														
														
													<div>

														</div>


												 

										</div>



									</div>


								</div>
											
										</div></div>
									
									<div class="row">
										 <div class="col-md-12">
											 
											 
											 
											 
											 
											 
									<div class="main-card mb-3 card">
                                    <div class="card-body">
                                         
                                        <div class="collapse" id="collapseExample123">
											
											<div> 
                                            <?php  foreach ($fotoid as $index2 => $value) { ?>
													 
														 

															<?php if($fotoext[$index2] == "docx" || $fotoext[$index2] == "doc" || $fotoext[$index2] == "xlsx" || $fotoext[$index2] == "xls" || $fotoext[$index2] == "pdf" || $fotoext[$index2] == "txt" || $fotoext[$index2] == "csv"        ) { ?>

															<a href="cmms_manager_fotosX/<?php echo $fotodescricao[$index2]?>" target="_blank">
															
															
															<small><?php echo $fotodescricao[$index2]?></small> </a>


														




															<?php } else { ?>
												
												 <div class="avatar-icon-wrapper">
                                                 
                                                <div class="avatar-icon">
                                                   <a href="cmms_manager_fotosX/<?php echo $fotodescricao[$index2]?>" target="_blank"><img src="cmms_manager_fotosX/<?php echo $fotodescricao[$index2]?>"  height="200px"></a>
                                                </div>
                                            </div>
												
															
															<?php } ?>

														 
													 
													<?php } ?>
											</div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" data-toggle="collapse" href="#collapseExample123" class="btn btn-primary">Visualizar documentos e imagens</button>
                                    </div>
                                </div>
										</div>
									</div>

								 

								<div class="row">
									<div class="col-lg-12 col-xl-6">

										<div class="main-card mb-3 card">
											<A name="todo"></A>
											<div class="card-header">Tarefas à fazer</div>
											<ul class="todo-list-wrapper list-group list-group-flush">



												<?php 
												// --- Tarefas à fazer 
												// Listagem das tarefas.      
												?>


												<?php  foreach ($TarefaId as $index => $value) { ?>

												<li class="list-group-item" 
													
													
													
													<?php if ($TarefaStatus[$index]=="02 - feito" ) { ?>
													style="background-color:seagreen; color:palegreen;"
													<?php } else  if ($TarefaStatus[$index] == "01 - criado")  { ?>

													<?php } ?> >
													<div class="todo-indicator bg-focus"></div>
													<div class="widget-content p-0">
														<div class="widget-content-wrapper">

															<div class="widget-content-left">
																<div class="widget-heading">
																	<?php echo $TarefaTitulo[$index];?>  <?php echo $TarefaOrcamentoValor[$index];?>
																</div><?php if ($TarefaOrcamentoAprovarReprovar[$index] == "APROVADO") {   ?>
																	
																	<small style="color:blue;">APROVADO</small>
																	
																	<?php } else if ($TarefaOrcamentoAprovarReprovar[$index] == "REPROVADO") {  ?><small style="color:darkred;">NÃO APROVADO</small> <?php }  else {} ?>
																<div class="widget-subheading">
																	<div>por
																		<?php echo $TarefaCriou[$index];?> em

																		<?php echo date('d/m/Y', strtotime($TarefaDataCadastro[$index]));?> as

																		<?php echo date('H:m:s', strtotime($TarefaDataCadastro[$index]));?>



																		<?php if (date('d/m/Y') ==  date('d/m/Y', strtotime($TarefaDataCadastro[$index])) ) {?>
																		<div class="badge badge-pill badge-info ml-2">Novo</div>
																		<?php } else { }?>



																	</div>
																</div>
															</div>

															<?php if ($TarefaStatus[$index] == "01 - criado") { ?>
															<div class="widget-content-right widget-content-actions">
																<div class="d-inline-block dropdown">
																	<button type="button" aria-haspopup="true" data-toggle="dropdown" aria-expanded="false" class="border-0 btn-transition btn btn-link">
                                                                        <i class="fa fa-ellipsis-h"></i>
                                                                    </button>
																

																	<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-lg dropdown-menu">

																		<div class="dropdown-menu-header">
																			<div class="dropdown-menu-header-inner bg-primary">
																				<div class="menu-header-image" style="background-image: url('assets/images/dropdown-header/abstract1.jpg');"></div>
																				<div class="menu-header-content">
																					<div>
																						 
																					 
																						
																						<h5 class="menu-header-title">Finalizar Tarefa</h5>
																						<h6 class="menu-header-subtitle"><b><?php echo $TarefaTitulo[$index];?></b> ?</h6>
																						 
																					</div>

																				</div>
																			</div>
																		</div>


 
																		
																	

 
													
	
	
	 
	
	
	 
	
	
	<a href="SolicitacaoDetalhe.php?sol=<?php echo $TarefaSolicitacao[$index]; ?>&i=<?php echo $TarefaId[$index]; ?>&f=<?php echo $TarefaTitulo[$index]; ?>&z=02 - feito">
																		<button type="button" tabindex="0" class="dropdown-item"  >Finalizar</button>
																			</a>
	
	 
	
	
	
	
	
	
	
																		 


																	</div> 
																		
																		 



																</div>
															</div>
															<?php } else { } ?>

														</div>
													</div>
												</li>

												<?php } ?>

												<?php
												// --- Fim das listagens.
												?>

											</ul>

										</div>

									</div>

									<div class="col-lg-12 col-xl-6">
										<div class="main-card mb-3 card">
											<div class="card-body">


												<h5 class="card-title">Andamento da solicitação.</h5>

												<div class="vertical-time-icons vertical-timeline vertical-timeline--animate vertical-timeline--one-column">


													<?php  foreach ($historicoId as $index => $value) { ?>

													<div class="vertical-timeline-item vertical-timeline-element">
														<div>
															<div class="vertical-timeline-element-icon bounce-in">
																<div class="timeline-icon border-primary">
																	<i class="lnr-license icon-gradient bg-night-fade"></i>
																</div>
															</div>
															<div class="vertical-timeline-element-content bounce-in">
																<?php echo $historico_descricao[$index];?>
																<p>em

																	<a href="javascript:void(0);">
																		<?php echo date('d/m/Y', strtotime($historico_datainserida[$index]));?>
																	</a> as


																	<a href="javascript:void(0);">
																		<?php echo date('H:m:s', strtotime($historico_datainserida[$index]));?>
																	</a> por <a href="javascript:void(0);">
																		<?php echo  $historico_login[$index];?>
																	</a>
																</p>
															</div>
														</div>
													</div>

													<?php } ?>




												</div>
											</div>
										</div>


									</div>
								</div>
							</div>


							<?php } } ?>


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
								
								<div class="form-row">
									
									
									  <div class="col-md-12">
                    <div class="position-relative form-group">
							<input name="OrcDestino" id="OrcDestino" type="text" class="form-control" value="<?php echo $SoliDescempresa ; ?>" readonly>
					</div>
									</div>
									
	                <div class="col-md-12">
                    <div class="position-relative form-group">
							<input name="OrcTitulo" id="OrcTitulo" type="text" class="form-control" placeholder="Orçamento de?" >
					</div>
									</div>
								
								
								
								
								
								
								
								</div>
								 
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