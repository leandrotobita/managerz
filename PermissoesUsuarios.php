<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);	// esta linha mascara os erros da pagina como por exemplo numeros dividido por zero ou quando uma variavel ainda nao existe pq o usuario nao clicou no botão para enviar os dados POSTS do formulario...

	include "_conect_.php";

	//                   	      *
	//                  	      *
	//                  	    *****
	//                  	     ***
	// SQL SELECIONA USUARIOS 	  *      INICIO ##############################


 $query_select = " select * from gz_geral
 
LEFT join usuarios on usuarios.USR_ID = gz_geral.usuario
LEFT JOIN gz_empresas ON  gz_empresas.GZ_EMPRESA_ID = usuarios.EMPRESA


 

where usuarios.login = '".$login_cookie."'
";
$select = mysqli_query($connect, $query_select);

while ($ROW = mysqli_fetch_array($select)) {

 

$NOMECOMPLETO    = $ROW["NOMECOMPLETO"];
$EMPRESA         = $ROW["EMPRESA"];
$data_cadastro   = $ROW["data_cadastro"];
$GZ_EMPRESA_ID   = $ROW["GZ_EMPRESA_ID"];
$RAZAOSOCIAL     = $ROW["RAZAOSOCIAL"];
$FANTASIA        = $ROW["FANTASIA"];
$ENDERECO        = $ROW["ENDERECO"];
$BAIRRO          = $ROW["ENDERECO"];
$CIDADE        	 = $ROW["BAIRRO"];
$CEP        	 = $ROW["CIDADE"];
$UF        		 = $ROW["CEP"];
$TELEFONE        = $ROW["TELEFONE"];
$INSCRMUNICIPAL  = $ROW["INSCRMUNICIPAL"];
$INSCRESTADUAL   = $ROW["INSCRESTADUAL"];
$CNPJ            = $ROW["CNPJ"];
$FAX             = $ROW["FAX"];
$COMPLEMENTO     = $ROW["COMPLEMENTO"];
	
// PARAMETROS 
$gerenciausuarios     = $ROW["gerenciausuarios"];
$gerenciacategoria    = $ROW["gerenciacategoria"];
$gerenciatipo		  = $ROW["gerenciatipo"];
$gerenciasolicitacoes = $ROW["gerenciasolicitacoes"];
$gerenciaempresas	  = $ROW["gerenciaempresas"];
$managerlevel2         = $ROW["managerlevel"];
	



}

 
	// SQL SELECIONA USUARIOS     *      FIM
	//                           ***
	//                          *****
	//                            *
	//                            *

$logSelect = "INSERT INTO gz_zlog (login,horario,ipvisitante,arquivo,logloja) values

(
'".$login_cookie."',
NOW(),
'".$_SERVER['REMOTE_ADDR']."',
'". basename($_SERVER['PHP_SELF'])."',
'".$_SESSION['databasename']."'


)";
$logSQL = mysqli_query($connect, $logSelect);

?>
 



