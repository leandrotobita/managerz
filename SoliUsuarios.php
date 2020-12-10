<?php
session_start();
setlocale(LC_ALL,'pt_BR.UTF8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');
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
	// Busco todas os usuários do banco

	$usuarioSQL = "SELECT USR_ID, login, senha, NOMECOMPLETO, empresa, data_cadastro, FANTASIA, status, gerenciausuarios, gerenciacategoria, gerenciatipo, gerenciasolicitacoes, gerenciaempresas FROM usuarios

LEFT JOIN gz_empresas ON gz_empresas.GZ_EMPRESA_ID = usuarios.EMPRESA
LEFT JOIN gz_geral ON gz_geral.usuario = usuarios.USR_ID


 ";

	$usuarioRES = mysqli_query( $connect, $usuarioSQL );

	if ( mysqli_num_rows( $usuarioRES ) > 0 ) {






		while ( $usuarioROW = mysqli_fetch_array( $usuarioRES ) ) {



			$usuarioUSR_ID[] 	    = $usuarioROW[ "USR_ID" ];
			$usuariologin[] 		= $usuarioROW[ "login" ];
			$usuariosenha[] 		= $usuarioROW[ "senha" ];
			$usuarioNOMECOMPLETO[] 	= $usuarioROW[ "NOMECOMPLETO" ];
			$usuarioempresa[] 		= $usuarioROW[ "empresa" ];
			$usuarioFANTASIA[] 		= $usuarioROW[ "FANTASIA" ];
			$usuariodata_cadastro[] = $usuarioROW[ "data_cadastro" ];
			$usuariostatus[] 	 	= $usuarioROW[ "status" ];
			
			$USR_gerenciausuarios[]     = $usuarioROW[ "gerenciausuarios" ] ;
			$USR_gerenciacategoria[]    = $usuarioROW[ "gerenciacategoria" ] ; 
			$USR_gerenciatipo[] 	    = $usuarioROW[ "gerenciatipo" ];
			$USR_gerenciasolicitacoes[] = $usuarioROW[ "gerenciasolicitacoes" ];
			$USR_gerenciaempresas[]     = $usuarioROW[ "gerenciaempresas" ];
			 
			 



		}

	}

	?>

