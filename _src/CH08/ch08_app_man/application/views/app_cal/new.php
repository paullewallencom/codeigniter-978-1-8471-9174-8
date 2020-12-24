<h2>New Appointment</h2>
<h4>Appointment Name</h4>

<?php if (validation_errors()) : ?>
    <p><?php echo validation_errors() ;?></p>
<?php endif ; ?>

<?php echo form_open('app_cal/create') ; ?>
<?php echo form_input($app_name); ?>
<h4>Appointment Description</h4>
<?php echo form_input($app_description); ?>
<h4>Appointment Date</h4>
<?php echo form_dropdown('day', $days, $day); ?>
<?php echo form_dropdown('month', $months, $month); ?>
<?php echo form_dropdown('year', $years, $year); ?>


<br /><br />

<input type="submit" value="Save" />
or <?php echo anchor ('app_cal', 'Cancel') ; ?>
<?php echo form_close() ; ?>
