<?php $products = $this->getProducts();?>


<div class="col-5">
    <div class="row">
        <?php foreach($products as $key => $product): ?>
	    <div class="col-9 col-md-4 col-lg-4">
	        <div class="card">
                <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title"><a href="product.html" title="View Product"><?php echo $product->name;?></a></h4>
                    <p class="card-text"><?php echo $product->price;?></p>
                    <div class="row">
                        <div class="col">
                            <a href="<?php echo $this->getUrl('addToCart', 'cart', ['i' => $product->id]);?>" class="btn btn-success btn-block">Add to cart</a>
                        </div>
                    </div>
                </div>
	        </div>
	    </div>
        <?php endforeach?>
    </div>
</div>
<!-- <div class="col-6 col-md-3 col-lg-3">
</div>
 -->