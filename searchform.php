<form id="searchform" class="form-inline row" action="<?php echo home_url( '/' ); ?>" method="get">
	<div class="form-group">
		<label class="control-label" for="s"><?php _e( 'Search in', 't_em' ); ?> <?php echo bloginfo( 'name' ); ?></label>
		<input type="text" class="form-control col-xs-8" name="s" id="s" value="<?php the_search_query(); ?>" placeholder="<?php _e( 'Search...', 't_em' ) ?>" />
	</div>
	<div class="form-group">
		<button class="btn btn-default col-xs-4" type="submit"><span class="font-icon icon-search"></span></button>
	</div>
</form>
