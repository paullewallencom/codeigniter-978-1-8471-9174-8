<?php echo form_open('shop/update_cart'); ?> 

<table cellpadding="6" cellspacing="1" style="width:50%" border="1"> 

  <tr> 
    <th>Quantity</th> 
    <th>Description</th> 
    <th>Item Price</th> 
    <th>Sub-Total</th> 
  </tr> 

  <?php $i = 1; ?> 

  <?php foreach ($this->cart->contents() as $items): ?> 

    <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?> 

    <tr> 
      <td><?php echo form_input(array('name' => $i . '[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td> 
      <td> 
        <?php echo $items['name']; ?> 

        <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?> 

          <p> 
            <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?> 

              <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br /> 

            <?php endforeach; ?> 
          </p> 

        <?php endif; ?> 

      </td> 
      <td><?php echo $this->cart->format_number($items['price']); ?></td> 
      <td>$<?php echo $this->cart->format_number($items['subtotal']); ?></td> 
    </tr> 

    <?php $i++; ?> 

  <?php endforeach; ?> 

  <tr> 
    <td colspan="2"> </td> 
    <td><strong>Total</strong></td> 
    <td>$<?php echo $this->cart->format_number($this->cart->total()); ?></td> 
  </tr> 

</table> 

<p><?php echo form_submit('', 'Update Cart'); ?></p> 
<?php echo form_close() ; ?>
