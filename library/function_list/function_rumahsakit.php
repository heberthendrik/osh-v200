<?php

/*==========================================

/*==========================================*/

function AddRumahSakit($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.ID) as total_row
	from public.tab_rs b
	where
		b.nama = '".addslashes($input_parameter['NAMA'])."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Rumah Sakit (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan rumah sakit yang lain.";
	} else {
	
		$timestamp = date('Y-m-d H:i:s');
	
		$query_add = 
		"
		insert into tab_rs
		(
		nama,
		link,
		created_at
		)
		values
		(
		'".addslashes($input_parameter['NAMA'])."',
		'".addslashes($input_parameter['LINK'])."',
		'".$timestamp."'
		)
		";
		$result_add = pg_query($db, $query_add);
		
		$query_getid = "select * from tab_rs where created_at = '".$timestamp."'";
		$result_getid = pg_query($db, $query_getid);
		$row_getid = pg_fetch_assoc($result_getid);
		$new_id = $row_getid['id'];
	
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "RumahSakit telah berhasil ditambahkan." ;
		$function_result['NEW_ID'] = $new_id;
	}
	
	return $function_result;
}

function UpdateLogoRumahSakit($input_parameter){
	global $db;
	
	$query_update = "update public.tab_rs set logo = '".$input_parameter['FILENAME']."' where id = '".$input_parameter['ID']."'";
	$result_update = pg_query($db, $query_update);
	
}

function TruncateLogoRumahSakit($input_parameter){
	global $db;
	
	$query_getnamafile = "select logo from public.tab_rs where id = '".$input_parameter['ID']."'";
	$result_getnamafile = pg_query($db, $query_getnamafile);
	$row_getnamafile = pg_fetch_assoc($result_getnamafile);
	$nama_file = $row_getnamafile['logo'];

	$query_update = "update public.tab_rs set logo = null where id = '".$input_parameter['ID']."'";
	$result_update = pg_query($db, $query_update);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Logo Rumah Sakit telah berhasil dihapus." ;
	
	unlink('../../../media_library/logors/'.$input_parameter['ID'].'/'.$nama_file);
	
	return $function_result;
	
}




function UpdateRumahSakitByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.ID) as total_row
	from public.tab_rs b
	where
		b.nama = '".addslashes($input_parameter['NAMA'])."'
		and b.id != '".$input_parameter['ID']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "Rumah Sakit (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan rumah sakit yang lain.";
	} else {
	
		$query_update = 
		"
		update
			public.tab_rs
		set
			nama = '".addslashes($input_parameter['NAMA'])."',
			link = '".addslashes($input_parameter['LINK'])."'
		where
			id = '".$input_parameter['ID']."'
		";
		$result_update = pg_query($db, $query_update);

		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data rumah sakit telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}




function DeleteRumahSakitByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from public.tab_rs
	where ID = '".$input_parameter['ID']."'
	";
	$result_delete = pg_query($db,$query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data rumahsakit telah berhasil dihapus.";
	
	return $function_result;
}




function GetRumahSakitByID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_rs where id = '".$input_parameter['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nama']);
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		$array_logo[] = $row_get['logo'];
		$array_link[] = $row_get['link'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['LOGO'] = $array_logo;
	$grand_array['LINK'] = $array_link;
	
	return $grand_array;

}




function GetAllRumahSakit(){
	global $db;
	
	$query_get = "select * from public.tab_rs";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nama']);
		$array_createdat[] = $row_get['created_at'];
		$array_updatedat[] = $row_get['updated_at'];
		$array_logo[] = $row_get['logo'];
		$array_link[] = $row_get['link'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['CREATED_AT'] = $array_createdat;
	$grand_array['UPDATED_AT'] = $array_updatedat;
	$grand_array['LOGO'] = $array_logo;
	$grand_array['LINK'] = $array_link;
	
	return $grand_array;
}




function EmptyRumahSakit(){
	global $db;
	
	$query_empty = 
	"
	truncate rumahsakit;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Semua rumahsakit point telah berhasil dihapus.";
	
	return $function_result;
}





?>