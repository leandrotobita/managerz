<?php
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );

	$con = mysqli_connect( '191.239.243.177', 'root', 'rvlav207300@R') ;
	mysqli_select_db($con, 'gz_cmms')	;

	$cod_estados = mysqli_real_escape_string( $con, $_REQUEST["cod_estados"] );

	$cidades = array();

	$sql = "SELECT cod_cidades, nome FROM cidades WHERE estados_cod_estados='".$cod_estados."'
			ORDER BY nome";
	$res = mysqli_query( $con, $sql );
if(mysqli_error($con)){
die(mysqli_error($con));
}
	while ( $row = mysqli_fetch_assoc( $res ) ) {
		$cidades[] = array(
			"cod_cidades"	=> $row["cod_cidades"],
			"nome"			=> $row["nome"],
		);
	}

	echo( json_encode( $cidades ) );