<?php
// Altero os dados quando clico em salvar
	
	
	if(isset($_POST["alterardados"])){
		
		
		 $AlteraCadastroSQL = "
		 UPDATE usuarios SET
		 
		 NOMECOMPLETO 	= '".$_POST['NOMECOMPLETO']."', 
		 status    	    = '".$_POST['STATUS']."'	
	
		 WHERE   USR_ID = '".$_POST['usuarioUSR_ID']."'";

	 mysqli_query( $connect, $AlteraCadastroSQL );
		
?>
<?php //CHECKBOX GERENCIA EMPRESAS
if (isset($_POST['gerenciaempresas']))
{
    foreach ($_POST['gerenciaempresas'] as $id => $v)
    {
        
       
		
		  mysqli_query($connect, "UPDATE gz_geral SET gerenciausuarios = '1' where usuario = '".$id."' ");
		
		
    }
} else {
	
	foreach ($_POST['gerenciaempresas'] as $id2 => $v2)
    {
        
       
		
		  mysqli_query($connect, "UPDATE gz_geral SET gerenciausuarios = '0' where usuario = '".$id2."' ");
		
		
    }
	
	
}

?>
<?php //CHECKBOX GERENCIA CATEGORIA
if (isset($_POST['gerenciacategoria']))
{
    foreach ($_POST['gerenciacategoria'] as $id => $v)
    {
         
       
		
		  mysqli_query($connect, "UPDATE gz_geral SET gerenciacategoria = '1' where usuario = '".$id."' ");
		
		
    }
} else {
	
	foreach ($_POST['gerenciacategoria'] as $id2 => $v2)
    {
        
       
		
		  mysqli_query($connect, "UPDATE gz_geral SET gerenciacategoria = '0' where usuario = '".$id2."' ");
		
		
    }
	
	
}

?>

<?php //CHECKBOX GERENCIA TIPO
if (isset($_POST['gerenciatipo']))
{
    foreach ($_POST['gerenciatipo'] as $id => $v)
    {
         
       
		
		  mysqli_query($connect, "UPDATE gz_geral SET gerenciatipo = '1' where usuario = '".$id."' ");
		
		
    }
} else {
	
	foreach ($_POST['gerenciatipo'] as $id2 => $v2)
    {
        
       
		
		  mysqli_query($connect, "UPDATE gz_geral SET gerenciatipo = '0' where usuario = '".$id2."' ");
		
		
    }
	
	
}

?>


<?php //CHECKBOX GERENCIA USUARIOS
if (isset($_POST['gerenciausuarios']))
{
    foreach ($_POST['gerenciausuarios'] as $id => $v)
    {
         
       
		
		  mysqli_query($connect, "UPDATE gz_geral SET gerenciausuarios = '1' where usuario = '".$id."' ");
		
		
    }
} else {
	
	foreach ($_POST['gerenciausuarios'] as $id2 => $v2)
    {
        
       
		
		  mysqli_query($connect, "UPDATE gz_geral SET gerenciausuarios = '0' where usuario = '".$id2."' ");
		
		
    }
	
	
}

?>


<?php //CHECKBOX GERENCIA SOLICITAÇÕES
if (isset($_POST['gerenciasolicitacoes']))
{
    foreach ($_POST['gerenciasolicitacoes'] as $id => $v)
    {
         
       
		
		  mysqli_query($connect, "UPDATE gz_geral SET gerenciasolicitacoes = '1' where usuario = '".$id."' ");
		
		
    }
} else {
	
	foreach ($_POST['gerenciasolicitacoes'] as $id2 => $v2)
    {
        
       
		
		  mysqli_query($connect, "UPDATE gz_geral SET gerenciasolicitacoes = '0' where usuario = '".$id2."' ");
		
		
    }
	
	
}

?>

<?php // gerenciausuarios
if (isset($_POST['gerenciausuarios'])) {	
$upd_gerenciausuarios = "UPDATE gz_geral SET gerenciausuarios = '1' where usuario = '".$_GET['id']."' "; mysqli_query($connect, $upd_gerenciausuarios); } else {
$upd_gerenciausuarios = "UPDATE gz_geral SET gerenciausuarios = '0' where usuario = '".$_GET['id']."' "; mysqli_query($connect, $upd_gerenciausuarios); } 
?>
<?php // gerenciacategoria
if (isset($_POST['gerenciacategoria'])) {	
$upd_gerenciacategoria = "UPDATE gz_geral SET gerenciacategoria = '1' where usuario = '".$_GET['id']."' "; mysqli_query($connect, $upd_gerenciacategoria); } else {
$upd_gerenciacategoria = "UPDATE gz_geral SET gerenciacategoria = '0' where usuario = '".$_GET['id']."' "; mysqli_query($connect, $upd_gerenciacategoria); } 
?>
<?php // gerenciatipo
if (isset($_POST['gerenciatipo'])) {	
$upd_gerenciatipo = "UPDATE gz_geral SET gerenciatipo = '1' where usuario = '".$_GET['id']."' "; mysqli_query($connect, $upd_gerenciatipo); } else {
$upd_gerenciatipo = "UPDATE gz_geral SET gerenciatipo = '0' where usuario = '".$_GET['id']."' "; mysqli_query($connect, $upd_gerenciatipo); } 
?>
<?php // gerenciasolicitacoes
if (isset($_POST['gerenciasolicitacoes'])) {	
$upd_gerenciasolicitacoes = "UPDATE gz_geral SET gerenciasolicitacoes = '1' where usuario = '".$_GET['id']."' "; mysqli_query($connect, $upd_gerenciasolicitacoes); } else {
$upd_gerenciasolicitacoes = "UPDATE gz_geral SET gerenciasolicitacoes = '0' where usuario = '".$_GET['id']."' "; mysqli_query($connect, $upd_gerenciasolicitacoes); } 
?>

<?php // gerenciaempresas
if (isset($_POST['gerenciaempresas'])) {	
$upd_gerenciaempresas = "UPDATE gz_geral SET gerenciaempresas = '1' where usuario = '".$_GET['id']."' "; mysqli_query($connect, $upd_gerenciaempresas); } else {
$upd_gerenciaempresas = "UPDATE gz_geral SET gerenciaempresas = '0' where usuario = '".$_GET['id']."' "; mysqli_query($connect, $upd_gerenciaempresas); } 
?>
  
 





 
<script>window.location="SoliUsuarios.php?m=1&id=<?php echo $_GET["id"];?>";</script><?php
		
	}

?>

