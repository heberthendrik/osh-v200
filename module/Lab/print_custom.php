<?php
$db = pg_pconnect("host=localhost port=5432 dbname=ehealth");

/* AMBIL DATA PASIEN */
$result = pg_query($db, "SELECT * FROM tab_lab_master where id = '" . $_GET['lid'] . "' ");
if (!$result) {
    echo "An error occurred.\n";
    exit;
}

$drr = pg_fetch_all($result);
$x_tanggal = $drr[0]['created_at'];
$x_nolab = $drr[0]['id'];
$x_norm = $drr[0]['no_rm'];
$x_nama = $drr[0]['nama'];
$x_tanggallahir = $drr[0]['tgl_lahir'];
$x_umur = $drr[0]['umur'];
$x_alamat = $drr[0]['alamat'];
$x_ruang = $drr[0]['nm_ruang'];
$x_kelas = $drr[0]['nm_kelas'];
$x_status = $drr[0]['nm_status'];
$x_dokterpengirim = $drr[0]['nm_dokter'];
$x_alamatdokter = $drr[0]['alamat_dokter'];
$x_ketklinik = $drr[0]['ket_klinik'];
$x_catatan1 = $drr[0]['catatan_1'];
$x_catatan2 = $drr[0]['catatan_2'];
$x_dokteracc = $drr[0]['nm_dokter_acc'];
$x_pemeriksa = $drr[0]['nm_pemeriksa'];
$x_idrs = $drr[0]['id_rs'];

/* AMBIL LOGO RS */
$result = pg_query($db, "SELECT * FROM tab_rs where id = '" . $x_idrs . "' ");
if (!$result) {
    echo "An error occurred.\n";
    exit;
}

$lrr = pg_fetch_all($result);
$x_logors = $lrr[0]['logo'];

/* AMBIL DATA HISTOGRAM */
$result = pg_query($db, "SELECT * FROM tab_lab_histogram where id = '" . $_GET['lid'] . "' ");
if (!$result) {
    echo "An error occurred.\n";
    exit;
}

$arr = pg_fetch_all($result);
$x_id = $_GET['lid'];
$x_idmaster = $_GET['lid'];
$x_pltvalue = $arr[0]['plt_value'];
$x_rbcvalue = $arr[0]['rbc_value'];
$x_wbcvalue = $arr[0]['wbc_value'];
?>
<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	</head>
	<body style="background:#ecedf0;font-size:13px;">

		<div class="container" style="padding-bottom:20px;">
			<div class="row" style="margin-top:15px;background:#fff;padding:18px;">
				<div class="col-lg-6">
					<img src="../../media_library/logo.png" style="height:40px;width:auto;">
				</div>
				<div class="col-lg-6">
