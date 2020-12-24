<?php echo form_open('users/delete_user'); ?>
    <?php if (validation_errors()) : ?>
        <h3>Whoops! There was an error:</h3>
        <p><?php echo validation_errors(); ?></p>
    <?php endif; ?>
    <?php foreach ($query->result() as $row) : ?>
        <?php echo $row->first_name . ' ' . $row->last_name; ?>
        <?php echo form_submit('submit', 'Delete'); ?>
        or <?php echo anchor('users/index', 'cancel'); ?>
        <?php echo form_hidden('id', $row->id); ?>
    <?php endforeach; ?>
</form>
