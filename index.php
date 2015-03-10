<?php get_header(); ?>

	<section id="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-10 text-center" id="banner-main-col">
					<div id="image-wrapper">
						<div id="canvas-wrapper"><canvas width="1170" height="720" id="jwr-canvas"></canvas></div>
						<div id="zoom-wrapper">
							<div id="zoom-inner"></div>
						</div>
						<div id="image-loader"><img src="<?php echo get_template_directory_uri(); ?>/library/images/ajax-loader.gif" width="16" height="16" alt="loading"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-10">
					<div id="image-caption"></div>
				</div>
			</div>
			<div class="row" id="banner-title-row">
				<div class="col-xs-4 col-md-4 col-xs-push-6 col-md-push-6">
					<div class="clearfix" id="controls-wrapper">
						<button type="button" class="btn btn-link" aria-label="Left Align" id="zoom-button">
							<span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-link disabled" aria-label="Left Align" id="zoom-close-button">
							<span class="glyphicon glyphicon-zoom-out" aria-hidden="true"></span>
						</button>
					</div>
				</div>
				<div class="col-xs-6 col-md-6 col-xs-pull-4 col-md-pull-4">
					<h3 class="" id="title">Jonathan Roth</h3>
				</div>
			</div>
		</div>
	</section>
	
	<section id="main">
		<div class="container">
			<div class="row thumb-row">
				<div class="col-xs-10 col-md-10">
					<div id="thumb-wrapper">

					<?php $posts = get_posts(array( 'post_type' => 'artwork', 'posts_per_page' => -1 )); ?>
					<?php $cnt = 0; ?>
					<?php foreach($posts as $post) : setup_postdata($post); ?>
								
						<?php if($cnt == 0): ?>
						<div class="row">
						<?php endif; ?>
						
						<?php $pid = get_the_ID(); ?>
						<?php $featured_img_id = get_post_thumbnail_id(); ?>
						<?php $thumb_src = wp_get_attachment_image_src( $featured_img_id, 'painting-thumb' ); ?>
						<?php $full_src = wp_get_attachment_image_src( $featured_img_id, 'painting-full'); ?>
						<?php $zoom_src  = wp_get_attachment_image_src( $featured_img_id, 'painting-zoom'); ?>
						<?php $art_title = get_post_meta( $pid, '_artwork_title', true ); ?>
						<?php $art_year = get_post_meta( $pid, '_artwork_year', true ); ?>
						<?php $art_dimensions = get_post_meta( $pid, '_artwork_dimensions', true ); ?>
						<?php $art_materials = get_post_meta( $pid, '_artwork_materials', true ); ?>
						<?php $col_top = (100 - $thumb_src[2]) / 2; ?>
						<?php $data_caption = ($art_title != '') ? $art_title . ', ' : ''; ?>
						<?php $data_caption .=  ($art_year != '') ? $art_year . ', ' : ''; ?>
						<?php $data_caption .=  ($art_dimensions != '') ? $art_dimensions . ', ' : ''; ?>
						<?php $data_caption .=  ($art_materials != '') ? $art_materials : ''; ?>
						<?php $html_caption = ($art_title != '') ? $art_title . ', ' : ''; ?>
						<?php $html_caption .=  $art_year . '<br>'; ?>
						<?php $html_caption .=  $art_dimensions . '<br>'; ?>
						<?php $html_caption .=  $art_materials . '<br>'; ?>
						
							<div class="col-xs-5 col-sm-2 thumb-column">
								<div class="thumb">
									<a href="<?php echo $full_src[0]; ?>" style="width:<?php echo $thumb_src[1]; ?>px;" 
										data-zoom="<?php echo $zoom_src[0]; ?>"
										data-caption="<?php echo $data_caption; ?>"><img src="<?php echo $thumb_src[0]; ?>" width="<?php echo $thumb_src[1]; ?>" height="<?php echo $thumb_src[2]; ?>" alt="<?php echo $art_title; ?>" style="margin-top:<?php echo $col_top; ?>px;"></a>
									<div class="thumb-overlay">
										<div class="inner"><?php echo $html_caption; ?></div>
									</div>
								</div>
								<?php edit_post_link(); ?>
							</div>
								
						<?php $cnt++; ?>
						
						<?php if($cnt == 2) : ?>
						<div class="clearfix visible-xs-block"></div>
						<?php endif; ?>
						
						<?php //if($cnt >= 5): $cnt = 0; ?>
						<!--</div>--><!--end thumb-row-->
						<?php //endif; ?>
						
					<?php endforeach; ?>
					
					<?php //if ($cnt != 0): ?>
					</div><!--end thumb-row-->
					<?php //endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>