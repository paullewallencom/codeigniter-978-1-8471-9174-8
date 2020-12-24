<?php echo anchor ('app_cal/index', 'View Calendar') ; ?>
<a href=""></a><h2>Appointments</h2>

<?php foreach ($appointments->result() as $row) : ?>
	<?php echo date("j-m-Y",$row->app_date) ; ?><br />
	<?php echo $row->app_name ; ?><br />
	<?php echo $row->app_description ; ?>
	<hr>
<?php endforeach ; ?>
