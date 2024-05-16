
<?php 
    $product = $this->getProduct();
    $categories = $this->getCategories();
    $selectedCategories = $this->getSelectedCategories();
?>
<button type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('grid');?>'); Ajax.load();">BACK</button>

<?php if (is_null($product->id)) :?>
    <h1>Add Product</h1>
<?php else: ?>
    <h1>Update Product</h1>
<?php endif?>
<form method="POST" id="addProduct" action="">
    <table border="1px" cellpadding="4" width="100%">
        <tr>
            <td>name</td>
            <td><input type="text" name="product[name]" value="<?php echo $product->name; ?>"></td>
        </tr>
        <tr>
            <td>sort_description</td>
            <td><input type="text" name="product[sort_description]" value="<?php echo $product->sort_description; ?>"></td>
        </tr>
        <tr>
            <td>price</td>
            <td><input type="text" name="product[price]" value="<?php echo $product->price; ?>"></td>
        </tr>
        <tr>
            <td>categiries</td>
            <td>
                <select name="categiries[]" multiple>
                <?php foreach ($categories as $key => $category): ?>
                    <?php foreach ($selectedCategories as $key => $selectedCategory) : ?>
                        <?php if ($category->id == $selectedCategory->categoryId) {$selected = 'SELECTED';}?>
                    <?php endforeach; ?>
                    <option value="<?php echo $category->id; ?>" <?php echo !empty($selected) ? $selected : ''; ?>><?php echo $category->name; ?></option>
                    <?php unset($selected);?>
                <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>sku</td>
            <td><input type="text" name="product[sku]" value="<?php echo $product->sku; ?>"></td>
        </tr>
        <tr>
            <td>url_key</td>
            <td><input type="text" name="product[url_key]" value="<?php echo $product->url_key; ?>"></td>
        </tr>
    </table>
</form>
<input type="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('save',null, ['i'=>$product->id]); ?>'); Ajax.setForm('addProduct'); Ajax.saveForm();" value="submit">


