<?php echo form_open('signin/new_password') ; ?>
    <?php if (validation_errors()) : ?>
        <h3>Whoops! There was an error:</h3>
        <p><?php echo validation_errors(); ?></p>
    <?php endif; ?>
    <h2>Reset your password</h2>

    <table border="0" >
        <tr>
            <td>User Email</td>
            <td><?php echo form_input(array('name' => 'email', 'id' => 'email', 'value' => set_value('email', ''), 'maxlength' => '100', 'size' => '50', 'style' => 'width:100%')); ?></td>
        </tr>        
        <tr>
            <td>Password</td>
            <td><?php echo form_password(array('name' => 'password1', 'id' => 'password1', 'value' => set_value('password1', ''), 'maxlength' => '100', 'size' => '50', 'style' => 'width:100%')); ?></td>
        </tr>
        <tr>
            <td>Confirm Password</td>
            <td><?php echo form_password(array('name' => 'password2', 'id' => 'password2', 'value' => set_value('password2', ''), 'maxlength' => '100', 'size' => '50', 'style' => 'width:100%')); ?></td>
        </tr>        
        
        <?php echo form_hidden('code', $code) ; ?>
    </table>
    <?php echo form_submit('submit', 'Submit'); ?>
    or <?php echo anchor('form', 'cancel'); ?>
<?php echo form_close(); ?>
