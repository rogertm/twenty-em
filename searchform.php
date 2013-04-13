<form id="searchform" action="<?php echo home_url( '/' ); ?>" method="get">
	<fieldset>
		<label for="search"><?php _e( 'Search in', 't_em' ); ?> <?php echo bloginfo( 'name' ); ?></label>
		<input type="text" name="s" id="s" value="<?php the_search_query(); ?>" placeholder="<?php _e( 'Search...', 't_em' ) ?>" />
		<input type="image" class="submit" alt="<?php _e( 'Search', 't_em' ) ?>" src="<?php echo T_EM_THEME_DIR; ?>/images/t-em-search.png" />
	</fieldset>
</form>
