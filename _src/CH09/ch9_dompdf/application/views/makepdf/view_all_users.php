<table>
<tr>
    <td>First Name</td>
    <td>Last Name</td>
    <td>Email</td>
</tr>
	<?php foreach($query->result() as $row) : ?>
	    <tr>
		<td><?php echo $row->user_firstname ; ?></td>
		<td><?php echo $row->user_lastname ; ?></td>
		<td><?php echo $row->user_email ; ?></td>
       </tr>
	<?php endforeach ; ?>
</table>
