<?php echo form_open('signin/forgot_password') ; ?>
    <?php if (validation_errors()) : ?>
        <h3>Whoops! There was an error:</h3>
        <p><?php echo validation_errors(); ?></p>
    <?php endif; ?>
    <?php if (isset($submit_success)) : ?>
        <h3>Email Sent:</h3>
        <p>An email has been sent to the address provided.</p>
    <?php endif; ?>        
    <table border="0" >
        <tr>
            <td>User Email</td>
            <td><?php echo form_input(array('name' => 'email', 'id' => 'email', 'value' => set_value('email', ''), 'maxlength' => '100', 'size' => '50', 'style' => 'width:100%')); ?></td>
        </tr>
    </table>
    <?php echo form_submit('submit', 'Submit'); ?>
    or <?php echo anchor('form', 'cancel'); ?>
<?php echo form_close(); ?>
