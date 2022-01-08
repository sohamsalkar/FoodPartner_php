<style>
	footer {
		padding: 0;
		margin: 0;
		margin-top: 30px;
	}

	footer .main-footer {
		padding: 20px 0;
		background: #252525;
	}

	footer ul {
		padding-left: 0;
		list-style: none;
	}

	/* Copy Right Footer */
	.footer-copyright {
		background: #222;
		padding: 5px 0;
	}

	.footer-copyright .logo {
		display: inherit;
	}

	.footer-copyright nav {
		float: right;
		margin-top: 5px;
	}

	.footer-copyright nav ul {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	.footer-copyright nav ul li {
		border-left: 1px solid #505050;
		display: inline-block;
		line-height: 12px;
		margin: 0;
		padding: 0 8px;
	}

	.footer-copyright nav ul li a {
		color: #969696;
	}

	.footer-copyright nav ul li:first-child {
		border: medium none;
		padding-left: 0;
	}

	.footer-copyright p {
		color: #969696;
		margin: 2px 0 0;
	}

	/* Footer Top */
	.footer-top {
		background: #252525;
		padding-bottom: 30px;
		margin-bottom: 30px;
		border-bottom: 3px solid #222;
	}

	/* Footer transparent */
	footer.transparent .footer-top,
	footer.transparent .main-footer {
		background: transparent;
	}

	footer.transparent .footer-copyright {
		background: none repeat scroll 0 0 rgba(0, 0, 0, 0.3);
	}

	/* Footer light */
	footer.light .footer-top {
		background: #f9f9f9;
	}

	footer.light .main-footer {
		background: #f9f9f9;
	}

	footer.light .footer-copyright {
		background: none repeat scroll 0 0 rgba(255, 255, 255, 0.3);
	}

	/* Footer 4 */
	.footer- .logo {
		display: inline-block;
	}

	/*==================== 
  Widgets 
====================== */
	.widget {
		padding: 20px;
		margin-bottom: 40px;
	}

	.widget.widget-last {
		margin-bottom: 0px;
	}

	.widget.no-box {
		padding: 0;
		background-color: transparent;
		margin-bottom: 40px;
		box-shadow: none;
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		-ms-box-shadow: none;
		-o-box-shadow: none;
	}

	.widget.subscribe p {
		margin-bottom: 18px;
	}

	.widget li a {
		color: #fff;
	}

	.widget li a:hover {
		color: #aaa;
		text-decoration: none;
	}

	.widget-title {
		margin-bottom: 20px;
	}

	.widget-title span {
		background: #839FAD none repeat scroll 0 0;
		display: block;
		height: 1px;
		margin-top: 25px;
		position: relative;
		width: 20%;
	}

	.widget-title span::after {
		background: inherit;
		content: "";
		height: inherit;
		position: absolute;
		top: -4px;
		width: 50%;
	}

	.widget-title.text-center span,
	.widget-title.text-center span::after {
		margin-left: auto;
		margin-right: auto;
		left: 0;
		right: 0;
	}

	.widget .badge {
		float: right;
		background: #7f7f7f;
	}

	.typo-light h1,
	.typo-light h2,
	.typo-light h3,
	.typo-light h4,
	.typo-light h5,
	.typo-light h6,
	.typo-light p,
	.typo-light div,
	.typo-light span,
	.typo-light small {
		color: #fff;
	}

	ul.social-footer2 {
		margin: 0;
		padding: 0;
		width: auto;
	}

	ul.social-footer2 li {
		display: inline-block;
		padding: 0;
	}

	ul.social-footer2 li a:hover {
		background-color: #ff8d1e;
	}

	ul.social-footer2 li a {
		display: block;
		height: 30px;
		width: 30px;
		text-align: center;
	}

	footer .btn {
		background-color: #ff8d1e;
		color: #fff;
	}

	footer .btn:hover,
	.btn:focus,
	.btn.active {
		background: #4b92dc;
		color: #fff;
		-webkit-box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
		-moz-box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
		-ms-box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
		-o-box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
		box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
		-webkit-transition: all 250ms ease-in-out 0s;
		-moz-transition: all 250ms ease-in-out 0s;
		-ms-transition: all 250ms ease-in-out 0s;
		-o-transition: all 250ms ease-in-out 0s;
		transition: all 250ms ease-in-out 0s;

	}

	.fa {
		display: inline-block;
		font: normal normal normal 14px/1 FontAwesome;
		background-color: #3e3e3e;
		color: #fff;
		padding: 9px;
		border-radius: 5px;
	}

	#subscribe-box .emailfield {
		margin: auto;
	}

	footer input[type="text"] {
		background: rgba(255, 255, 255, 0.075);
		padding: 10px 15px;
		color: #aaa;
		border: 3px solid rgba(0, 0, 0, 0.1);
		font-size: 14px;
		margin-bottom: 16px;
		border-radius: 5px;
		transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
		transition-delay: 0.2s;
		text-align: center;
		width: 68%;
	}

	footer input.submitbutton.ripplelink {
		background: #e67e22;
		border: 3px solid rgba(0, 0, 0, 0.1);
		color: #fff;
		border-color: #e67e22;
		box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2);
		transition-delay: 0s;
		width: 25%;
		font-size: 14px;
		/* font-weight: 700; */
		border: 0px solid;
		transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
		padding: 10px 15px;
		margin-bottom: 16px;
		border-radius: 5px;
	}

	.thumb-content ::before {
		content: "\f190";
		font-family: FontAwesome;
		font-style: normal;
		font-weight: normal;
		text-decoration: inherit;
		margin-left: 5px;
		color: #ffffff;
	}
