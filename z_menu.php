<?php // contadores

// abertos

if ($managerlevel2 == "profissional") { 
$abertoSQL = "SELECT COUNT(SoliId) as QTDE  FROM gz_solicitacoes WHERE `Status` != '3'";
} else {
$abertoSQL = "SELECT COUNT(SoliId) as QTDE  FROM gz_solicitacoes WHERE `Status` != '3' and UsuarioLogado ='".$login_cookie."'";		
}


$abertoRES = mysqli_query( $connect, $abertoSQL ); 
if ( mysqli_num_rows( $abertoRES ) > 0 ) { 
	while ( $abertoROW = mysqli_fetch_array( $abertoRES ) ) {  $qtde_aberto = $abertoROW["QTDE"]; } }
												
?>
				<div class="scrollbar-sidebar" style="width: 100%;"  <?php  // tinha uma css class chato aquo, o (scrollbar-sidebar) que mostrava uma bandeira estranha!!! ?></div>

 <div class="dropdown-menu-header mb-0">
                                                <div class="dropdown-menu-header-inner bg-deep-blue">
                                                    <div class="menu-header-image opacity-1" style="background-image: url('assets/images/dropdown-header/city3.jpg');"></div>
                                                    <div class="menu-header-content text-dark">
                                                        <h5 class="menu-header-title"><?php echo $login_cookie; ?></h5>
                                                         
                                                    </div>
                                                </div>
                                            </div>
                    <div class="app-sidebar__inner">
						
                        <ul class="vertical-nav-menu">
							 
								 
								
								 
								 
								 
                           
							    
							    <li class="app-sidebar__heading">SOLICITAÇÕES</li>
                           
							<li  >
                                        <a href="novo.php?p=novo" <?php if ($_GET['p'] == 'novo') { ?>class="mm-active"    <?php } else { ?>  <?php } ?>  >
                                           <i class="metismenu-icon pe-7s-help2"></i>Solicitar
                                        </a>
                                    </li>
							       <li  >
                                        <a href="principal.php?p=principal" <?php if ($_GET['p'] == 'principal') { ?>class="mm-active"    <?php } else { ?>  <?php } ?>  >
                                           <i class="metismenu-icon lnr-chart-bars"></i>Dashboard
                                        </a>
                                    </li>
							
							
                                    <li>
                                        <a href="soliabertas.php?p=abertas"  <?php if ($_GET['p'] == 'abertas') { ?>class="mm-active"    <?php } else { ?>  <?php } ?> >
                                            <i class="metismenu-icon pe-7s-mail-open-file"></i>Em aberto  <b  class="badge badge-pill badge-primary" style="float: right;"><?php echo $qtde_aberto;?>  </b>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="solifinalizadas.php?p=finalizadas" <?php if ($_GET['p'] == 'finalizadas') { ?>class="mm-active"    <?php } else { ?>  <?php } ?> >
                                            <i class="metismenu-icon pe-7s-mail"></i>Finalizadas
                                        </a>
                                    </li>
							
							
							<?php if ($managerlevel2 == "profissional") {  ?>
							 <li class="app-sidebar__heading">SOLICITAÇÕES ABERTAS POR CIDADE</li> 
							
							
							<?php // cidades atendidas
											
											$CitySQL = "SELECT 
															CIDADE,
															CEP,
															qtdecidade(CIDADE_CODIGO) AS qtdecidade

															 FROM gz_solicitacoes

															LEFT JOIN solicategoria on solicategoria.SoliCatId = gz_solicitacoes.OSCategoria
															LEFT JOIN gz_empresas on gz_empresas.GZ_EMPRESA_ID = gz_solicitacoes.SoliEmpresa WHERE  status != '3'  GROUP BY CIDADE ORDER BY CIDADE ASC";
											$CityRES = mysqli_query( $connect, $CitySQL );
											if ( mysqli_num_rows( $CityRES ) > 0 ) {
											while ( $CityROW = mysqli_fetch_array( $CityRES ) ) {
										     
											$CitySelected[] = $CityROW["CIDADE"]; 
											$CityQTDE[]     =  $CityROW["qtdecidade"]; 
											}}
											?>
											
												<?php  foreach ($CitySelected as $index => $value) { ?>
                                            <li>
                                                <a href="SolicitacaoCidade.php?city=<?php echo $CitySelected[$index]?>" <?php if ($_GET['city'] == $CitySelected[$index]) { ?>class="mm-active"    <?php } else { ?>  <?php } ?>>
                                                    <i class="metismenu-icon lnr-store"></i><?php echo mb_strimwidth($CitySelected[$index], 0, 15, "..."); ?> 
													  <b  class="badge badge-pill badge-primary" style="float: right;"> <?php echo $CityQTDE[$index]?>   </b>
                                                </a>  
                                            </li>
											<?php } ?>
							
							
							
							<?php } ?>
                            
                            
                             
                            
                           
                        </ul>
                    </div>
                </div>
				
				