<nav class="navbar navbar-default  navbar-fixed-top fix-nav" role="navigation" >
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}">E-learning</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav navbar-right">
					<li><a href="{{ url('/') }}" style="text-transform: uppercase;">Home</a></li>
					<li><a href="{{ url('about') }}" style="text-transform: uppercase;">About</a></li>
				@if (Auth::guest())						
                        <li><md-button class="md-raised md-primary" style="line-height: 30px;padding: 5px 15px 5px 15px" aria-label="Đăng nhập" href="{{ url('/login') }}">Đăng nhập</md-button></li>
                        <li><md-button class="md-raised md-warn" style="line-height: 30px;padding: 5px 15px 5px 15px" aria-label="Đăng ký" href="{{  url('/register') }}">Đăng ký</md-button></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>