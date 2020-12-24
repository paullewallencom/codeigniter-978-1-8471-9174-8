<h2>Delete Appointment</h2>

<?php if (validation_errors()) : ?>
    <p><?php echo validation_errors() ;?></p>
<?php endif ; ?>

<?php echo form_open('app_cal/delete') ; ?>
<h4>Are you sure you want to delete the following appointment?</h4>

<?php echo $app_name . ' on ' . date("d-m-Y h:i:s", $app_date); ?>

<?php echo form_hidden('app_id', $id) ; ?>

<br /><br />

<input type="submit" value="Delete" />
or <?php echo anchor ('app_cal', 'Cancel') ; ?>
<?php echo form_close() ; ?>