</style>
<footer id="footer" class="footer-1">
	<div class="main-footer widgets-dark typo-light">
		<div class="container">
	
				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="widget subscribe no-box">
						<h5 class="widget-title">FoodPartner<span></span></h5>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui quidem dolorum quisquam nisi eaque cumque quos, a in eligendi, fugiat, vero quia veritatis veniam repellendus similique enim exercitationem saepe nostrum!</p>
					</div>
				</div>


				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="widget no-box">
						<h5 class="widget-title">Quick Links<span></span></h5>
						<ul class="thumbnail-widget">
							<li>
								<div class="thumb-content"><a href="#.">&nbsp;Home</a></div>
							</li>
							<li>
								<div class="thumb-content"><a href="#.">&nbsp;About Us</a></div>
							</li>
							<li>
								<div class="thumb-content"><a href="#.">&nbsp;Enquiry</a></div>
							</li>
						</ul>
					</div>
				</div>



				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="widget no-box">
						<h5 class="widget-title">Follow up<span></span></h5>
						<a href="#" class="text-decoration-none" style="margin: 0 8px 0 0;"> <i class="fab fa-facebook" style="font-size: 25px; color:#4267B2"> </i> </a>
						<a href="#" class="text-decoration-none" style="margin: 0 8px 0 0;"> <i class="fab fa-whatsapp" style="font-size: 25px; color:#128C7E"> </i> </a>
						<a href="#" class="text-decoration-none" style="margin: 0 8px 0 0;"> <i class="fab fa-instagram" style="font-size: 25px; color: #405DE6"> </i> </a>
					</div>
				</div>
				<br>
				<br>


				<div class="col-xs-12 col-sm-6 col-md-3">
					<div class="widget no-box">
						<h5 class="widget-title">Contact Us<span></span></h5>
						<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
						<div class="emailfield">
							<input type="text" name="email" value="Email">
							<input name="uri" type="hidden" value="arabiantheme">
							<input name="loc" type="hidden" value="en_US"> 
							<input class="submitbutton ripplelink" type="submit" value="Subscribe">
							</form>
						</div>
					</div>

				</div>
			
		</div>

		<div class="footer-copyright">
			<div class="container">
				<div class="col-md-12 text-center">
					<p>Copyright © 2019. All rights reserved by FoodPartner.</p>
				</div>
			</div>
		</div>
</footer>