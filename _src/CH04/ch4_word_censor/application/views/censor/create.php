<?php echo validation_errors() ; ?>
<?php echo form_open('censor/create');?>
	<input type="text" name="name" size="20" value="<?php echo set_value('body') ; ?>" />
	<br />
	<textarea name="body"><?php echo set_value('body') ; ?></textarea>
	<br />
<?php echo form_submit('submit','Submit!') ; ?>
<?php echo form_close() ; ?>