<?php
/**
 * Static Header
 */
?>
<?php
global $t_em_theme_options;
if ( ( '1' == $t_em_theme_options['static-header-home-only'] && is_home() ) || '0' == $t_em_theme_options['static-header-home-only'] ) :
?>
<section id="static-header" class="jumbotron wrapper" role="info">
	<div class="container-fluid">
		<div class="row-fluid text-center">

<?php if ( ! empty ( $t_em_theme_options['static-header-img-src'] ) ) : ?>
			<div id="static-header-image" class="hidden-phone <?php echo t_em_add_bootstrap_class( 'static-header' ); ?>">
				<figure>
					<img src="<?php echo esc_url( $t_em_theme_options['static-header-img-src'] ); ?>"
						alt="<?php echo $t_em_theme_options['static-header-headline']; ?>"
						title="<?php echo $t_em_theme_options['static-header-headline']; ?>"
						class="img-rounded img-polaroid">
				</figure>
			</div><!-- #static-header-image -->
<?php endif; ?>

<?php if ( ! empty ( $t_em_theme_options['static-header-headline'] )
		|| ! empty ( $t_em_theme_options['static-header-content'] )
		|| ! empty ( $t_em_theme_options['static-header-primary-button-text'] )
		|| ! empty ( $t_em_theme_options['static-header-secondary-button-text'] )
	) : ?>
			<div id="static-header-text" class="<?php echo t_em_add_bootstrap_class( 'static-header' ); ?>">
				<h2><?php echo $t_em_theme_options['static-header-headline']; ?></h2>
				<p class="lead"><?php echo html_entity_decode( $t_em_theme_options['static-header-content'] ); ?></p>
				<div class="actions">
<?php if ( ! empty ( $t_em_theme_options['static-header-primary-button-text'] ) ) :?>
					<div class="<?php echo t_em_add_bootstrap_class( 'static-header-button' ); ?>">
					<a href="<?php echo esc_url( $t_em_theme_options['static-header-primary-button-link'] ); ?>"
						title="<?php echo esc_attr( $t_em_theme_options['static-header-primary-button-text'] ); ?>"
						class="btn btn-primary btn-large">
							<span class="<?php echo esc_attr( $t_em_theme_options['static-header-primary-button-icon-class'] ) ?>"></span>
							<?php echo esc_attr( $t_em_theme_options['static-header-primary-button-text'] ); ?></a>
					</div>
<?php endif; ?>
<?php if ( ! empty ( $t_em_theme_options['static-header-secondary-button-text'] ) ) : ?>
					<div class="<?php echo t_em_add_bootstrap_class( 'static-header-button' ); ?>">
					<a href="<?php echo esc_url( $t_em_theme_options['static-header-secondary-button-link'] ); ?>"
						title="<?php echo esc_attr( $t_em_theme_options['static-header-secondary-button-text'] ); ?>"
						class="btn btn-inverse btn-large">
							<span class="<?php echo esc_attr( $t_em_theme_options['static-header-secondary-button-icon-class'] ) ?>"></span>
							<?php echo esc_attr( $t_em_theme_options['static-header-secondary-button-text'] ); ?></a>
					</div>
<?php endif; ?>
				</div><!-- .actions -->
			</div><!-- #static-header-text -->
<?php endif; ?>

		</div><!-- .row-fluid .text-center -->
	</div><!-- .container-fluid -->
</section><!-- #static-header .jumbotron -->
<?php
endif;
?>
