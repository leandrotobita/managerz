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

<?php // primeiro eu vou pegar todos os nomes das empresas para depois em outro select, mostar as solicitações desta empresa selecionada // $managerlevel2 == "profissional
		
		if ($managerlevel2 == "profissional") { 
			
			
	$MONTA_LISTA_EMPRESA_SQL = "SELECT gz_empresas.GZ_EMPRESA_ID, gz_empresas.FANTASIA as SoliDescempresa  FROM gz_solicitacoes
LEFT JOIN gz_empresas on gz_empresas.GZ_EMPRESA_ID = gz_solicitacoes.SoliEmpresa  where Status != '3' and CIDADE = '".$_GET['city']."'   GROUP BY FANTASIA order by FANTASIA ASC";
		
		} else {
			
	$MONTA_LISTA_EMPRESA_SQL = "SELECT gz_empresas.GZ_EMPRESA_ID, gz_empresas.FANTASIA as SoliDescempresa  FROM gz_solicitacoes
LEFT JOIN gz_empresas on gz_empresas.GZ_EMPRESA_ID = gz_solicitacoes.SoliEmpresa      where Status != '3' and UsuarioLogado = '".$login_cookie."' and CIDADE = '".$_GET['city']."'  GROUP BY FANTASIA order by FANTASIA ASC";
				
			
		}
		
		
		
		
	$MONTA_LISTA_EMPRESA_RES = mysqli_query( $connect, $MONTA_LISTA_EMPRESA_SQL );
	if ( mysqli_num_rows( $MONTA_LISTA_EMPRESA_RES ) > 0 ) {
	while ( $MONTA_LISTA_EMPRESA_ROW = mysqli_fetch_array( $MONTA_LISTA_EMPRESA_RES ) ) {	 

	$gGZ_EMPRESA_ID[]   = $MONTA_LISTA_EMPRESA_ROW["GZ_EMPRESA_ID"];
	$gSoliDescempresa[] = $MONTA_LISTA_EMPRESA_ROW["SoliDescempresa"];
		
		
		
	}}


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
                         
						 <div class="col-lg-12 col-xl-12 " >
                                <div id="accordion" class="accordion-wrapper mb-3">
									<?php $i =1; ?>
									<?php foreach ($gGZ_EMPRESA_ID as $index => $value ) {  
		
		
									
		                              $a =  $i++;
									 
									?> 
									
									
                                    <div class="card">
                                        <div id="heading<?php echo $gGZ_EMPRESA_ID[$index]; ?>" class="card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapse<?php echo $gGZ_EMPRESA_ID[$index]; ?>"
                                                aria-expanded="true" aria-controls="collapse<?php echo $gGZ_EMPRESA_ID[$index]; ?>"
                                                class="text-left m-0 p-0 btn btn-link btn-block">
                                               <?php echo $gSoliDescempresa[$index] ?> 
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapse<?php echo $gGZ_EMPRESA_ID[$index]; ?>" aria-labelledby="headingOne"
											 
											 <?php if ($a == '1') { ?>
                                            class="collapse show"      
											 
											 <?php } else { ?>
											 class="collapse hidden"  
											 <?php } ?>
											 
											 >
                                            <div class="card-body">
												<div class="table-responsive">
												
												<table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>

                                                <tr>
                                                    <th class="text-center">#</th>
													 <th>Data</th>
                                                    <th>Nome</th>
                                                    
                                                    <th class="text-center">Cidade</th>
                                                    <th class="text-center">Descrição</th>
                                                     
													
													<th class="text-center">Status </th>
													
													<th class="text-center">  </th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<?php 
												$SQL_lista_solicitacoes = "
												 
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
LEFT JOIN gz_empresas on gz_empresas.GZ_EMPRESA_ID = gz_solicitacoes.SoliEmpresa WHERE Status != '3' and        SoliEmpresa = '".$gGZ_EMPRESA_ID[$index]."' and CIDADE = '".$_GET['city']."'  order by SoliId DESC
";
						$RES_lista_solicitacoes = mysqli_query( $connect, $SQL_lista_solicitacoes );
	if ( mysqli_num_rows( $RES_lista_solicitacoes ) > 0 ) {
	while ( $row_lista_solicitacoes = mysqli_fetch_array( $RES_lista_solicitacoes ) ) {	 

	 
 		
		
												?>
												
												<TR>
												<td><?php echo sprintf('%04d', $row_lista_solicitacoes["SoliId"]);?>     </td>
													
													<td> <?php echo $row_lista_solicitacoes["DATACADASTRO"];?>    </td> 
												<td> <?php echo $row_lista_solicitacoes["SoliNome"];?> </td>
										 
												<td> <?php echo $row_lista_solicitacoes["Solicidade"];?> </td>
											 
												<td> <?php echo $row_lista_solicitacoes["OSDescricao"];?> </td>
												
												<td> 
													
														 
                                                <?php if ($row_lista_solicitacoes["SoliStatus"] =='1') { ?>
					
					<div class="badge badge-pill badge-primary">Novo</div>
					
					<?php } else if ($row_lista_solicitacoes["SoliStatus"] =='2') { ?>
					
					<div class="badge badge-pill badge-warning">Em andamento</div>
					
					<?php } else if ($row_lista_solicitacoes["SoliStatus"] =='3') { ?>
					
					<div class="badge badge-pill badge-success">Finalizado</div>
					
					<?php } ?>
												
													
													
													</td>
													
													<td>  
														 
														  
														 
													<button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm" onClick="window.location='SolicitacaoDetalhe.php?sol=<?php echo $row_lista_solicitacoes["SoliId"];?>';" style="cursor: pointer;">Visualizar</button>	
														
														
														    </td>
												</TR>
												<?php }}?>
												
											</tbody>
												</table>
												
												
												</div>
												
												
												
												
												
                                            </div>
                                        </div>
                                    </div>
									<?php } ?>
                                     
                                     
                                </div>
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



<?php

    }else{

?>

<script>window.location="index.php";</script>

<?php } ?>