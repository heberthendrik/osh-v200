<?php

/*==========================================

/*==========================================*/

function AddKodeLab($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_kdlab b
	where
		b.nama = '".addslashes($input_parameter['NAMA'])."'
		and b.id_rs = '".$input_parameter['ID_RS']."'
	";
	$result_check = pg_query($db, $query_check);
	$row_check = pg_fetch_assoc($result_check);
	$total_row = $row_check['total_row'];
	
	if( $total_row > 0 ){
		$function_result['FUNCTION_RESULT'] = 0;
		$function_result['SYSTEM_MESSAGE'] = "KodeLab (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan kodelab yang lain.";
	} else {
	
		$query_add = 
		"
		insert into public.tab_kdlab
		(
		nama,
		status,
		kode,
		id_rs,
		created_at
		)
		values
		(
		'".addslashes($input_parameter['NAMA'])."',
		'".$input_parameter['STATUS']."',
		'".addslashes($input_parameter['KODE'])."',
		'".$input_parameter['ID_RS']."',
		'".date('Y-m-d H:i:s')."'
		)
		";
		
		$result_add = pg_query($db, $query_add);
		$row_add = pg_fetch_row($result_add);
		
		//echo $query_add;exit;
		
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "KodeLab telah berhasil ditambahkan." ;

	}
	
	return $function_result;
}

function UpdateKodeLabByID($input_parameter){
	global $db;
	
	$query_check = 
	"
	select
		count(b.id) as total_row
	from public.tab_kdlab b
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
		$function_result['SYSTEM_MESSAGE'] = "KodeLab (".$input_parameter['NAMA'].") telah digunakan. Silahkan mencoba kembali dengan nama kodelab yang lain.";
	} else {
	
		$query_update = 
		"
		update
			public.tab_kdlab
		set
			nama = '".addslashes($input_parameter['NAMA'])."'
			,status = '".$input_parameter['STATUS']."'
			,kode = '".addslashes($input_parameter['KODE'])."'
			,id_rs = '".$input_parameter['ID_RS']."'
			,updated_at = '".date('Y-m-d H:i:s')."'
		where
			id = '".$input_parameter['ID']."'
		";

		$result_update = pg_query($db, $query_update);
	
		$function_result['FUNCTION_RESULT'] = 1;
		$function_result['SYSTEM_MESSAGE'] = "Data kodelab telah berhasil diperbaharui." ;
	}
	
	return $function_result;
}

function DeleteKodeLabByID($input_parameter){
	global $db;
	
	$query_delete = 
	"
	delete 
	from public.tab_kdlab
	where id = '".$input_parameter['ID']."'
	";
	$result_delete = pg_query($db, $query_delete);
	
	$function_result['FUNCTION_RESULT'] = 1;
	$function_result['SYSTEM_MESSAGE'] = "Data kodelab telah berhasil dihapus.";
	
	return $function_result;
}

function GetKodeLabByID($input_parameter){
	global $db;
	
	$query_get = "select * from public.tab_kdlab where id = '".$input_parameter['ID']."' ";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nama']);
		$array_grup1[] = $row_get['grup1'];
		$array_grup2[] = $row_get['grup2'];
		$array_grup3[] = $row_get['grup3'];
		$array_satuan[] = $row_get['satuan'];
		$array_nrujukan[] = $row_get['n_rujukan'];
		$array_metoda[] = $row_get['metoda'];
		$array_status[] = $row_get['status'];
		$array_kdlab[] = $row_get['kdlab'];
		$array_kdlis[] = $row_get['kd_lis'];
		$array_koma[] = $row_get['koma'];
		$array_yformat[] = $row_get['yformat'];
		$array_kddarialat[] = $row_get['kd_dari_alat'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['GRUP1'] = $array_grup1;
	$grand_array['GRUP2'] = $array_grup2;
	$grand_array['GRUP3'] = $array_grup3;
	$grand_array['SATUAN'] = $array_satuan;
	$grand_array['N_RUJUKAN'] = $array_nrujukan;
	$grand_array['METODA'] = $array_metoda;
	$grand_array['STATUS'] = $array_status;
	$grand_array['KDLAB'] =	$array_kdlab;
	$grand_array['KD_LIS'] = $array_kdlis;
	$grand_array['KOMA'] = $array_koma;
	$grand_array['YFORMAT'] = $array_yformat;
	$grand_array['KD_DARI_ALAT'] = $array_kddarialat;
	
	return $grand_array;

}

function GetAllKodeLab(){
	global $db;
	
	$query_get = "select * from public.tab_kdlab";
	$result_get = pg_query($db, $query_get);
	$num_get = pg_num_rows($result_get);

	while( $row_get = pg_fetch_assoc($result_get) ){
		
		$array_id[] = $row_get['id'];
		$array_nama[] = stripslashes($row_get['nama']);
		$array_grup1[] = $row_get['grup1'];
		$array_grup2[] = $row_get['grup2'];
		$array_grup3[] = $row_get['grup3'];
		$array_satuan[] = $row_get['satuan'];
		$array_nrujukan[] = $row_get['n_rujukan'];
		$array_metoda[] = $row_get['metoda'];
		$array_status[] = $row_get['status'];
		$array_kdlab[] = $row_get['kdlab'];
		$array_kdlis[] = $row_get['kd_lis'];
		$array_koma[] = $row_get['koma'];
		$array_yformat[] = $row_get['yformat'];
		$array_kddarialat[] = $row_get['kd_dari_alat'];
		
	}
	
	$grand_array['TOTAL_ROW'] = $num_get;
	$grand_array['ID'] = $array_id;
	$grand_array['NAMA'] = $array_nama;
	$grand_array['GRUP1'] = $array_grup1;
	$grand_array['GRUP2'] = $array_grup2;
	$grand_array['GRUP3'] = $array_grup3;
	$grand_array['SATUAN'] = $array_satuan;
	$grand_array['N_RUJUKAN'] = $array_nrujukan;
	$grand_array['METODA'] = $array_metoda;
	$grand_array['STATUS'] = $array_status;
	$grand_array['KDLAB'] =	$array_kdlab;
	$grand_array['KD_LIS'] = $array_kdlis;
	$grand_array['KOMA'] = $array_koma;
	$grand_array['YFORMAT'] = $array_yformat;
	$grand_array['KD_DARI_ALAT'] = $array_kddarialat;
	
	return $grand_array;
}

function EmptyKodeLab(){
	global $db;
	
	$query_empty = 
	"
	truncate kodelab;
	";
	$result_empty = $db->query($query_empty);
	
	$function_result['RESULT'] = 1;
	$function_result['MESSAGE'] = "Semua kodelab point telah berhasil dihapus.";
	
	return $function_result;
}





?>