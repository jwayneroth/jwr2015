		<section id="footer">
			<div class="container">
				<div class="row" id="footer-links-wrapper">
					<div class="col-sm-12 text-right">
						<nav class="clearfix">
							<ul class="list-inline">
								<li><a data-toggle="collapse" href="#contact-wrapper" id="contact-me-btn">contact me</a></li>
								<li><a href="https://github.com/jwayneroth">github</a></li>
							</ul>
						</nav>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="collapse" id="contact-wrapper">
							<h3 id="contact-result" class="text-center"></h3>
							<form class="form" id="contact-form">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="contact-name" class="col-sm-1 control-label">Name</label>
											<div class="col-sm-3">
												<input type="hidden" id="contact-pass" name="contact_pass" value="phrase">
												<input type="text" class="form-control" id="contact-name" name="contact_name" placeholder="Name">
											</div>
										</div>
										<div class="form-group">
											<label for="contact-email" class="col-sm-1 control-label">Email</label>
											<div class="col-sm-3">
												<input type="email" class="form-control" id="contact-email" name="contact_email" placeholder="Email">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="contact-message" class="col-sm-1 control-label">Message</label>
											<div class="col-sm-3">
												<textarea class="form-control" id="contact-message" name="contact_message" rows="3"></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3 col-sm-offset-1">
										<button type="submit" class="btn btn-default">Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php wp_footer(); ?>
	</body>
</html>
