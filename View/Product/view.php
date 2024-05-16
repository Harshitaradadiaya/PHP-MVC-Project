
    <button onclick="Ajax.setUrl('<?php echo $this->getUrl("add");?>'); Ajax.load();">ADD_PRODUCTS</button>
    <?php  $messages = $this->getMessage();?>
    <?php if(!is_null($messages)): ?>
        <?php foreach ($messages as $key => $message): ?>
            <div class="<?php echo $key?>"><?php echo $message; ?></div>
        <?php endforeach; ?>
    <?php endif;?>
    <form method="POST" id="gridProduct" action="">
        <table border="1px" cellpadding="4" width="100%">
            <tr>
                <th>id</th>
                <th>name</th>
                <th>sort_description</th>
                <th>sku</th>
                <th>price</th>
                <th>url_key</th>
                <th>Action</th>
            </tr>
            <?php if (!$products = $this->getProducts()):?>
                <?php echo 'NO RECORD FOUND !!'?>
            <?php else:?>
                <?php foreach($products as $key => $product):?>
                <tr>
                    <td><input type="checkbox" name="multipalDelete[]" value="<?php echo $product->id;?>"></td>
                    <td><?php echo $product->name;?></td>
                    <td><?php echo $product->sort_description;?></td>
                    <td><?php echo $product->sku;?></td>
                    <td><?php echo $product->price;?></td>
                    <td><?php echo $product->url_key;?></td>
                    <td>
                    <button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('mediaGallery', 'product_image',['i'=>$product->id]);?>'); Ajax.load();">MEDIA-GALLERY</button>
                    <button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('edit',null,['i'=>$product->id]);?>'); Ajax.load();">UPDATE</button>
                    <button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('delete',null,['i'=>$product->id]);?>'); Ajax.load();">DELETE</button>
                    </td>
                </tr>
                <?php endforeach?>
            <?php endif?>
        </table>
        <input type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('delete'); ?>'); Ajax.setForm('gridProduct'); Ajax.saveForm();" value="DELETE">
    </form>
