<?php echo form_open() ; ?>
	<?php echo validation_errors() ; ?>
	<?php if (isset($errors)) { echo $errors ; }  ?>
	<br />
	Name <input type="text" name="name" size="5" value="<?php echo set_value('name') ; ?>"/><br />
	Email <input type="text" name="email" size="5" value="<?php echo set_value('email') ; ?>"/><br />
	Message <br />
	<textarea name="message" rows="4" cols="20" /><?php echo set_value('message') ; ?></textarea><br />

	Please enter the string you see below
	<input type="text" name="captcha" value="" />
	<br />
	<?php echo $img ; ?>
	<br />
	<input type="submit" value="Submit" />
<?php echo form_close() ; ?>