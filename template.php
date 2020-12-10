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
                                <div>Controle de Manutenção - TITULO
                                    <div class="page-title-subheading">Descrição.</div>
                                </div>
                            </div>
                               </div>
                    </div>       
					
					
					
					
					x
					 
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