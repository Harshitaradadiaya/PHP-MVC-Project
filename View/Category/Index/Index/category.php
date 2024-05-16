<?php $categories = $this->getCategories(); ?>
<?php $selectedCategory = $this->getSelectedCategory();?>
<style type="text/css">
  .sidenav {
        height: auto;
        padding: 15px;
      }
</style>

<div class="col-6 col-md-3 col-lg-3">
	<div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories</div>
  <ul class="list-group category_block">
    <?php foreach($categories as $key => $category):?>
    	<?php $class = (array_keys($selectedCategory)[0] == $key) ? 'list-group-item active': 'list-group-item' ?>
    <li class="<?php echo $class?>" id="<?php echo $key;?>">
      <a class="button" onclick="Ajax.setUrl('<?php echo $this->getUrl('product',null,['i' => $key]);?>'); Ajax.load();">
        <?php echo $category;?>
      </a>
    </li>
      <?php endforeach?>
  </ul>
</div>