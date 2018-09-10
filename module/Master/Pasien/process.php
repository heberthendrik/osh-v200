<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../../../library/function_list.php');

if( $_POST['module'] == "AddPasien" ){
	
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['ALAMAT'] = $_POST['textAlamat'];
	$input_parameter['NO_RM'] = $_POST['textNoRm'];
	$input_parameter['SEX'] = $_POST['selectSex'];
	$input_parameter['TGL_LAHIR'] = $_POST['dateTanggalLahir'];
	$input_parameter['STATUS'] = $_POST['selectStatus'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	$function_result = AddPasien($input_parameter);
	
	if( $function_result['FUNCTION_RESULT'] == 1 ){
		
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
		header("Location:index.php");
		exit;
		
	} else {
		
		$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
		$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
		header("Location:add.php");
		exit;
		
	}
	
}

if( $_POST['module'] == "UpdatePasien" ){

	$input_parameter['ID'] = $_POST['currentID'];
	$input_parameter['NAMA'] = $_POST['textNama'];
	$input_parameter['ALAMAT'] = $_POST['textAlamat'];
	$input_parameter['NO_RM'] = $_POST['textNoRm'];
	$input_parameter['SEX'] = $_POST['selectSex'];
	$input_parameter['TGL_LAHIR'] = $_POST['dateTanggalLahir'];
	$input_parameter['STATUS'] = $_POST['selectStatus'];
	$input_parameter['ID_RS'] = $_POST['selectRumahSakit'];
	
	$function_result = UpdatePasienByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:detail.php?id=".$input_parameter['ID']);
	exit;
	
}

if( $_GET['module'] == "DeletePasien" ){
	
	$input_parameter['ID'] = $_GET['id'];
	
	$function_result = DeletePasienByID($input_parameter);
	
	$_SESSION['OSH']['FUNCTION_RESULT'] = $function_result['FUNCTION_RESULT'];
	$_SESSION['OSH']['SYSTEM_MESSAGE'] = $function_result['SYSTEM_MESSAGE'];
	header("Location:index.php");
	exit;
	
}

?>