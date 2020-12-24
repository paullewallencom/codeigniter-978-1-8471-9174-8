<body> 
    <?php echo validation_errors(); ?> 
    <?php echo form_open('/cust/user_details') ; ?>        
        <?php echo form_input(array('name' => 'first_name', 'value' => 'First Name', 'maxlength' => '125', 'size' => '50')); ?><br /> 
        <?php echo form_input(array('name' => 'last_name', 'value' => 'Last Name', 'maxlength' => '125', 'size' => '50')); ?><br /> 
        <?php echo form_input(array('name' => 'email', 'value' => 'Email Address', 'maxlength' => '255', 'size' => '50')); ?><br /> 
        <?php echo form_input(array('name' => 'email_confirm', 'value' => 'Confirm Email', 'maxlength' => '255', 'size' => '50')); ?><br /> 
        <?php echo form_textarea(array('name' => 'payment_address', 'value' => 'Payment Address', 'rows' => '6', 'cols' => '40', 'size' => '50')); ?><br /> 
        <?php echo form_submit('', 'Enter') ; ?><br /> 
        <?php echo form_close() ; ?> 
    </form> 
</body> 
