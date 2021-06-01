<?php date_default_timezone_set('America/Sao_Paulo');
session_start();
if ( isset($_COOKIE['login'] ) )
{
    $login_cookie = $_COOKIE['login'];;
}
else
{
    $_COOKIE['login'] = ' ';
}



    if(isset($login_cookie)){
		
	include "PermissoesUsuarios.php"
		
		
		
		
		
		
?>
<?php
// Altero os dados quando clico em salvar mnudardad
	
	
	if(isset($_POST["submit"])){
		
		
		 $INSERE_SOLICITACAO_SQL = "
		 INSERT INTO gz_solicitacoes  
		 
		 (
		 	SoliNome,
			SoliTelefone,
			SoliEmpresa,
			SoliCargo,
			SoliEmail,
			Solicidade,
			SoliEstado,
			OSDescricao,
			OSCategoria,
			OSTipo,
			OSLocal,
			OSVencimento,
			OSObs,
			OSPrioridade,
			DataCadastro,
			UsuarioLogado,
			IpUsuario,
			Status

		 ) VALUES (
		 
		 '".$_POST['SolicitanteNome']."',
		 '".$_POST['SolicitanteTelefone']."',
		 '".$_POST['OSEmpresa']."',
		 '".$_POST['SolicitanteCargo']."',
		 '".$_POST['SolicitanteEmail']."',
		 '".$_POST['SolicitanteCidade']."',
		 '".$_POST['SolicitanteEstado']."',
		 '".$_POST['OSDescricao']."',
		 '".$_POST['OSCategoria']."',
		 '".$_POST['OSTipo']."',
		 'LOCAL',
		 TIMESTAMP(DATE_add(NOW(), INTERVAL 5 day)),
		 '".$_POST['OScontent']."',
		 'zero',
		 NOW(),
		 '".$login_cookie."',
		 '".$_SERVER['REMOTE_ADDR']."',
		 '1'
		 
		 )";

	 mysqli_query( $connect, $INSERE_SOLICITACAO_SQL );
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
	'',
	(SELECT max(soliId) as soliId FROM gz_cmms.gz_solicitacoes),
	'Solicitação Criada',
	NOW(),
'".$login_cookie."'
)
	
	
	";
	
	mysqli_query( $connect, $SQL_add_historico ); 
		
		
		
	}
		
		
 
?>



 
				 
<!doctype html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Manager Z - Solicitação Enviada</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

<link href="main.d810cf0ae7f39f28f336.css" rel="stylesheet"></head>

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
				
				
            </div><div class="app-main__outer">
					 
					 
					 
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-help2 icon-gradient bg-mean-fruit"></i>
                                </div>
                                <div>Solicitação enviada
                                    <div class="page-title-subheading">Aguarde o andamento da sua solicitação.</div>
                                </div>
                            </div>
                              </div>
                    </div>       
					
					
					
					
					
					 
                    
					
					<div class="row">
						<form action="novo.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
                                 
                                <div class="col-md-12 col-lg-7">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <div id="x" class="forms-wizard-alt">
                                                <ul class="forms-wizard">
                                                     
													
                                                </ul>
                                                <div class="form-wizard-content">
                                                     
                                                     
                                                    <div id="step-12">
                                                        <div class="no-results">
                                                           
                                                            
															
															 
															 <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                                                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                                                <span class="swal2-success-line-tip"></span>
                                                                <span class="swal2-success-line-long"></span>
                                                                <div class="swal2-success-ring"></div>
                                                                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                                            </div>
															<div class="results-subtitle mt-4">Sua solicitação foi enviada com sucesso. </div>
															 
															
															
															<?php
															
															$SolicitanteNome	 = $_POST['SolicitanteNome'];
															$SolicitanteTelefone = $_POST['SolicitanteTelefone'];
															$SolicitanteCargo	 = $_POST['SolicitanteCargo'];
															$SolicitanteEmail	 = $_POST['SolicitanteEmail'];
															$SolicitanteCidade   = $_POST['SolicitanteCidade'];
															$SolicitanteEstado   = $_POST['SolicitanteEstado'];
															$SolicitanteCEP      = $_POST['SolicitanteCEP'];

															$OSDescricao		 = $_POST['OSDescricao'];
															$OSCategoria      	 = $_POST['OSCategoria'];
															$OSTipo              = $_POST['OSTipo'];
															$OSEmpresa			 = $_POST['OSEmpresa'];
															$OSPrioridade		 = $_POST['OSPrioridade'];
															$OScontent			 = $_POST['OScontent']
		
										

															
															
															?>
															
															 
															
															 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="clearfix">
                                                 <button type="button" id="next-btn2" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary" onclick="window.location='principal.php'">Continuar</button>
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



<?php

    }else{

?>

<script>window.location="index.php";</script>

<?php } ?>