<?php
// Altero os dados quando clico em salvar
	
	
	if(isset($_POST["adicionardados"])){
		
		
		 
	 
		
?> 
<?php

 
		
$connect2 = mysqli_connect('191.239.243.177','root','rvlav207300@R');

$db = mysqli_select_db($connect2, 'gz_cmms'); 
		
		
			mysqli_set_charset($connect2,'utf8');
	mysqli_query($connect2,"SET NAMES utf8");
mysqli_query($connect2,"SET CHARACTER SET utf8");
mysqli_query($connect2,"set_charset('utf8')");
		
		

$query_select = "SELECT login FROM usuarios WHERE login = '".$_POST['login']."'";

$select = mysqli_query($connect2, $query_select);
		
		

$array = mysqli_fetch_array($select);

$logarray = $array['login'];



  if($_POST['login'] == "" || $_POST['login'] == null){

    echo"<script language='javascript' type='text/javascript'>alert('O campo login deve ser preenchido');</script>";

    }else{

      if($logarray == $_POST['login']){

        echo"<script language='javascript' type='text/javascript'>alert('Esse login já existe');window.location='SoliUsuarios.php'</script>";

        die();



      }else{

        $query = "
		 INSERT INTO usuarios  
		 
		 (
			login, 
			senha, 
			NOMECOMPLETO, 
			empresa, 
			data_cadastro, 
			 
			status
		 ) VALUES (
		 
		 '".$_POST['login']."',
		 '".MD5($_POST['senha'])."',
		 '".$_POST['NOMECOMPLETO']."',
		 '".$_POST['EMPRESA']."',
		 NOW(),
 		 'Sim'
		 ) 	
		
		";




        
        $insert = mysqli_query($connect2, $query);
		  
		  
		  $queryGeral = "INSERT INTO gz_geral (usuario,grupo) VALUES ((SELECT MAX(USR_ID) from usuarios) ,'1')";
		 mysqli_query($connect2,$queryGeral);
		  
		  
		  $queryUpdateGeral = "
		 UPDATE gz_geral

SET
 
gerenciausuarios		= '0',
gerenciacategoria		= '0',
gerenciatipo			= '0',
gerenciasolicitacoes 	= '0',
gerenciaempresas        = '0',
managerlevel = '".$_POST['NIVEL']."'




WHERE usuario = (SELECT MAX(USR_ID) from usuarios)";
		   mysqli_query($connect2,$queryUpdateGeral);


          

		  if($insert){

          echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');</script>";

        }else{

          echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário'); </script>";

        }

      }

    }

?>
 
<script>window.location="SoliUsuarios.php";</script><?php
		
	}

