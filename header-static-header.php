<?php
/**
 * Static Header
 */
?>
<?php
global $t_em_theme_options;
if ( ( '1' == $t_em_theme_options['static_header_home_only'] && is_home() ) || '0' == $t_em_theme_options['static_header_home_only'] ) :
?>
<section id="static-header" class="" role="info">
	<div class="wrapper container jumbotron">
		<div class="row text-center">
			<div class="">

<?php if ( ! empty ( $t_em_theme_options['static_header_img_src'] ) ) : ?>
			<div id="static-header-image" class="<?php echo t_em_add_bootstrap_class( 'static-header' ); ?>">
				<figure>
					<img src="<?php echo esc_url( $t_em_theme_options['static_header_img_src'] ); ?>"
						alt="<?php echo $t_em_theme_options['static_header_headline']; ?>"
						title="<?php echo $t_em_theme_options['static_header_headline']; ?>"
						class="img-rounded img-thumbnail">
				</figure>
			</div><!-- #static-header-image -->
<?php endif; ?>

<?php if ( ! empty ( $t_em_theme_options['static_header_headline'] )
		|| ! empty ( $t_em_theme_options['static_header_content'] )
		|| ! empty ( $t_em_theme_options['static_header_primary_button_text'] )
		|| ! empty ( $t_em_theme_options['static_header_secondary_button_text'] )
	) : ?>
			<div id="static-header-text" class="<?php echo t_em_add_bootstrap_class( 'static-header' ); ?>">
				<h2><?php echo $t_em_theme_options['static_header_headline']; ?></h2>
				<div class="lead"><?php echo t_em_wrap_paragraph( html_entity_decode( $t_em_theme_options['static_header_content'] ) ); ?></div>
				<div class="actions">
<?php if ( ! empty ( $t_em_theme_options['static_header_primary_button_text'] ) ) :?>
					<div class="<?php echo t_em_add_bootstrap_class( 'static-header-button' ); ?>">
					<a href="<?php echo esc_url( $t_em_theme_options['static_header_primary_button_link'] ); ?>"
						title="<?php echo esc_attr( $t_em_theme_options['static_header_primary_button_text'] ); ?>"
						class="btn <?php echo t_em_static_header_primary_btn_class(); ?>">
							<span class="<?php echo esc_attr( $t_em_theme_options['static_header_primary_button_icon_class'] ) ?>"></span>
							<?php echo esc_attr( $t_em_theme_options['static_header_primary_button_text'] ); ?></a>
					</div>
<?php endif; ?>
<?php if ( ! empty ( $t_em_theme_options['static_header_secondary_button_text'] ) ) : ?>
					<div class="<?php echo t_em_add_bootstrap_class( 'static-header-button' ); ?>">
					<a href="<?php echo esc_url( $t_em_theme_options['static_header_secondary_button_link'] ); ?>"
						title="<?php echo esc_attr( $t_em_theme_options['static_header_secondary_button_text'] ); ?>"
						class="btn <?php echo t_em_static_header_secondary_btn_class(); ?>">
							<span class="<?php echo esc_attr( $t_em_theme_options['static_header_secondary_button_icon_class'] ) ?>"></span>
							<?php echo esc_attr( $t_em_theme_options['static_header_secondary_button_text'] ); ?></a>
					</div>
<?php endif; ?>
				</div><!-- .actions -->
			</div><!-- #static-header-text -->
<?php endif; ?>
			</div>
		</div><!-- .row .text-center -->
	</div><!-- -->
</section><!-- #static-header .container -->
<?php
endif;
?>
