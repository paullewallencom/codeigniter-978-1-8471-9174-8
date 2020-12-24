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
