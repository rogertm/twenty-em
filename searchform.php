<form id="searchform" class="form-inline" action="<?php echo home_url( '/' ); ?>" method="get">
	<div class="input-group">
		<label class="sr-only" for="s"><?php _e( 'Search in', 't_em' ); ?> <?php echo bloginfo( 'name' ); ?></label>
		<input type="text" class="form-control" name="s" id="s" value="<?php the_search_query(); ?>" placeholder="<?php _e( 'Search', 't_em' ) ?>" />
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit" title="<?php _e( 'Search', 't_em' ) ?>">
				<span class="icomoon icomoon-search"></span>
				<span class="label-btn"><?php _e( 'Search', 't_em' ) ?></span>
			</button>
		</span>
	</div>
</form>
