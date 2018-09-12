<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$_GET['lid'] = '1803120001';
$id = $_GET['lid'];
echo exec("/usr/local/bin/wkhtmltoimage --width 1000 --quality 100 http://localhost/development_site/osh-v200/module/lab/print_custom.php?lid=1803120001 /Applications/MAMP/htdocs/development_site/osh-v200/media_library/hasillab/1803120001.png");
?>
<img src="http://localhost/development_site/osh-v200/media_library/hasillab/<?php echo $id;?>.png">
<script>
	window.print();
</script>