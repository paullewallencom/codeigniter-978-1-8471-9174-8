<?php echo form_open('users/edit_user') ; ?>
    <?php if (validation_errors()) : ?>
        <h3>Whoops! There was an error:</h3>
        <p><?php echo validation_errors(); ?></p>
    <?php endif; ?>
    <table border="0" >
      <tr>
         <td>User First Name</td>
         <td><?php echo form_input($first_name); ?></td>
      </tr>   
      <tr>
         <td>User Last Name</td>
         <td><?php echo form_input($last_name); ?></td>
      </tr>
      <tr>
         <td>User Email</td>
         <td><?php echo form_input($email); ?></td>
      </tr>
      <tr>
          <td>User Is Active?</td>
          <td><?php echo form_checkbox($is_active); ?></td>
      </tr>
      <?php echo form_hidden($id); ?>
    </table>
    <?php echo form_submit('submit', 'Update'); ?>
    or <?php echo anchor('users/index', 'cancel'); ?>
<?php echo form_close(); ?>
