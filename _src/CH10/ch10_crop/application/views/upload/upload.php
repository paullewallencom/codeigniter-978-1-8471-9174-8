<?php if ($error) : ?>
<?php echo $error ; ?>
<?php endif ; ?>

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

<?php echo form_close() ; ?>
