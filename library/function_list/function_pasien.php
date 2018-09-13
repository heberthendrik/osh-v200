<?php

/*==========================================

/*==========================================*/

function AddPasien($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_customer b
	where
		b.nama = '".addslashes($input_parameter['NAMA'])."'
		and b.id_rs = '".$input_parameter['ID_RS']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Pasien (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan pasien yang lain.";
	} else {
	
		$query_add = 
		"
		insert into public.tab_customer
		(
		nama,
		alamat,
		no_rm,
		sex,
		tgl_lahir,
		status,
		id_rs,
		kota,
		telepon,
		no_ktp,
		email,
		created_at
		)
		values
		(
		'".addslashes($input_parameter['NAMA'])."',
		'".addslashes($input_parameter['ALAMAT'])."',
		'".addslashes($input_parameter['NO_RM'])."',
		'".$input_parameter['SEX']."',
		'".$input_parameter['TGL_LAHIR']."',
		'".$input_parameter['STATUS']."',
		'".$input_parameter['ID_RS']."',
		'".addslashes($input_parameter['KOTA'])."',
		'".addslashes($input_parameter['TELEPON'])."',
		'".addslashes($input_parameter['NO_KTP'])."',
		'".$input_parameter['EMAIL']."',
		'".date('Y-m-d H:i:s')."'
		)
		";
		//echo $query_add;exit;
		$result_add = pg_query($db, $query_add);
		$row_add = pg_fetch_row($result_add);
		
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Pasien telah berhasil ditambahkan." ;

	}
	
	return $function_result;
}

function UpdatePasienByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_customer b
	where
		b.nama = '".addslashes($input_parameter['NAMA'])."'
		and b.id_rs = '".$input_parameter['ID_RS']."'
		and b.id != '".$input_parameter['ID']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Pasien (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan nama pasien yang lain.";
	} else {
	
		$query_update = 
		"
		update
			public.tab_customer
		set
			nama = '".$input_parameter['NAMA']."'
			, alamat = '".$input_parameter['ALAMAT']."'
			, no_rm = '".$input_parameter['NO_RM']."'
			, sex = '".$input_parameter['SEX']."'
			, id_rs = '".$input_parameter['ID_RS']."'
			, status = '".$input_parameter['STATUS']."'
			, tgl_lahir = '".$input_parameter['TGL_LAHIR']."'
			, kota = '".addslashes($input_parameter['KOTA'])."'
			, telepon = '".addslashes($input_parameter['TELEPON'])."'
			, no_ktp = '".addslashes($input_parameter['NO_KTP'])."'
			, email = '".$input_parameter['EMAIL']."'
			, updated_at = '".date('Y-m-d H:i:s')."'
		where
			id = '".$input_parameter['ID']."'
		";

		$result_update = pg_query($db, $query_update);
	
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data pasien telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}

function DeletePasienByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from public.tab_customer
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = pg_query($db, $query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data pasien telah berhasil dihapus.";
	
	return $function_result;
}

function GetPasienByID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_customer where id = '".$input_parameter['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nama']);
		$array_alamat[] = $row_get['alamat'];
		$array_kota[] = $row_get['kota'];
		$array_telepon[] = $row_get['telepon'];
		$array_status[] = $row_get['status'];
		$array_diskon[] = $row_get['diskon'];
		$array_ppn[] = $row_get['ppn'];
		$array_jatuhtempo[] = $row_get['jatuhtempo'];
		$array_norm[] = $row_get['no_rm'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		$array_idrs[] = $row_get['id_rs'];
		$array_noktp[] = $row_get['no_ktp'];
		$array_email[] = $row_get['email'];
		$array_sex[] = $row_get['sex'];
		$array_tgllahir[] = $row_get['tgl_lahir'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['ALAMAT'] = $array_alamat;
	$grand_array['KOTA'] = $array_kota;
	$grand_array['TELEPON'] = $array_telepon;
	$grand_array['STATUS'] = $array_status;
	$grand_array['DISKON'] = $array_diskon;
	$grand_array['PPN'] = $array_ppn;
	$grand_array['JATUH_TEMPO'] = $array_jatuhtempo;
	$grand_array['NO_RM'] = $array_norm;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['NO_KTP'] = $array_noktp;
	$grand_array['EMAIL'] = $array_email;
	$grand_array['SEX'] = $array_sex;
	$grand_array['TGL_LAHIR'] = $array_tgllahir;
	
	return $grand_array;

}

function GetAllPasien(){
	global $db;
	
	if( $_SESSION['OSH']['ROLES'] == 'superadmin' ){
		$query_get = "select * from public.tab_customer";
	} else {
		$query_get = "select * from public.tab_customer where id_rs = '".$_SESSION['OSH']['ID_RS']."' ";
	}
	
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nama']);
		$array_alamat[] = $row_get['alamat'];
		$array_kota[] = $row_get['kota'];
		$array_telepon[] = $row_get['telepon'];
		$array_status[] = $row_get['status'];
		$array_diskon[] = $row_get['diskon'];
		$array_ppn[] = $row_get['ppn'];
		$array_jatuhtempo[] = $row_get['jatuhtempo'];
		$array_norm[] = $row_get['no_rm'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		$array_idrs[] = $row_get['id_rs'];
		$array_noktp[] = $row_get['no_ktp'];
		$array_email[] = $row_get['email'];
		$array_sex[] = $row_get['sex'];
		$array_tgllahir[] = $row_get['tgl_lahir'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['ALAMAT'] = $array_alamat;
	$grand_array['KOTA'] = $array_kota;
	$grand_array['TELEPON'] = $array_telepon;
	$grand_array['STATUS'] = $array_status;
	$grand_array['DISKON'] = $array_diskon;
	$grand_array['PPN'] = $array_ppn;
	$grand_array['JATUH_TEMPO'] = $array_jatuhtempo;
	$grand_array['NO_RM'] = $array_norm;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['NO_KTP'] = $array_noktp;
	$grand_array['EMAIL'] = $array_email;
	$grand_array['SEX'] = $array_sex;
	$grand_array['TGL_LAHIR'] = $array_tgllahir;
	
	return $grand_array;
}

function EmptyPasien(){
	global $db;
	
	$query_empty = 
	"
	truncate pasien;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Semua pasien point telah berhasil dihapus.";
	
	return $function_result;
}





?>