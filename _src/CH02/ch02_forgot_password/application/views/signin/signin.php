<?php echo form_open('signin/login') ; ?>
    <?php if (validation_errors()) : ?>
        <h3>Whoops! There was an error:</h3>
        <p><?php echo validation_errors(); ?></p>
    <?php endif; ?>

    <?php if (isset($login_fail)) : ?>
        <h3>Login Error:</h3>
        <p>Username or Password is incorrect, please try again.</p>
    <?php endif; ?>   

    <table border="0" >
        <tr>
            <td>User Email</td>
            <td><?php echo form_input(array('name' => 'email', 'id' => 'email', 'value' => set_value('email', ''), 'maxlength' => '100', 'size' => '50', 'style' => 'width:100%')); ?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><?php echo form_password(array('name' => 'password', 'id' => 'password', 'value' => set_value('password', ''), 'maxlength' => '100', 'size' => '50', 'style' => 'width:100%')); ?></td>
        </tr>
    </table>
    <?php echo form_submit('submit', 'Submit'); ?>
    or <?php echo anchor('signin', 'cancel'); ?>
    <?php echo anchor('signin/forgot_password', 'Forgot Password'); ?>
<?php echo form_close(); ?>
