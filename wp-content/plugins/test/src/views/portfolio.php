<p>
	<label for="client_name"><?php _e( 'Client Name', 'custom-meta-box' ); ?></label>
	<input class="large-text" type="text" name="portfolio[client_name]" value="<?php esc_attr_e( $client_name ); ?>">
	<span class="description"><?php _e( 'Enter the name of the client.', 'custom-meta-box' ); ?></span>
</p>
<p>
	<label for="client_url"><?php _e( 'URL', 'custom-meta-box' ); ?></label>
	<input class="large-text" type="url" name="portfolio[client_url]" value="<?php echo esc_url( $client_url ); ?>">
	<p class="description"><?php _e( 'Enter the URL of the client\'swebsite.', 'custom-meta-box' ); ?></p>
</p>
