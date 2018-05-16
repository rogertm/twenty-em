<?php
/**
 * Twenty'em WordPress Framework.
 *
 * WARNING: This file is part of Twenty'em WordPress Framework.
 * DO NOT edit this file under any circumstances. Do all your modifications in the form of a child theme.
 *
 * @package			WordPress
 * @subpackage		Twenty'em
 * @author			RogerTM
 * @license			license.txt
 * @link			https://themingisprose.com/twenty-em
 * @since 			Twenty'em 1.3.1
 */

/**
 * Display Jumbotron template for static header
 */
?>
<section id="static-header" class="jumbotron <?php echo t_em( 'static_header_template' ) ?>" role="info">
	<div class="<?php t_em_container(); ?>">
	<?php
	/**
	 * Fires before the static header section. Full width;
	 *
	 * @since Twenty'em 1.1
	 */
	do_action( 't_em_action_static_header_before' );
	?>
		<div id="static-header-inner" class="row">
	<?php
	/**
	 * Fires in and before the static header section. Full width;
	 *
	 * @since Twenty'em 1.1
	 */
	do_action( 't_em_action_static_header_inner_before' );
	?>
	<?php 	if ( ! empty ( t_em( 'static_header_img_src' ) ) ) : ?>
			<div id="static-header-image" <?php t_em_breakpoint( 'static-header' ); ?>>
				<img src="<?php echo t_em( 'static_header_img_src' ); ?>"
					alt="<?php echo sanitize_text_field( t_em( 'static_header_headline' ) ); ?>">
			</div><!-- #static-header-image -->
	<?php 	endif; ?>

	<?php 	if ( t_em( 'static_header_headline' )
			|| t_em( 'static_header_content' )
			|| ( t_em( 'static_header_primary_button_text' ) && t_em( 'static_header_primary_button_link' ) )
			|| ( t_em( 'static_header_secondary_button_text' ) && t_em( 'static_header_secondary_button_link' ) )
		) : ?>
			<div id="static-header-text" <?php t_em_breakpoint( 'static-header' ); ?>>
	<?php 	if ( t_em( 'static_header_headline' ) ) : ?>
				<header><h2><?php echo t_em( 'static_header_headline' ); ?></h2></header>
	<?php 	endif; ?>
	<?php 	if ( t_em( 'static_header_content' ) ) : ?>
				<div class="static-header-content"><?php echo t_em_wrap_paragraph( t_em( 'static_header_content' ) ); ?></div>
	<?php 	endif; ?>
				<footer class="actions">
	<?php 	if ( ( t_em( 'static_header_primary_button_text' ) && t_em( 'static_header_primary_button_link' ) ) ) : ?>
					<a href="<?php echo t_em( 'static_header_primary_button_link' ); ?>"
						class="btn btn-primary">
							<span class="<?php echo t_em( 'static_header_primary_button_icon_class' ) ?>"></span>
							<span class="button-text"><?php echo t_em( 'static_header_primary_button_text' ); ?></span>
						</a>
	<?php 	endif; ?>
	<?php 	if ( ( t_em( 'static_header_secondary_button_text' ) && t_em( 'static_header_secondary_button_link' ) ) ) : ?>
					<a href="<?php echo t_em( 'static_header_secondary_button_link' ); ?>"
						class="btn btn-secondary">
							<span class="<?php echo t_em( 'static_header_secondary_button_icon_class' ) ?>"></span>
							<span class="button-text"><?php echo t_em( 'static_header_secondary_button_text' ); ?></span>
						</a>
	<?php 	endif; ?>
				</footer><!-- .actions -->
			</div><!-- #static-header-text -->
	<?php 	endif; ?>
	<?php
	/**
	 * Fires in and after the static header section. Full width;
	 *
	 * @since Twenty'em 1.1
	 */
	do_action( 't_em_action_static_header_inner_after' );
	?>
		</div>
	<?php
	/**
	 * Fires after the static header section. Full width;
	 *
	 * @since Twenty'em 1.1
	 */
	do_action( 't_em_action_static_header_after' );
	?>
	</div>
</section><!-- #static-header .container -->