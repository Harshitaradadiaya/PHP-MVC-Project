<?php $customers = $this->getCustomers();?>
<button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('add');?>');Ajax.load();">Add-Customer</button>
<form method="POST" id="gridCustomer" action="">
    <table border="1px" cellpadding="4" width="100%">
        <tr>
            <th>id</th>
            <th>firstName</th>
            <th>lastName</th>
            <th>email</th>
            <th>phoneNumber</th>
            <th>password</th>
            <th>Action</th>
        </tr>
            <?php foreach($customers as $key => $value): ?>
        <tr>
            <td><input type="checkbox" value="<?php echo $value->id;?>" name="multipleDelete[]"></td>
            <td><?php echo $value->firstName;?></td>
            <td><?php echo $value->lastName;?></td>
            <td><?php echo $value->email;?></td>
            <td><?php echo $value->phoneNumber;?></td>
            <td><?php echo $value->password;?></td>
            <td>
                <button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('view', 'customer_address', ['i' => $value->id]);?>'); Ajax.load();">ADDRESS</button>
                <button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('edit', null, ['i' => $value->id]);?>'); Ajax.load();">UPDATE</button>
                <button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('delete', null, ['i' => $value->id]);?>'); Ajax.load();">DELETE</button>
            </td>
        </tr>
            <?php endforeach?>
    </table>
    <input type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('delete');?>'); Ajax.setForm('gridCustomer'); Ajax.saveForm();" value="DELETE" >

</form>    