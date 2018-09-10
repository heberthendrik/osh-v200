<?php
session_start();
error_reporting(1);
include('../../library/function_list.php');

if( $_POST['module'] == "Login" ){
	
	$input_parameter['EMAIL'] = $_POST['emailEmail'];
	$input_parameter['PASSWORD'] = $_POST['passwordPassword'];
	
	$function_result = Login($input_parameter);
	
	if( $function_result['FUNCTION_RESULT'] == 1 ){
		
		$_SESSION['OSH']['FUNCTION_RESULT'] = 1;
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = 'Login berhasil. Selamat datang!';
		header("Location:../Dashboard/index.php");
		exit;
		
	} else {
		
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['MESSAGE'];
		header("Location:../../index.php");
		exit;
		
	}
	
}

if( $_GET['module'] == "Logout" ){
	
	$function_result = Logout();
	header('Location:../../index.php');
	exit;
	
}

?>