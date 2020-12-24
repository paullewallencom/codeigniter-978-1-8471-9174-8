<html>
	<head>
		<style type="text/css" title="currentStyle">
			@import "<?php echo $this->config->item('base_url') ; ?>application/views/DataTables-1.9.4/media/css/demo_page.css";
			@import "<?php echo $this->config->item('base_url') ; ?>application/views/DataTables-1.9.4/media/css/jquery.dataTables.css";
		</style>
		<script type="text/javascript" language="javascript" src="<?php echo $this->config->item('base_url') ; ?>application/views/DataTables-1.9.4/media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo $this->config->item('base_url') ; ?>application/views/DataTables-1.9.4/media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable();
			} );
		</script>
	</head>
	<body>