<!-- 					logo rs -->
				</div>
			</div>
			
			
			
			
			<div class="row" style="margin-top:15px;background:#f6f6f6;border-bottom:1px solid #DADADA;border-radius:5px 5px 0 0 !important;padding:18px;">
				<table style="width:100%;">
					<tr>
						<td><?php echo $x_id;?> - <?php echo $x_nama;?></td>
						<td class="text-right"><img alt="<?php echo $x_id;?>" src="../../library/barcode.php?text=<?php echo $x_id;?>"/></td>
					</tr>
				</table>
			</div>
			
			<div class="row" style="background:#fff;padding-top:20px;">
				<div class="col-lg-12">
					<table style="width:100%;" class="table table-striped">
				        <tr>
				            <th>Tanggal</th>
				            <td><?php echo $x_tanggal;?></td>
				            <th>No. Lab</th>
				            <td><?php echo $x_id;?></td>
				            <th>Status</th>
				            <td><?php echo $x_status;?></td>
				        </tr>
				        <tr>
				            <th>No. Rekam Medis</th>
				            <td colspan="3"><?php echo $x_norm;?></td>
				            <th>Dokter Pengirim</th>
				            <td><?php echo $x_dokterpengirim;?></td>
				        </tr>
				        <tr>
				            <th>Nama</th>
				            <td colspan="3"><?php echo $x_nama;?></td>
				            <th>Alamat Dokter</th>
				            <td><?php echo $x_alamatdokter;?></td>
				        </tr>
				        <tr>
				            <th>Tanggal Lahir</th>
				            <td colspan="3"><?php echo $x_tanggallahir;?></td>
				            <th>Ket Klinik</th>
				            <td><?php echo $x_ketklinik;?></td>
				        </tr>
				        <tr>
				            <th>Umur</th>
				            <td colspan="3"><?php echo $x_umur;?></td>
				            <th>Catatan 1</th>
				            <td><?php echo $x_catatan1;?></td>
				        </tr>
				        <tr>
				            <th>Alamat</th>
				            <td colspan="3"><?php echo $x_alamat;?></td>
				            <th>Catatan 2</th>
				            <td><?php echo $x_catatan2;?></td>
				        </tr>
				        <tr>
				            <th>Ruang</th>
				            <td colspan="3"><?php echo $x_ruang;?></td>
				            <th>Dokter ACC</th>
				            <td><?php echo $x_dokteracc;?></td>
				        </tr>
				        <tr>
				            <th>Kelas</th>
				            <td colspan="3"><?php echo $x_kelas;?></td>
				            <th>Pemeriksa</th>
				            <td><?php echo $x_pemeriksa;?></td>
				        </tr>
				    </table>
				</div>
			</div>
			
			
			
			
			
			
			
			<!--
			<div class="row" style="margin-top:15px;background:#f6f6f6;border-bottom:1px solid #DADADA;border-radius:5px 5px 0 0 !important;padding:18px;">
				<div class="col-lg-12">Hasil Test Darah</div>
			</div>
			-->
			<div class="row" style="background:#fff;;padding:18px;">
				
				<table style="width:100%;" class="table">
					<tr>
						<td style="width:70%;">
							<table style="width:100%;border-color:#eee;" border="1" cellpadding="0">
								<thead>
									<tr>
										<th>Pemeriksaan</th>
										<th>Hasil</th>
										<th>Nilai Rujukan</th>
										<th>Satuan</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query_labdetail = "select * from public.tab_lab_detil where id_master = '".$_GET['lid']."'";
									$result_labdetail = pg_query($db, $query_labdetail);
									$num_labdetail = pg_num_rows($result_labdetail);
									
									while( $row_labdetail = pg_fetch_assoc($result_labdetail) ){
									
										$query_getnmlab = "select nama from tab_kdlab where id = '".$row_labdetail['id_lab']."'";
										$result_getnmlab = pg_query($db, $query_getnmlab);
										$row_getnmlab = pg_fetch_assoc($result_getnmlab);
									
										?>
										<tr>
											<td data-title="Pemeriksaan" ><?php echo $row_getnmlab['nama'];?></td>
											<td data-title="Hasil" ><b><?php echo $row_labdetail['hasil'];?></b></td>
											<td data-title="N Rujukan" ><?php echo $row_labdetail['rujukan_awal'].'-'.$row_labdetail['rujukan_akhir'];?></td>
											<td data-title="Satuan" ><?php echo $row_labdetail['satuan'];?></td>
										</tr>
										<?php	
									}
									?>
								</tbody>
							</table>
						</td>
						<td style="width:30%;">
							<div class="card-body">
										
								<?php
								
								$id = $_GET['lid'];
								
								$query_getgraphdata = "select * from public.tab_lab_histogram where id = '".$id."'";
								$result_getgraphdata = pg_query($db, $query_getgraphdata);
								$row_getgraphdata = pg_fetch_assoc($result_getgraphdata);
								$arr[0]['plt_value'] = $row_getgraphdata['plt_value'];
								$arr[0]['rbc_value'] = $row_getgraphdata['rbc_value'];
								$arr[0]['wbc_value'] = $row_getgraphdata['wbc_value'];
							
							
							    $x_pltvalue = $arr[0]['plt_value'];
							    $sanitize_x_pltvalue = str_replace('[', '', $x_pltvalue);
							    $sanitize_x_pltvalue2 = str_replace(']', '', $sanitize_x_pltvalue);
							    $array_x_pltvalue = explode(',', $sanitize_x_pltvalue2);
							
							    $plt_graph_setting['y_max'] = 30;
							    $plt_graph_setting['count_x'] = count($array_x_pltvalue);
							    $plt_graph_setting['graph_width'] = 280;
							    $plt_graph_setting['graph_height'] = 150;
							    $plt_graph_setting['graph_canvas_height'] = $plt_graph_setting['graph_height'] + 20;
							    $plt_graph_setting['y_divider'] = 3;
							    $plt_graph_setting['x_index_skipper'] = 5;
							    $plt_graph_setting['x_legend_position_adjustment'] = 2;
							    $plt_graph_setting['graph_padding_left'] = 20;
							    $plt_graph_setting['legend_y_padding_top'] = 10;
							    $plt_graph_setting['value_multiplier'] = $plt_graph_setting['graph_height'] / $plt_graph_setting['y_max'];
							    ?>
								<div style="margin-bottom:10px;"><span
							    	style="background:rgba(0, 255, 0, 0.6);margin-right:10px;padding-left:20px;padding-right:20px;border:1px solid #d6d4d4;">&nbsp;</span>PLT
									</div>
								<canvas id="plt-chart" height="<?php echo $plt_graph_setting['graph_canvas_height'];?>"
								        width="<?php echo $plt_graph_setting['graph_width'];?>"></canvas>
								<script>
								    var c = document.getElementById("plt-chart");
								    var ctx = c.getContext("2d");
								    ctx.beginPath();
								    ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>, 0);
								    ctx.lineTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
								    ctx.lineTo(<?php echo $plt_graph_setting['graph_width'] + $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
								    ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>, 0);
								    ctx.lineTo(<?php echo $plt_graph_setting['graph_width'];?>, 0);
								    ctx.stroke();
								
								    /* HORIZONTAL RULER */
								        <?php
								        for ($i = 0; $i < $plt_graph_setting['y_divider']; $i++) {
								            ?>
								        ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo ($i + 1) * ($plt_graph_setting['graph_height'] / $plt_graph_setting['y_divider']) ?>);
								        ctx.lineTo(<?php echo $plt_graph_setting['graph_width'];?>,<?php echo ($i + 1) * ($plt_graph_setting['graph_height'] / $plt_graph_setting['y_divider']) ?>);
								            <?php
								        }
								        ?>
								    ctx.strokeStyle = "#d6d4d4";
								    ctx.stroke();
								
								    /* VERTICAL RULER */
								        <?php
								        for ($i = 0; $i < $plt_graph_setting['count_x']; $i = $i + $plt_graph_setting['x_index_skipper']) {
								            ?>
								        ctx.moveTo( <?php echo ((($i) * ($plt_graph_setting['graph_width'] / $plt_graph_setting['count_x'])) + $plt_graph_setting['graph_padding_left']);?> , 0);
								        ctx.lineTo( <?php echo ((($i) * ($plt_graph_setting['graph_width'] / $plt_graph_setting['count_x'])) + $plt_graph_setting['graph_padding_left']);?> , <?php echo $plt_graph_setting['graph_height'];?>);
								            <?php
								        }
								        ?>
								    ctx.strokeStyle = "#d6d4d4";
								    ctx.stroke();
								
								
								    /* LEGEND X */
								    ctx.beginPath();
								    ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
								        <?php
								        for ($i = 0; $i < $plt_graph_setting['count_x']; $i = $i + $plt_graph_setting['x_index_skipper']) {
								            ?>
								        ctx.fillText("<?php echo $array_x_pltvalue[$i]; ?>",<?php echo (((($i) * ($plt_graph_setting['graph_width'] / $plt_graph_setting['count_x'])) - $plt_graph_setting['x_legend_position_adjustment']) + $plt_graph_setting['graph_padding_left']);?>,<?php echo $plt_graph_setting['graph_canvas_height'];?>);
								            <?php
								        }
								        ?>
								
								    /* LEGEND Y */
								        <?php
								        for ($i = 0; $i <= $plt_graph_setting['y_divider']; $i++) {
								            if ($i < $plt_graph_setting['y_divider']) {
								                ?>
								            ctx.fillText("<?php echo($plt_graph_setting['y_max'] - ($i * $plt_graph_setting['y_max'] / $plt_graph_setting['y_divider']));?>", 0,<?php echo (($i * $plt_graph_setting['graph_height'] / $plt_graph_setting['y_divider']) + $plt_graph_setting['legend_y_padding_top']); ?>);
								                <?php
								            }
								        }
								        ?>
								    ctx.strokeStyle = "#d6d4d4";
								    ctx.stroke();
								
								    /* VALUE */
								    ctx.beginPath();
								    ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
								        <?php
								        for ($i = 0; $i < $plt_graph_setting['count_x']; $i++) {
								
								            $default_pltvalue = $array_x_pltvalue[$i];
								            $reverse_pltvalue = $plt_graph_setting['graph_height'] - ($default_pltvalue * $plt_graph_setting['value_multiplier']);
								            $last_i = $i;
								            ?>
								        ctx.lineTo( <?php echo ((($i) * ($plt_graph_setting['graph_width'] / $plt_graph_setting['count_x'])) + $plt_graph_setting['graph_padding_left']);?> , <?php echo $reverse_pltvalue; ?> );
								            <?php
								        }
								        ?>
								    ctx.lineTo( <?php echo $plt_graph_setting['graph_width'];?>, <?php echo $plt_graph_setting['graph_height']; ?> );
								    ctx.stroke();
								    ctx.fillStyle = "rgba(0, 255, 0, 0.6)";
								    ctx.fill();
								
								</script>
							
							
							
							
							    <?php
							    $x_rbcvalue = $arr[0]['rbc_value'];
							    $sanitize_x_rbcvalue = str_replace('[', '', $x_rbcvalue);
							    $sanitize_x_rbcvalue2 = str_replace(']', '', $sanitize_x_rbcvalue);
							    $array_x_rbcvalue = explode(',', $sanitize_x_rbcvalue2);
							
							    $rbc_graph_setting['y_max'] = 300;
							    $rbc_graph_setting['count_x'] = count($array_x_rbcvalue);
							    $rbc_graph_setting['graph_width'] = 280;
							    $rbc_graph_setting['graph_height'] = 150;
							    $rbc_graph_setting['graph_canvas_height'] = $rbc_graph_setting['graph_height'] + 20;
							    $rbc_graph_setting['y_divider'] = 3;
							    $rbc_graph_setting['x_index_skipper'] = 6;
							    $rbc_graph_setting['x_legend_position_adjustment'] = 2;
							    $rbc_graph_setting['graph_padding_left'] = 20;
							    $rbc_graph_setting['legend_y_padding_top'] = 10;
							    $plt_graph_setting['value_multiplier'] = $rbc_graph_setting['graph_height'] / $rbc_graph_setting['y_max'];
							    ?>
								<div style="margin-top:25px;margin-bottom:10px;"><span
								    style="background:rgba(255, 0, 0, 0.6);margin-right:10px;padding-left:20px;padding-right:20px;border:1px solid #d6d4d4;">&nbsp;</span>RBC
								</div>
								<canvas id="rbc-chart" height="<?php echo $plt_graph_setting['graph_canvas_height'];?>"
								        width="<?php echo $rbc_graph_setting['graph_width'];?>"></canvas>
								<script>
								    var c = document.getElementById("rbc-chart");
								    var ctx = c.getContext("2d");
								    ctx.beginPath();
								    ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>, 0);
								    ctx.lineTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,<?php echo $rbc_graph_setting['graph_height'];?>);
								    ctx.lineTo(<?php echo $rbc_graph_setting['graph_width'] + $rbc_graph_setting['graph_padding_left'];?>,<?php echo $rbc_graph_setting['graph_height'];?>);
								    ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>, 0);
								    ctx.lineTo(<?php echo $rbc_graph_setting['graph_width'];?>, 0);
								    ctx.stroke();
								
								    /* HORIZONTAL RULER */
								        <?php
								        for ($i = 0; $i < $rbc_graph_setting['y_divider']; $i++) {
								            ?>
								        ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,<?php echo ($i + 1) * ($rbc_graph_setting['graph_height'] / $rbc_graph_setting['y_divider']) ?>);
								        ctx.lineTo(<?php echo $rbc_graph_setting['graph_width'];?>,<?php echo ($i + 1) * ($rbc_graph_setting['graph_height'] / $rbc_graph_setting['y_divider']) ?>);
								            <?php
								        }
								        ?>
								    ctx.strokeStyle = "#d6d4d4";
								    ctx.stroke();
								
								    /* VERTICAL RULER */
								        <?php
								        for ($i = 0; $i < $rbc_graph_setting['count_x']; $i = $i + $rbc_graph_setting['x_index_skipper']) {
								            ?>
								        ctx.moveTo( <?php echo ((($i) * ($rbc_graph_setting['graph_width'] / $rbc_graph_setting['count_x'])) + $rbc_graph_setting['graph_padding_left']);?> , 0);
								        ctx.lineTo( <?php echo ((($i) * ($rbc_graph_setting['graph_width'] / $rbc_graph_setting['count_x'])) + $rbc_graph_setting['graph_padding_left']);?> , <?php echo $rbc_graph_setting['graph_height'];?>);
								            <?php
								        }
								        ?>
								    ctx.strokeStyle = "#d6d4d4";
								    ctx.stroke();
								
								
								    /* LEGEND X */
								    ctx.beginPath();
								    ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,<?php echo $rbc_graph_setting['graph_height'];?>);
								        <?php
								        for ($i = 0; $i < $rbc_graph_setting['count_x']; $i = $i + $rbc_graph_setting['x_index_skipper']) {
								            ?>
								        ctx.fillText("<?php echo $array_x_rbcvalue[$i]; ?>",<?php echo (((($i) * ($rbc_graph_setting['graph_width'] / $rbc_graph_setting['count_x'])) - $rbc_graph_setting['x_legend_position_adjustment']) + $rbc_graph_setting['graph_padding_left']);?>,<?php echo $rbc_graph_setting['graph_canvas_height'];?>);
								            <?php
								        }
								        ?>
								
								    /* LEGEND Y */
								        <?php
								        for ($i = 0; $i <= $rbc_graph_setting['y_divider']; $i++) {
								            if ($i < $rbc_graph_setting['y_divider']) {
								                ?>
								            ctx.fillText("<?php echo($rbc_graph_setting['y_max'] - ($i * $rbc_graph_setting['y_max'] / $rbc_graph_setting['y_divider']));?>", 0,<?php echo (($i * $rbc_graph_setting['graph_height'] / $rbc_graph_setting['y_divider']) + $rbc_graph_setting['legend_y_padding_top']); ?>);
								                <?php
								            }
								        }
								        ?>
								    ctx.strokeStyle = "#d6d4d4";
								    ctx.stroke();
								
								    /* VALUE */
								    ctx.beginPath();
								    ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,<?php echo $rbc_graph_setting['graph_height'];?>);
								        <?php
								        for ($i = 0; $i < $rbc_graph_setting['count_x']; $i++) {
								
								            $default_rbcvalue = $array_x_rbcvalue[$i];
								            $reverse_rbcvalue = $rbc_graph_setting['graph_height'] - ($default_rbcvalue * $plt_graph_setting['value_multiplier']);
								            $last_i = $i;
								            ?>
								        ctx.lineTo( <?php echo ((($i) * ($rbc_graph_setting['graph_width'] / $rbc_graph_setting['count_x'])) + $rbc_graph_setting['graph_padding_left']);?> , <?php echo $reverse_rbcvalue; ?> );
								            <?php
								        }
								        ?>
								    ctx.lineTo( <?php echo $rbc_graph_setting['graph_width'];?>, <?php echo $rbc_graph_setting['graph_height']; ?> );
								    ctx.stroke();
								    ctx.fillStyle = "rgba(255, 0, 0, 0.6)";
								    ctx.fill();
								
								</script>
							
							
							
							
							    <?php
							    $x_wbcvalue = $arr[0]['wbc_value'];
							    $sanitize_x_wbcvalue = str_replace('[', '', $x_wbcvalue);
							    $sanitize_x_wbcvalue2 = str_replace(']', '', $sanitize_x_wbcvalue);
							    $array_x_wbcvalue = explode(',', $sanitize_x_wbcvalue2);
							
							    $wbc_graph_setting['y_max'] = 50;
							    $wbc_graph_setting['count_x'] = count($array_x_wbcvalue);
							    $wbc_graph_setting['graph_width'] = 280;
							    $wbc_graph_setting['graph_height'] = 150;
							    $wbc_graph_setting['graph_canvas_height'] = $wbc_graph_setting['graph_height'] + 20;
							    $wbc_graph_setting['y_divider'] = 5;
							    $wbc_graph_setting['x_index_skipper'] = 5;
							    $wbc_graph_setting['x_legend_position_adjustment'] = 2;
							    $wbc_graph_setting['graph_padding_left'] = 20;
							    $wbc_graph_setting['legend_y_padding_top'] = 10;
							    $plt_graph_setting['value_multiplier'] = $wbc_graph_setting['graph_height'] / $wbc_graph_setting['y_max'];
							    ?>
								<div style="margin-top:25px;margin-bottom:10px;"><span
								    style="background:rgba(255, 255, 0, 0.6);margin-right:10px;padding-left:20px;padding-right:20px;border:1px solid #d6d4d4;">&nbsp;</span>WBC
								</div>
								<canvas id="wbc-chart" height="<?php echo $plt_graph_setting['graph_canvas_height'];?>"
								        width="<?php echo $wbc_graph_setting['graph_width'];?>"></canvas>
								<script>
								    var c = document.getElementById("wbc-chart");
								    var ctx = c.getContext("2d");
								    ctx.beginPath();
								    ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>, 0);
								    ctx.lineTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,<?php echo $wbc_graph_setting['graph_height'];?>);
								    ctx.lineTo(<?php echo $wbc_graph_setting['graph_width'] + $wbc_graph_setting['graph_padding_left'];?>,<?php echo $wbc_graph_setting['graph_height'];?>);
								    ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>, 0);
								    ctx.lineTo(<?php echo $wbc_graph_setting['graph_width'];?>, 0);
								    ctx.stroke();
								
								    /* HORIZONTAL RULER */
								        <?php
								        for ($i = 0; $i < $wbc_graph_setting['y_divider']; $i++) {
								            ?>
								        ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,<?php echo ($i + 1) * ($wbc_graph_setting['graph_height'] / $wbc_graph_setting['y_divider']) ?>);
								        ctx.lineTo(<?php echo $wbc_graph_setting['graph_width'];?>,<?php echo ($i + 1) * ($wbc_graph_setting['graph_height'] / $wbc_graph_setting['y_divider']) ?>);
								            <?php
								        }
								        ?>
								    ctx.strokeStyle = "#d6d4d4";
								    ctx.stroke();
								
								    /* VERTICAL RULER */
								        <?php
								        for ($i = 0; $i < $wbc_graph_setting['count_x']; $i = $i + $wbc_graph_setting['x_index_skipper']) {
								            ?>
								        ctx.moveTo( <?php echo ((($i) * ($wbc_graph_setting['graph_width'] / $wbc_graph_setting['count_x'])) + $wbc_graph_setting['graph_padding_left']);?> , 0);
								        ctx.lineTo( <?php echo ((($i) * ($wbc_graph_setting['graph_width'] / $wbc_graph_setting['count_x'])) + $wbc_graph_setting['graph_padding_left']);?> , <?php echo $wbc_graph_setting['graph_height'];?>);
								            <?php
								        }
								        ?>
								    ctx.strokeStyle = "#d6d4d4";
								    ctx.stroke();
								
								
								    /* LEGEND X */
								    ctx.beginPath();
								    ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,<?php echo $wbc_graph_setting['graph_height'];?>);
								        <?php
								        for ($i = 0; $i < $wbc_graph_setting['count_x']; $i = $i + $wbc_graph_setting['x_index_skipper']) {
								            ?>
								        ctx.fillText("<?php echo $array_x_wbcvalue[$i]; ?>",<?php echo (((($i) * ($wbc_graph_setting['graph_width'] / $wbc_graph_setting['count_x'])) - $wbc_graph_setting['x_legend_position_adjustment']) + $wbc_graph_setting['graph_padding_left']);?>,<?php echo $wbc_graph_setting['graph_canvas_height'];?>);
								            <?php
								        }
								        ?>
								
								    /* LEGEND Y */
								        <?php
								        for ($i = 0; $i <= $wbc_graph_setting['y_divider']; $i++) {
								            if ($i < $wbc_graph_setting['y_divider']) {
								                ?>
								            ctx.fillText("<?php echo($wbc_graph_setting['y_max'] - ($i * $wbc_graph_setting['y_max'] / $wbc_graph_setting['y_divider']));?>", 0,<?php echo (($i * $wbc_graph_setting['graph_height'] / $wbc_graph_setting['y_divider']) + $wbc_graph_setting['legend_y_padding_top']); ?>);
								                <?php
								            }
								        }
								        ?>
								    ctx.strokeStyle = "#d6d4d4";
								    ctx.stroke();
								
								    /* VALUE */
								    ctx.beginPath();
								    ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,<?php echo $wbc_graph_setting['graph_height'];?>);
								        <?php
								        for ($i = 0; $i < $wbc_graph_setting['count_x']; $i++) {
								
								            $default_wbcvalue = $array_x_wbcvalue[$i];
								            $reverse_wbcvalue = $wbc_graph_setting['graph_height'] - ($default_wbcvalue * $plt_graph_setting['value_multiplier']);
								            $last_i = $i;
								            ?>
								        ctx.lineTo( <?php echo ((($i) * ($wbc_graph_setting['graph_width'] / $wbc_graph_setting['count_x'])) + $wbc_graph_setting['graph_padding_left']);?> , <?php echo $reverse_wbcvalue; ?> );
								            <?php
								        }
								        ?>
								    ctx.lineTo( <?php echo $wbc_graph_setting['graph_width'];?>, <?php echo $wbc_graph_setting['graph_height']; ?> );
								    ctx.stroke();
								    ctx.fillStyle = "rgba(255, 255, 0, 0.6)";
								    ctx.fill();
								
								</script>
								
							</div>
						</td>
					</tr>
				</table>
				
			</div>
			
		</div>
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>