?>



	<!doctype html>
	<html lang="en">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
	body,td,th {
	font-size: 0.88rem;
}
    </style>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Language" content="en">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Manager Z - Usuários</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
		<meta name="description" content="This is an example dashboard created using build-in elements and components.">

		<!-- Disable tap highlight on IE -->
		<meta name="msapplication-tap-highlight" content="no">

		<link href="main.d810cf0ae7f39f28f336.css" rel="stylesheet">
		
		 
	
	
	</head>

	<body>
		
	 
		
		
		 <script>document.getElementById("editModal<?php echo $_GET["id"]; ?>").modal('show')</script>
		
		
		
		
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
										<i class="lnr-users icon-gradient bg-mean-fruit"></i>
									</div>
									<div>Controle de Manutenção - Usuários
										<div class="page-title-subheading">Listas de Usuários.</div>
									</div>
								</div>
							</div>
						</div>




						<div class="main-card mb-3 card">
							<div class="d-block text-right card-footer">

								<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#AddModal">Adicionar</button>
								   
 								
							</div>
							<div class="card-header">Usuários cadastrados</div>
							
			 
 			 
							
							<ul class="todo-list-wrapper list-group list-group-flush">


								<?php  foreach ($usuarioUSR_ID as $index => $value) { ?>
								<li class="list-group-item">
									<div class="todo-indicator bg-warning"></div>
									<div class="widget-content p-0">
										<div class="widget-content-wrapper">

											<div class="widget-content-left">
												<div class="widget-heading">
													<?php echo $usuarioNOMECOMPLETO[$index];?> (<?php echo $usuariologin[$index];?>)

												</div>
												<div class="widget-subheading">
													<i>
														 <?php echo $usuarioFANTASIA[$index];?><br>
														 <small>Cadastrado em <?php echo $usuariodata_cadastro[$index];?> </small>
														 
													</i>
												</div>
												 
											</div>
											 
											
											<div class="widget-content-right  ">
												
												<?php if ($usuariostatus[$index] == "Sim") { ?>
												 <div class="mb-2 mr-2 badge badge-success">Ativado</div> 
												<?php } else { ?>
												<div class="mb-2 mr-2 badge badge-secondary">Desativado</div>
												<?php } ?>
												
												
												<button class="border-0 btn-transition btn btn-outline-success" data-toggle="modal" data-target="#editModal<?php echo $usuarioUSR_ID[$index];?>">
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
				 
				<form action="SoliUsuarios.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
				
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
	<?php  foreach ($usuarioUSR_ID as $index => $value) { ?>
	<div class="modal fade" id="editModal<?php echo $usuarioUSR_ID[$index];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						 <i class="lnr-user icon-gradient bg-mean-fruit"></i> Editar dados do usuário
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
						
                </button>
				

				</div>
				 
				<form action="SoliUsuarios.php?id=<?php echo $usuarioUSR_ID[$index];?>" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
				
				<div class="modal-body">
							 
						
						<input type="hidden" value="<?php echo $usuarioUSR_ID[$index];?>" name="usuarioUSR_ID"> 
					

					<div>

						 <div class="form-row">
							 
							 <div class="col-md-2">
								<div class="position-relative form-group">
									<label for="CODIGO">Código </label>
									<input name="CODIGO" id="CODIGO" value="<?php echo $usuarioUSR_ID[$index];?>" type="text" class="form-control" readonly>
								</div>
							</div>
							 <div class="col-md-5">
								<div class="position-relative form-group">
									<label for="LOGIN">Login </label>
									<input name="LOGIN" id="LOGIN" value="<?php echo $usuariologin[$index];?>" type="text" class="form-control" readonly>
								</div>
							</div>
							 <div class="col-md-5">
								<div class="position-relative form-group">
									<label for="SENHA">Senha </label>
									<input name="senha" id="senha" value="<?php echo $usuariosenha[$index];?>" type="password" class="form-control" >
								</div>
							</div>
							 
							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="NOMECOMPLETO">Nome Completo </label>
									<input name="NOMECOMPLETO" id="NOMECOMPLETO" value="<?php echo $usuarioNOMECOMPLETO[$index];?>" type="text" class="form-control">
								</div>
							</div>
							 
							 
					 
							 
							 
							 
							 	
							 
							 
							

						</div>
						
						
						
						<div class="form-row">
						<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="EMPRESA">Empresa </label>
									
									<select class="mb-2 form-control" name="EMPRESA">
	<option value="<?php echo $usuarioempresa[$index];?>"><?php echo $usuarioFANTASIA[$index];?></option>
									
										 
									</select>
								</div>
							</div>
							 
						
						</div>
						
						
						
						

							 
							<div class="form-row">
								 
								<div class="col-md-6"> 
									<div class="position-relative form-group">
										<label for="STATUS">Ativado</label>
 										
<select class="mb-2 form-control" name="STATUS">
	<option value="<?php echo $usuariostatus[$index];?>"> <?php echo $usuariostatus[$index];?></option>
											
	<?php if ($usuariostatus[$index] == "Sim") { ?>
	<option value="Não">Não</option>
	<?php } else { ?>
  <option value="Sim">Sim</option>
	<?php } ?>
										
										
										</select>
									</div>
								</div>
							</div>
						
						<li class="list-group-item">
                                <div class="todo-indicator bg-focus"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
 
                                        <div class="widget-content-left">
											  


                                            
											<div class="widget-heading">Empresas </div>
                                            <div class="widget-subheading">
                                                <div>Gerenciar as empresas cadastradas ou cadastrar uma nova.
                                                     
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right  ">
											 
                                           <input type="checkbox" value="<?php echo $USR_gerenciaempresas[$index]; ?>" name="gerenciaempresas[<?php echo $usuarioUSR_ID[$index];?>]"   data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" <?php if ($USR_gerenciaempresas[$index]==='0' ) { echo "";} else { echo "checked";} ?>>
                                        </div>
										
                                    </div>
                                </div>
                            </li>
						<li class="list-group-item">
                                <div class="todo-indicator bg-focus"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
 
                                        <div class="widget-content-left">
											 
                                            
											<div class="widget-heading">Categorias</div>
                                            <div class="widget-subheading">
                                                <div>Gerenciar as categorias das solicitações.
                                                     
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right  ">
                                             <input type="checkbox" value="<?php echo $USR_gerenciacategoria[$index]; ?>" name="gerenciacategoria[<?php echo $usuarioUSR_ID[$index];?>]"   data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" <?php if ($USR_gerenciacategoria[$index]==='0' ) { echo "";} else { echo "checked";} ?>>
                                        </div>
										

                                    </div>
                                </div>
                            </li>
							<li class="list-group-item">
                                <div class="todo-indicator bg-focus"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
 
                                        <div class="widget-content-left">
											 
                                            

											<div class="widget-heading">Tipo</div>
                                            <div class="widget-subheading">
                                                <div>Gerenciar tipos de solicitações.
                                                     
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right  ">
                                             <input type="checkbox" value="<?php echo $USR_gerenciatipo[$index]; ?>" name="gerenciatipo[<?php echo $usuarioUSR_ID[$index];?>]"   data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" <?php if ($USR_gerenciatipo[$index]==='0' ) { echo "";} else { echo "checked";} ?>>
                                        </div>
										
                                    </div>
                                </div>
                            </li>
						<li class="list-group-item">
                                <div class="todo-indicator bg-focus"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
 
                                        <div class="widget-content-left">
											 
                                            
											<div class="widget-heading">Usuários</div>
                                            <div class="widget-subheading">
                                                <div>Gerenciar informações do usuário ou alterar a senha.
                                                     
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right  ">
                                           <input type="checkbox" value="<?php echo $USR_gerenciausuarios[$index]; ?>" name="gerenciausuarios[<?php echo $usuarioUSR_ID[$index];?>]"   data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" <?php if ($USR_gerenciausuarios[$index]==='0' ) { echo "";} else { echo "checked";} ?>>
                                        </div>
										 
                                    </div>
                                </div>
                            </li>
						<li class="list-group-item">
                                <div class="todo-indicator bg-focus"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
 
                                        <div class="widget-content-left">
											 
                                            
											<div class="widget-heading">Solicitações</div>
                                            <div class="widget-subheading">
                                                <div>Gerenciar solicitações
                                                     
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right  ">
                                          <input type="checkbox" value="<?php echo $USR_gerenciasolicitacoes[$index]; ?>" name="gerenciasolicitacoes[<?php echo $usuarioUSR_ID[$index];?>]"   data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger" <?php if ($USR_gerenciasolicitacoes[$index]==='0' ) { echo "";} else { echo "checked";} ?>>
                                        </div>
										
                                    </div>
                                </div>
                            </li>
 

 

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
						  Adicionar um Usuário
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
						
                </button>
				

				</div>
				 
				<form action="SoliUsuarios.php" method="post" enctype="multipart/form-data" name="form" id="form" title="form">
				
				 <div class="modal-body">
							 
						
						 
					

				   <div>

						 <div class="form-row">
							 
							 
						   <div class="col-md-6">
								<div class="position-relative form-group">
									<label for="login">Login </label>
									<input name="login" id="login" placeholder="login" type="text" class="form-control"  >
								</div>
							</div>
						   <div class="col-md-6">
								<div class="position-relative form-group">
									<label for="senha">Senha </label>
									<input name="senha" id="senha" placeholder="Senha" type="password" class="form-control" >
								</div>
							</div>
							 
							<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="NOMECOMPLETO">Nome Completo </label>
								  <input name="NOMECOMPLETO" id="NOMECOMPLETO" placeholder="Nome Completo" type="text" class="form-control">
								</div>
							</div>
							 
							 
					 
							 
							 
							 
							 	
							 
							 
							

						</div>
						
						
						
						<div class="form-row">
						<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="EMPRESA">Empresa </label>
									
									<select class="mb-2 form-control" name="EMPRESA">
 <option>Selecione</option>
											<?php  foreach ($BuscaEmpresas_GZ_EMPRESA_ID as $index => $value) { ?>
										
										
										
										<option value="<?php echo $BuscaEmpresas_GZ_EMPRESA_ID[$index];?>"><?php echo $BuscaEmpresas_FANTASIA[$index];?></option>
										
										
										<?php } ?>
										
										
										
										 
									</select>
								</div>
						  </div>
							 
						
						</div>
						
						
						
						<div class="form-row">
						<div class="col-md-12">
								<div class="position-relative form-group">
									<label for="NIVEL">Nível </label>
									
									<select class="mb-2 form-control" name="NIVEL">
 <option>Selecione</option>
										 
										
										
										
										<option value="loja">LOJA</option>
										<option value="profissional">PROFISSIONAL</option>
										
										
									 
										
										
										
										 
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