<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>{{$targetgroupname}} | {{$currentpage}} | Varausmestari.fi </title>
		<meta name="description" content="Varausmestari on palvelu yksinkertaiseen varausten hallintaan silloin, kun päivätason varaukset riittävät. Soveltuu esim. pienten hotelleiden, urheiluseurojen ja sukuporukoiden käyttöön." />
		<meta name="keywords" content="varausmestari, varauspalvelu, varausjärjestelmä, buukkaus, varaa mökki, nollaversio" />
		<meta name="author" content="Nollaversio IT" />
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

		<link href="{{asset('css/fullcalendar.css')}}" rel="stylesheet">

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
					<li @if($currentpage == 'etusivu') class="highlight" @endif>
						<a href='{{route("jasenetusivu", ["ryhmaID" => $global_ryhmaID])}}'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe007;"></div>
							<span>Ryhmän etusivu</span>
						</a>
					</li>				
					<li @if($currentpage == 'kohdeluettelo') class="highlight" @endif>
						<a href='{{route("kohteet", ["ryhmaID" => $global_ryhmaID])}}'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe007;"></div>
							<span>Kohdeluettelo</span>
						</a>
					</li>
					
					@if($isAdmin)
					<li @if($currentpage == 'luokohde') class="highlight" @endif>
						<a href="{{route('luokohdeform', ['ryhmaID' => $global_ryhmaID])}}">
							<div class="fs1" aria-hidden="true" data-icon="&#xe0f8;"></div>
							<span>Luo uusi kohde</span>
						</a>
					</li>
					@endif

					<li @if($currentpage == 'loki') class="highlight" @endif>
						<a href="{{route('ryhmanloki', ['ryhmaID' => $global_ryhmaID])}}">
							<div class="fs1" aria-hidden="true" data-icon="&#xe0e6;"></div>
							<span>Varausloki</span>
						</a>
					</li>
					<li @if($currentpage == 'jasenet') class="highlight" @endif>
						<a href="{{route('ryhmanjasenet', ['ryhmaID' => $global_ryhmaID])}}">
							<div class="fs1" aria-hidden="true" data-icon="&#xe0f2;"></div>
							<span>Jäsenlista</span>
						</a>
					</li>
					@if($isAdmin)
					<li @if($currentpage == 'jasenhakemukset') class="highlight" @endif>
						<a href="{{route('jasenhakemukset', ['ryhmaID' => $global_ryhmaID])}}">
							<div class="fs1" aria-hidden="true" data-icon="&#xe0f8;"></div>
							<span>Jäsenhakemukset</span>
						</a>
					</li>
					
					@endif				
					<li>
						<a href="{{route('logout')}}">
							<div class="fs1" aria-hidden="true" data-icon="&#xe0f2;"></div>
							<span>Kirjaudu Ulos</span>
						</a>
					</li>

				</ul>
			</div>
			<!-- Menu End -->

			<!-- Extras starts -->
			<div class="extras">
				<div class="ex-wrapper">
					@if($isAdmin)
					<div class="alert alert-warning" style="width: 100%; padding: 0px;">
						<p style="color: white; padding: 12px;"><strong>Olet ryhmän admin!</strong></p>
					</div>	
					<div class="alert alert-danger" style="width: 100%; padding: 0px;">
						<a href="{{route('kutsujasen', ['ryhmaID' => $global_ryhmaID])}}" style="color: white; width: 100%; height: 42px; display: block; padding: 12px; ">
						
							<span><strong>Kutsu uusi jäsen!</strong></span>
						</a>
					</div>						
					@endif	
					<div class="alert alert-info">
						Ryhmässä on <strong>{{$groupmembercount}}</strong> @if($groupmembercount == 1) jäsen. @else jäsentä. @endif
					</div>
					<div class="alert alert-info">
						Ryhmässä on <strong>{{$grouptargetcount}}</strong> @if($grouptargetcount == 1) varattava kohde. @else varattavaa kohdetta. @endif
					</div>	

					<div class="alert alert-success" style="width: 100%; padding: 0px;">
					<a href="{{route('varausvaihe1', ['ryhmaID' => $global_ryhmaID])}}" style="color: white; width: 100%; height: 42px; display: block; padding: 12px; " >
						<strong>Tee varaus</strong><i class="fa fa-calendar" style="font-size: 18px; float:right;"></i> 
						</a>
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
							<h2><span>Ryhmä: {{$targetgroupname}}</span></h2>
						</div>
					</li>
					<li>
						<div class="custom-search hidden-sm hidden-xs pull-left">
							
							
						</div>
					</li>
				</ul>
				<div class="pull-right">
				
				<h4 class="hidden-sm hidden-xs" style="margin-top: 18px;"><span class="label label-info">Ryhmä: {{$targetgroupname}}</span></h4>


					<ul id="mini-nav" class="clearfix">
						<!--
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
						-->
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

							<p style="font-size: 14px;">Kirjautuneena: <strong>{{$global_username}}</strong></p>

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
						    <div class="alert alert-danger">
						    <div class="alert-body">
						    {{Session::get('operationfail')}}
						    </div>
						    </div>
						@endif
						@if (Session::has('operationsuccess'))
							<div class="alert alert-success">
						    <div class="alert-body">
						    <p>{{Session::get('operationsuccess')}}</p>
						    </div>
						    </div>
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
				Copyright <a href="http://www.nollaversio.fi">Nollaversio IT</a> 2016. Kaikki oikeudet pidätetty.
			</footer>
			<!-- Footer end -->
			
		</div>
		<!-- Dashboard Wrapper End -->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="{{asset('js/daterange/moment.js')}}"></script>
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

		<script src="{{asset('js/calendar/fullcalendar.min.js')}}"></script>

		


		<!-- Custom flot JS 
		<script src="{{asset('js/flot/custom/combine-chart.js')}}"></script>-->

		<!-- Animated Right Sidebar -->
		<script src="{{asset('js/slidebars.js')}}"></script>

		<!-- Tyny Scrollbar -->
		<script src="{{asset('js/tiny-scrollbar.js')}}"></script>

		<!-- Date Range -->
		
		<script src="{{asset('js/daterange/daterangepicker.js')}}"></script>

		<!-- Custom JS -->
		<script src="{{asset('js/custom.js')}}"></script>
		<script src="{{asset('js/custom-index.js')}}"></script>



		@yield('customJS')
	</body>
</html>