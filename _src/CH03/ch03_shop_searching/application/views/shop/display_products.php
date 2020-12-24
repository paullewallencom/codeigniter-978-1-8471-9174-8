    <?php echo form_open('shop/index') ; ?>
        <select name="cat"> 
            <?php foreach ($cat_query->result() as $cat_row) : ?> 
                <option value="<?php echo $cat_row->cat_id;?>"><?php echo $cat_row->cat_name;?></option> 
            <?php endforeach ; ?> 
        </select> 
    <?php echo form_submit('', 'Search') ; ?> 
    <?php echo form_close() ; ?> 

<body> 
    <table>
    <?php foreach ($query->result() as $row) : ?> 
        <tr>
        <td><?php echo $row->product_id ; ?></td>
        <td><?php echo $row->product_name ; ?></td>
        <td><?php echo $row->product_description ; ?></td>
        <td><?php echo anchor('shop/add/'.$row->product_id, 'Add to cart') ; ?></td>
        </tr>
    <?php endforeach ; ?> 
    </table>
</body> 
