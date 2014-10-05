<!doctype html>
<html>
<head>
	<title></title>
</head>
<body>
<style type="text/css">
.products {
	float: left;
}
.cart {
	float: left;
}
</style>

<div class="products">
	<ul>
		<?php foreach($products as $product) : ?>
		<li>
			<?php echo form_open('shop/add'); ?>
			<div class="name"><?php echo $product->name; ?></div>
			<div class="thumb"><?php echo img(array('src' => 'images/'.$product->image)) ?></div>
			<div class="price"><?php echo $product->price ?></div>
			<div class="option">
			<?php if($product->option_name) : ?>
				<?php echo form_label($product->option_name, 'option_'.$product->id); ?>
				<?php echo form_dropdown($product->option_name, $product->option_values,NULL,'id="option_'.$product->id.'"'); ?>
			<?php endif; ?>
			</div>
			<?php echo form_hidden('id', $product->id); ?>
			<?php echo form_submit('action', 'Add to cart'); ?>
			<?php echo form_close(); ?>
		</li>
	<?php endforeach; ?>
	</ul>
</div>

<?php if($cart = $this->cart->contents()) : ?>
<div class="cart">
	<table>
		<caption>Cart Items</caption>
		<thead>
			<tr>
				<th>Item Name</th>
				<th>Option</th>
				<th>Price</th>
				<th></th>
			</tr>
		</thead>
	<?php foreach($cart as $item): ?>
		<tr>
			<td><?php echo $item['name']; ?></td>
			<td>
				<?php 
                    if($this->cart->has_options($item['rowid']))
                    {
                        foreach($this->cart->product_options($item['rowid']) as $option => $value)
                        {
                            echo $option . ": <em>". $value . "</em>";
                        }
                    }
                ?>
			</td>
			<td>$<?php echo $item['subtotal']; ?></td>
			<td><?php echo anchor('shop/remove/'.$item['rowid'],'X'); ?></td>
		</tr>
	<?php endforeach; ?>
		<tr>
			<td colspan="2"><strong>Total</strong></td>
			<td>$<?php echo $this-> cart->total(); ?></td>
		</tr>
	</table>
</div>
<?php endif; ?>
</body>
</html>