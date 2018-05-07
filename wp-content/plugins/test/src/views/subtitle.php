<p>
	<label for="subtitle"><?php _e( 'Subtitle', 'custom-meta-box' ); ?></label>
	<input class="large-text" type="text" name="custom_meta_box[subtitle]" value="<?php esc_attr_e( $subtitle ); ?>">
	<span class="description"><?php _e( 'Enter the subtitle for this post.', 'custom-meta-box' ); ?></span>
</p>
<p>
	<input type="checkbox" name="custom_meta_box[show_subtitle]" value="1" <?php checked( $show_subtitle, 1); ?> >
	<label for="show_subtitle"><?php _e( 'Show Subtitle', 'custom-meta-box' ); ?></label>
	<p class="description"><?php _e( 'Select / check the box if you want to show the subtitle for this post.', 'custom-meta-box' ); ?></p>
</p>
<p>


<label for="subtitle"><?php _e( 'Related products', 'b4b-post-addons' ); ?></label>
<select name="b4b_post_addons[productIds]" id="productIds" class="chosen-multi" multiple data-placeholder="Select one or more">

$field['options'] = $this->getProducts($field['id']);

<?php 
if (!is_array($meta)){
	$meta = array();
}
foreach ($products as $option) {
	echo '<option', in_array($option['value'],$meta) ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
	
}
?>
</select>
<br />
<span class="description"><?php _e( 'Enter the products for this post.', 'b4b-post-addons' ); ?></span>