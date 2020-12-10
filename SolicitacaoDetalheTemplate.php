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
		
		
		
		
		
		
?> <!doctype html>
<html lang="en">


<!-- Mirrored from demo.dashboardpack.com/architectui-html-pro/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 Oct 2020 17:18:44 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Manager Z - Detalhes da solicitação</title>
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
                                <div>Detalhes da solicitação #43
                                    <div class="page-title-subheading">Visão geral das solicitações de manutenção.</div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                               <a href="novo.php"> <button type="button" data-toggle="tooltip"   data-placement="bottom"
                                    class="btn-shadow mr-3 btn btn-gradient-success">
                                    <i class="pe-7s-plus"></i> Nova solicitação
                                </button></a>
                                 
                            </div>    </div>
                    </div>       
					
					
					
					
					
					 
                    <div class="tabs-animation">
                        <div class="main-card mb-3 card">
                        <div class="card-header">
                            <div class="card-header-title font-size-lg text-capitalize font-weight-normal">Últimas solicitações em aberto
                            </div>
                             
                        </div>
                        <div class="table-responsive">
                            <table class="align-middle text-truncate mb-0 table table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center"></th>
                                        <th class="text-center">Nome</th>
                                        <th class="text-center">Empresa</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Solicitado em</th>
                                        <th class="text-center">Progresso...</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     
                                     
                                    <tr>
                                        <td class="text-center text-muted" style="width: 80px;">#56</td>
                                        <td class="text-center" style="width: 80px;">
                                            <img width="40" class="rounded-circle" src="assets/images/avatars/2.jpg" alt="">
                                        </td>
                                        <td class="text-center"><a href="javascript:void(0)">Darrell Lowe</a></td>
                                        <td class="text-center"><a href="javascript:void(0)">Riddle Electronics</a></td>
                                        <td class="text-center">
                                            <div class="badge badge-pill badge-warning">In Progress</div>
                                        </td>
                                        <td class="text-center">
                                            <span class="pr-2 opacity-6">
                                                <i class="fa fa-business-time"></i>
                                            </span>
                                            6 Dec
                                        </td>
                                        <td class="text-center" style="width: 200px;">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-outer">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left pr-2">
                                                            <div class="widget-numbers fsize-1 text-success">99%</div>
                                                        </div>
                                                        <div class="widget-content-right w-100">
                                                            <div class="progress-bar-xs progress">
                                                                <div class="progress-bar bg-success" role="progressbar"
                                                                    aria-valuenow="99" aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: 99%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div role="group" class="btn-group-sm btn-group">
                                                <button class="btn-shadow btn btn-primary"><b class="pe-7s-search"></b> Visualizar</button>
                                            </div>
                                        </td>
                                    </tr>
                                     
                                </tbody>
                            </table>
                        </div>
							
							
                        <div class="divider"></div>
							
							<div class="grid-menu grid-menu-3col">
                                                <div class="no-gutters row">
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-primary">
                                                            <i  class="lnr-license btn-icon-wrapper"> </i>Primary
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-secondary">
                                                            <i class="lnr-map btn-icon-wrapper"> </i>Secondary
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <buttonclass="btn-icon-vertical btn-square btn-transition btn btn-outline-success">
                                                            <i class="lnr-music-note btn-icon-wrapper"> </i>Success
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-info">
                                                            <i class="lnr-heart btn-icon-wrapper"> </i>Info
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-warning">
                                                            <i class="lnr-magic-wand btn-icon-wrapper"> </i>Warning
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-danger">
                                                            <i class="lnr-lighter btn-icon-wrapper"> </i>Danger
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
							 
							
							
							 <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <h5 class="card-title">Basic</h5>
                                            <div class="vertical-time-icons vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <div class="vertical-timeline-element-icon bounce-in">
                                                            <div class="timeline-icon border-primary">
                                                                <i class="lnr-license icon-gradient bg-night-fade"></i>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">All Hands Meeting</h4>
                                                            <p>Lorem ipsum dolor sic amet, today at 
                                                                <a  href="javascript:void(0);">12:00 PM</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <div class="vertical-timeline-element-icon bounce-in">
                                                            <div class="timeline-icon border-warning">
                                                                <i class="lnr-cog fa-spin icon-gradient bg-happy-itmeo"></i>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <p>Another meeting today, at <b class="text-danger">12:00 PM</b></p>
                                                            <p>Yet another one, at <span class="text-success">15:00 PM</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <div class="vertical-timeline-element-icon bounce-in">
                                                            <div class="timeline-icon border-success">
                                                                <i class="lnr-cloud-upload icon-gradient bg-plum-plate"></i>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">Build the production release</h4>
                                                            <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut
                                                                labore et dolore magna elit enim at minim veniam quis nostrud
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <div class="vertical-timeline-element-icon bounce-in">
                                                            <div class="timeline-icon border-primary">
                                                                <i class="lnr-license text-primary"></i>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">All Hands Meeting</h4>
                                                            <p>Lorem ipsum dolor sic amet, today at 
                                                                <a href="javascript:void(0);">12:00 PM</a>
                                                            </p>
            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <div class="vertical-timeline-element-icon bounce-in">
                                                            <div class="timeline-icon border-success bg-success">
                                                                <i class="fa fa-coffee text-white"></i>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title text-success">FontAwesome Icons</h4>
                                                            <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <div class="vertical-timeline-element-icon bounce-in">
                                                            <div class="timeline-icon border-warning bg-warning">
                                                                <i class="fa fa-archive fa-w-16 text-white"></i>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <h4 class="timeline-title">Build the production release</h4>
                                                            <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut
                                                                labore et dolore magna elit enim at minim veniam quis nostrud
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <div class="timeline-icon bg-danger border-danger">
                                                                <i class="pe-7s-cloud-upload text-white"></i>
                                                            </div>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <p>Another meeting today, at <b class="text-warning">12:00 PM</b></p>
                                                            <p>Yet another one, at <span class="text-dark">15:00 PM</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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