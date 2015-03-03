<?php get_header(); ?>

	<section id="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div id="image-wrapper">
						<div id="canvas-wrapper"></div>
						<div id="zoom-wrapper"><div id="zoom-inner"></div></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div id="image-caption"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-md-3 col-sm-push-9 col-md-push-9">
					<div id="controls-wrapper">
						<button type="button" class="btn btn-link" aria-label="Left Align" id="zoom-button">
							<span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-link disabled" aria-label="Left Align" id="zoom-close-button">
							<span class="glyphicon glyphicon-zoom-out" aria-hidden="true"></span>
						</button>
						<!--<button type="button" class="btn btn-default" aria-label="Left Align" id="zoom-close-button">
							<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
						</button>-->
					</div>
				</div>
				<div class="col-sm-9 col-md-9 col-sm-pull-3 col-md-pull-3">
					<div class="row">
						<div class="col-sm-5">
							<h3 class="" id="title">Jonathan Roth</h3>
						</div>
						<div class="col-sm-7">
							<nav role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
							<?php wp_nav_menu(array(
								'container' => false,
								'container_class' => '',
								'menu' => __( 'The Main Menu', 'bonestheme' ),
								'menu_class' => 'nav',
								'theme_location' => 'main-nav', 
								'before' => '', 
								'after' => '',
								'link_before' => '', 
								'link_after' => '',
								'depth' => 0,
								'fallback_cb' => ''
							)); ?>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section id="main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-12">
					<div id="thumb-wrapper">

					<?php $posts = get_posts(array( 'post_type' => 'artwork', 'posts_per_page' => -1 )); ?>
					<?php $cnt = 0; ?>
					<?php foreach($posts as $post) : setup_postdata($post); ?>
								
						<?php if($cnt == 0): ?>
						<div class="row">
						<?php endif; ?>
						
						<?php $featured_img_id = get_post_thumbnail_id(); ?>
						<?php $thumb_src = wp_get_attachment_image_src( $featured_img_id, 'painting-thumb' ); ?>
						<?php $full_src = wp_get_attachment_image_src( $featured_img_id, 'painting-full'); ?>
						<?php $zoom_src  = wp_get_attachment_image_src( $featured_img_id, 'painting-zoom'); ?>
						<?php $art_title = get_post_meta( get_the_ID(), '_artwork_title', true ); ?>
						<?php $art_year = get_post_meta( get_the_ID(), '_artwork_year', true ); ?>
						<?php $art_dimensions = get_post_meta( get_the_ID(), '_artwork_dimensions', true ); ?>
						<?php $art_materials = get_post_meta( get_the_ID(), '_artwork_materials', true ); ?>
						
							<div class="col-xs-4 col-sm-2 thumb-column">
								<div class="thumb">
									<a href="<?php echo $full_src[0]; ?>" style="width:<?php echo $thumb_src[1]; ?>px;" 
										data-zoom="<?php echo $zoom_src[0]; ?>"
										data-caption="<?php echo $art_title . ', ' . $art_year . ', ' . $art_dimensions . ', ' . $art_materials; ?>"><img src="<?php echo $thumb_src[0]; ?>" width="<?php echo $thumb_src[1]; ?>" height="<?php echo $thumb_src[2]; ?>" alt=""></a>
									<div class="thumb-overlay">
										<div class="inner"><?php echo $art_title . ', ' . $art_year . '<br>' . $art_dimensions . '<br>' . $art_materials; ?></div>
									</div>
								</div>
							</div>
								
						<?php $cnt++; if($cnt >= 6): $cnt = 0; ?>
						</div><!--end thumb-row-->
						<?php endif; ?>
						
					<?php endforeach; ?>
					
					<?php if ($cnt != 0): ?>
					</div><!--end thumb-row-->
					<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<button class="btn btn-link h3" type="button" data-toggle="collapse" data-target="#contact-wrapper">Contact</button>
					<div class="collapse" id="contact-wrapper">
						<?php gravity_form( 1, false, false, false, null, true ); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>