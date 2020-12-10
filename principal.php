 <?php

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
	// Busco todas as solicitações

	if ($managerlevel2 == "profissional") { 
	
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
Status as SoliStatus,
AprovadoReprovado
 FROM gz_solicitacoes

LEFT JOIN solicategoria on solicategoria.SoliCatId = gz_solicitacoes.OSCategoria
LEFT JOIN gz_empresas on gz_empresas.GZ_EMPRESA_ID = gz_solicitacoes.SoliEmpresa WHERE Status != '3'  order by SoliId DESC
	";
	
	
	}  else {
		
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
Status as SoliStatus,
AprovadoReprovado
 FROM gz_solicitacoes

LEFT JOIN solicategoria on solicategoria.SoliCatId = gz_solicitacoes.OSCategoria
LEFT JOIN gz_empresas on gz_empresas.GZ_EMPRESA_ID = gz_solicitacoes.SoliEmpresa where UsuarioLogado = '".$login_cookie."' order by SoliId DESC
	";
		
		
	}

	$SolicitacoesRES = mysqli_query( $connect, $SolicitacoesSQL );

	if ( mysqli_num_rows( $SolicitacoesRES ) > 0 ) {






		while ( $SolicitacoesROW = mysqli_fetch_array( $SolicitacoesRES ) ) {



$SoliId[]        = $SolicitacoesROW["SoliId"];	
$SoliNome[]      = $SolicitacoesROW["SoliNome"];      
$SoliTelefone[]  = $SolicitacoesROW["SoliTelefone"];
$SoliEmpresa[]   = $SolicitacoesROW["SoliEmpresa"];
$SoliCargo[]     = $SolicitacoesROW["SoliCargo"];
$SoliEmail[]     = $SolicitacoesROW["SoliEmail"];
$Solicidade[]    = $SolicitacoesROW["Solicidade"];
$SoliEstado[]    = $SolicitacoesROW["SoliEstado"];
$OSDescricao[]   = $SolicitacoesROW["OSDescricao"];
$OSCategoria[]   = $SolicitacoesROW["OSCategoria"];
$Categoria[]     = $SolicitacoesROW["Categoria"];
$OSTipo[]        = $SolicitacoesROW["OSTipo"];
$OSLocal[]       = $SolicitacoesROW["OSLocal"];
$OSVencimento[]  = $SolicitacoesROW["OSVencimento"];
$OSObs[]         = $SolicitacoesROW["OSObs"];
$OSPrioridade[]  = $SolicitacoesROW["OSPrioridade"];
$DataCadastro[]  = $SolicitacoesROW["DATACADASTRO"];
$HoraCadastro[]  = $SolicitacoesROW["HORACADASATRO"];
$UsuarioLogado[] = $SolicitacoesROW["UsuarioLogado"];
$IpUsuario[]     = $SolicitacoesROW["IpUsuario"];
$SoliStatus[]        = $SolicitacoesROW["SoliStatus"];
$SoliDescempresa[] = $SolicitacoesROW["SoliDescempresa"];			
$AprovadoReprovado[] = $SolicitacoesROW["AprovadoReprovado"];			



		}

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
    <title>Manager Z - Controle de Manutenção</title>
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
                                <div> Dashboard
                                    <div class="page-title-subheading">Solicitações abertas</div>
                                </div>
                            </div>
                                </div>
                    </div>       
					
					
					
					
					<div class="row">
						 
 
						
						<?php foreach ($SoliId as $index => $value ) { ?>
                            <div class="col-lg-6 col-xl-4 " >
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">
												<a href="SolicitacaoDetalhe.php?sol=<?php echo $SoliId[$index];?>">	
													#<?php echo sprintf('%04d', $SoliId[$index]);?> <?php echo $SoliDescempresa[$index]?>
													</a>
												
												</div>
                                                <div class="widget-subheading" style="padding: 5px; color:black;"><?php echo $OSDescricao[$index]?></div>
                                            </div>
                                            <div class="widget-content-right" style="  text-align:right;">
												
												
												 
                                                <?php if ($SoliStatus[$index] =='1') { ?>
					
					<div class="badge badge-pill badge-primary">Novo</div>
					
					<?php } else if ($SoliStatus[$index] =='2') { ?>
					
					<div class="badge badge-pill badge-warning">Em andamento</div>
					
					<?php } else if ($SoliStatus[$index] =='3') { ?>
					
					<div class="badge badge-pill badge-success">Finalizado</div>
					
					<?php } ?>
												
												
								 
													  
												
                                            </div>
                                        </div> 
										
						    
                                        <div class="widget-progress-wrapper">
                                            
											<div class="progress-sub-label">
                                                <div class="sub-label-left"><small>Criado por <b class="text-primary"><?php echo $UsuarioLogado[$index]; ?></b> em <b class="text-primary"><?php echo $DataCadastro[$index]; ?></b> às <b class="text-primary"><?php echo $HoraCadastro[$index]; ?></b></small></div>
                                                <div class="sub-label-right"> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <?php } ?>
						
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



<?php

    }else{

?>

<script>window.location="index.php";</script>

<?php } ?>