		<section id="footer">
			<div class="container">
				<div class="row">
				<div class="col-sm-12 text-right">
					<nav>
						<ul class="list-inline">
							<li><a data-toggle="collapse" href="#contact-wrapper" id="contact-me-btn">contact me</a></li>
							<li><a href="https://github.com/jwayneroth">github</a></li>
						</ul>
					</nav>
				</div>
			</div>
			<div class="collapse" id="contact-wrapper">
				<div class="row">
					<div class="col-sm-6">
						<?php gravity_form( 1, false, false, false, null, true ); ?>
					</div>
				</div>
			</div>
			</div>
		</section>
		<?php wp_footer(); ?>
	</body>
</html>
