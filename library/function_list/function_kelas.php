<?php

/*==========================================

/*==========================================*/

function AddKelas($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_kelas b
	where
		b.nama = '".addslashes($input_parameter['NAMA'])."'
		and b.id_rs = '".$input_parameter['ID_RS']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Kelas (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan kelas yang lain.";
	} else {
	
		$query_add = 
		"
		insert into public.tab_kelas
		(
		nama,
		status,
		id_rs,
		created_at
		)
		values
		(
		'".addslashes($input_parameter['NAMA'])."',
		'".$input_parameter['STATUS']."',
		'".$input_parameter['ID_RS']."',
		'".date('Y-m-d H:i:s')."'
		)
		";
		
		$result_add = pg_query($db, $query_add);
		$row_add = pg_fetch_row($result_add);
		
		//echo $query_add;exit;
		
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Kelas telah berhasil ditambahkan." ;

	}
	
	return $function_result;
}

function UpdateKelasByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_kelas b
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
		$function_result['SYSTEM_MESSAGE'] = "Kelas (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan nama kelas yang lain.";
	} else {
	
		$query_update = 
		"
		update
			public.tab_kelas
		set
			nama = '".addslashes($input_parameter['NAMA'])."'
			,status = '".$input_parameter['STATUS']."'
			,id_rs = '".$input_parameter['ID_RS']."'
			,updated_at = '".date('Y-m-d H:i:s')."'
		where
			id = '".$input_parameter['ID']."'
		";

		$result_update = pg_query($db, $query_update);
	
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data kelas telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}

function DeleteKelasByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from public.tab_kelas
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = pg_query($db, $query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data kelas telah berhasil dihapus.";
	
	return $function_result;
}

function GetKelasByID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_kelas where id = '".$input_parameter['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nama']);
		$array_status[] = $row_get['status'];
		$array_idrs[] = $row_get['id_rs'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['STATUS'] = $array_status;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	
	return $grand_array;

}

function GetAllKelas(){
	global $db;
	
	if( $_SESSION['OSH']['ROLES'] == 'superadmin' ){
		$query_get = "select * from public.tab_kelas";
	} else {
		$query_get = "select * from public.tab_kelas where id_rs = '".$_SESSION['OSH']['ID_RS']."' ";
	}
	
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nama']);
		$array_status[] = $row_get['status'];
		$array_idrs[] = $row_get['id_rs'];
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['STATUS'] = $array_status;
	$grand_array['ID_RS'] = $array_idrs;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	
	return $grand_array;
}

function EmptyKelas(){
	global $db;
	
	$query_empty = 
	"
	truncate kelas;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Semua kelas point telah berhasil dihapus.";
	
	return $function_result;
}





?>