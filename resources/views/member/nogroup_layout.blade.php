<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Cloud Admin Dashboard</title>
		<meta name="description" content="Cloud Admin Panel" />
		<meta name="keywords" content="Admin, Dashboard, Bootstrap3, Sass, transform, CSS3, HTML5, Web design, UI Design, Responsive Dashboard, Responsive Admin, Admin Theme, Best Admin UI, Bootstrap Theme, Bootstrap, Light weight Admin Dashboard,Light weight, Light weight Admin, Light weight Dashboard" />
		<meta name="author" content="Bootstrap Gallery" />
		<link rel="shortcut icon" href="img/favicon.ico">
		
		<!-- Bootstrap CSS -->
		<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" media="screen">

		<!-- Animate CSS -->
		<link href="{{asset('css/animate.css')}}" rel="stylesheet" media="screen">

		<!-- date range -->
		<link rel="stylesheet" type="text/css" href="{{asset('css/daterange.css')}}">

		<!-- Main CSS -->
		<link href="{{asset('css/main.css')}}" rel="stylesheet" media="screen">

		<!-- Slidebar CSS -->
		<link rel="stylesheet" type="text/css" href="{{asset('css/slidebars.css')}}">

		<!-- Font Awesome -->
		<link href="{{asset('fonts/font-awesome.min.css')}}" rel="stylesheet">

		<!-- Metrize Fonts -->
		<link href="{{asset('fonts/metrize.css')}}" rel="stylesheet">

		<!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->

	</head>  

	<body>

		<!-- Left sidebar start -->
		<aside id="sidebar">

			<!-- Logo starts -->
			<a href="#" class="logo">
				<img src="{{asset('img/logo.png')}}" alt="logo">
			</a>
			<!-- Logo ends -->

			<!-- Menu start -->
			<div id='menu'>
				<ul>
					<li class='highlight'>
						<a href='/'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe007;"></div>
							<span>Hae ryhmän jäsenyyttä</span>
						</a>
					</li>


				</ul>
			</div>
			<!-- Menu End -->

			<!-- Extras starts -->
			<div class="extras">
				<div class="ex-wrapper">
					<div class="alert alert-danger">
						Varausmestarin käyttö vaatii, että olet jäsen varausryhmässä. Aloita
						etsimällä haluamasi ryhmä ja hae sen jäsenyyttä.
					</div>
				
				</div>
			</div>
			<!-- Extras ends -->

		</aside>
		<!-- Left sidebar end -->

		<!-- Dashboard Wrapper Start -->
		<div class="dashboard-wrapper">

			<!-- Header start -->
			<header>
				<ul class="pull-left" id="left-nav">
					<li class="hidden-lg hidden-md hidden-sm">
						<div class="logo-mob clearfix">
							<h2><div class="fs1" aria-hidden="true" data-icon="&#xe0db;"></div><span>jee</span></h2>
						</div>
					</li>
					<li>
						<div class="custom-search hidden-sm hidden-xs pull-left">
							
							<h3>{{$targetgroupname}}</h3>
						</div>
					</li>
				</ul>
				<div class="pull-right">
					<ul id="mini-nav" class="clearfix">
						<li class="list-box hidden-xs">
							<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
								<div class="fs1" aria-hidden="true" data-icon="&#xe129;"></div>
							</a>
							<span class="info-label red-bg animated rubberBand">7</span>
							<ul class="dropdown-menu flipInX animated messages">
								<li class="dropdown-header">You have 7 messages</li>
								<li>
									<div class="icon">
										<img src="img/admin10.png" alt="Browser">
									</div>
									<div class="details">
										<strong class="text-danger">Willams</strong>
										<span>Firefox is a free, open-source web browser from Mozilla.</span>
									</div>
								</li>
								<li>
									<div class="icon">
										<img src="img/admin6.png" alt="Browser">
									</div>
									<div class="details">
										<strong class="text-info">Sunny</strong>
										<span>Internet Explorer is a free web browser from Microsoft.</span>
									</div>
								</li>
								<li>
									<div class="icon">
										<img src="img/admin3.png" alt="Browser">
									</div>
									<div class="details">
										<strong class="text-info">James</strong>
										<span>Safari is known for its sleek design and ease of use.</span>
									</div>
								</li>
							</ul>
						</li>
						<li class="list-box hidden-xs">
							<a id="drop2" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
								<div class="fs1" aria-hidden="true" data-icon="&#xe0e3;"></div>
							</a>
							<span class="info-label blue-bg animated rubberBand">3</span>
							<ul class="dropdown-menu fadeInUp animated messages">
								<li class="dropdown-header">Recent Chat</li>
								<div class="chats clearfix">
									<p class="chat them">
									James, I'm going to be a little late.
									</p>
									<p class="chat me">
									S'Okay, Dude. You know your lines...?
									</p>
									<p class="chat them">
									I know em, I don't know what order they come in...
									</p>
									<p class="chat me">
									We'll work it out...
									</p>
								</div>
							</ul>
						</li>
						<li class="list-box hidden-xs dropdown">
							<a id="drop3" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
								<div class="fs1" aria-hidden="true" data-icon="&#xe0ca;"></div>
							</a>
							<span class="info-label green-bg animated rubberBand">6</span>
							<ul class="flipInX animated dropdown-menu stats-widget clearfix">
							<li>
								<h5 class="text-success">$37895</h5>
								<p>Revenue <span class="text-success">+2%</span></p>
								<div class="progress progress-xs">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
										<span class="sr-only">40% Complete (success)</span>
									</div>
								</div>
							</li>
							<li>
								<h5 class="text-info">47,892</h5>
								<p>Downloads <span class="text-info">+39%</span></p>
								<div class="progress progress-xs">
									<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
										<span class="sr-only">40% Complete (info)</span>
									</div>
								</div>
							</li>
							<li>
								<h5 class="text-danger">28214</h5>
								<p>Uploads <span class="text-danger">-7%</span></p>
								<div class="progress progress-xs">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
										<span class="sr-only">40% Complete (danger)</span>
									</div>
								</div>
							</li>
						</ul>
						</li>
						<li class="list-box hidden-xs dropdown">
							<a id="drop1" href="#" role="button" class="dropdown-toggle current-user" data-toggle="dropdown">
								Sandy <b class="caret"></b>
							</a>
							<ul class="dropdown-menu sm fadeInUp animated messages">
								<li class="dropdown-content">
									<a href="#">Edit Profile</a>
									<a href="#">Change Password</a>
									<a href="#">Settings</a>
									<a href="login.html">Logout</a>
								</li>
							</ul>
						</li>
						<li class="list-box hidden-lg hidden-md hidden-sm" id="mob-nav">
							<a href="#">
								<i class="fa fa-reorder"></i>
							</a>
						</li>
					</ul>
				</div>
			</header>
			<!-- Header ends -->

			<!-- Right sidebar start -->

			<!-- Right sidebar end -->

			<!-- Main Container Start -->
			<div class="main-container">

				<!-- Top Bar Starts -->
				<div class="top-bar clearfix">
					<div class="page-title">
						<h4><div class="fs1" aria-hidden="true" data-icon="&#xe007;"></div>@yield('pagename')</h4>
					</div>
					<ul class="right-stats hidden-xs" id="mini-nav-right">
						<li class="reportrange btn btn-success">
							<i class="fa fa-calendar"></i>
							<span></span> <b class="caret"></b>
						</li>
						<li>
							<a href="#" class="btn btn-info sb-open-right  sb-close">
								<div class="fs1" aria-hidden="true" data-icon="&#xe06a;"></div>
							</a>
						</li>
					</ul>
				</div>
				<!-- Top Bar Ends -->

				<!-- Container fluid Starts -->
				<div class="container-fluid">

					<!-- Spacer starts -->
					<div class="spacer-xs">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif

						@if (Session::has('operationfail'))
						    <p>{{Session::get('operationfail')}}</p>
						@endif
						@if (Session::has('operationsuccess'))
						    <p>{{Session::get('operationsuccess')}}</p>
						@endif						
						<!-- Row Starts -->
						@yield('content')
						<div class="row no-gutter">

						</div>
						<!-- Row Ends -->


					</div>
					<!-- Spacer ends -->

				</div>
				<!-- Container fluid ends -->

			</div>
			<!-- Main Container Start -->

			<!-- Footer Start -->
			<footer>
				Copyright Cloud Admin <span>2015</span>. All Rights Reserved.
			</footer>
			<!-- Footer end -->
			
		</div>
		<!-- Dashboard Wrapper End -->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="{{asset('js/jquery.js')}}"></script>

		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="{{asset('js/bootstrap.min.js')}}"></script>

		<!-- Flot Charts 
		<script src="js/flot/jquery.flot.js"></script>
		<script src="js/flot/jquery.flot.time.js"></script>
		<script src="js/flot/jquery.flot.selection.js"></script>
		<script src="js/flot/jquery.flot.resize.js"></script>
		<script src="js/flot/jquery.flot.tooltip.js"></script>
		<script src="js/flot/flot.excanvas.min.js"></script>
		-->

		<!-- Custom flot JS -->
		<script src="{{asset('js/flot/custom/combine-chart.js')}}"></script>

		<!-- Animated Right Sidebar -->
		<script src="{{asset('js/slidebars.js')}}"></script>

		<!-- Tyny Scrollbar -->
		<script src="{{asset('js/tiny-scrollbar.js')}}"></script>

		<!-- Date Range -->
		<script src="{{asset('js/daterange/moment.js')}}"></script>
		<script src="{{asset('js/daterange/daterangepicker.js')}}"></script>

		<!-- Custom JS -->
		<script src="{{asset('js/custom.js')}}"></script>
		<script src="{{asset('js/custom-index.js')}}"></script>
	</body>
</html>