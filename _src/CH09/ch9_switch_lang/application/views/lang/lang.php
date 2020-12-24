<html> 
    <body> 

        <?php echo anchor('lang/change_language/fr', 'French'); ?> 
        &nbsp; 
        <?php echo anchor('lang/change_language/en', 'English'); ?> 

        <h2><?php echo $this->lang->line('form_title'); ?></h2> 
        <?php echo form_open('lang/submit'); ?> 
        <?php echo $this->lang->line('form_email'); ?> 
        <?php echo form_input(array('name' => 'email', 'id' => 'email', 'value' => '', 'maxlength' => '100', 'size' => '50', 'style' => 'width:10%')); ?> 

        <?php echo form_submit('', $this->lang->line('form_submit_button')); ?> 
        <?php echo form_close(); ?> 

    </body> 
</html> 
