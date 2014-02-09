<form id="searchform" action="<?php echo home_url( '/' ); ?>" method="get">
	<fieldset class="input-append row">
		<label for="search"><?php _e( 'Search in', 't_em' ); ?> <?php echo bloginfo( 'name' ); ?></label>
		<input type="text" class="span11" name="s" id="s" value="<?php the_search_query(); ?>" placeholder="<?php _e( 'Search...', 't_em' ) ?>" />
		<button type="submit" class="btn"><span class="icon-search"></span></button>
	</fieldset>
</form>
