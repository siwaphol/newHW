<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">CS CMU MIS</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
                    @if (!Auth::guest())
                        <li><a href="{{ url('/') }}">หน้าหลัก</a></li>
                        <li><a href="{{ url('/') }}">ข้อมูลส่วนตัว</a></li>
                        @if (Auth::user()->role == "student")
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">กระบวนวิชา<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">กระบวนวิชาที่1</a></li>
                                    <li><a href="#">กระบวนวิชาที่2</a></li>
                                </ul>
                            </li>
                        @else
                            @if (Auth::user()->role != "ta")
                                @if (Auth::user()->role == "admin")
                                    <li><a href="{{ url('/') }}">จัดการข้อมูลผู้ใช้</a></li>
                                    <li><a href="{{ url('/') }}">จัดการกระบวนวิชา</a></li>
                                @endif
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">จัดการการบ้าน<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">กระบวนวิชาที่1</a></li>
                                        <li><a href="#">กระบวนวิชาที่2</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">เพิ่ม TA<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">กระบวนวิชาที่1</a></li>
                                        <li><a href="#">กระบวนวิชาที่2</a></li>
                                    </ul>
                                </li>
                            @endif
                            {{--@if (Auth::user()->role == "ta")--}}

                            {{--@endif--}}
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">สรุปผลการบ้าน<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">กระบวนวิชาที่1</a></li>
                                    <li><a href="#">กระบวนวิชาที่2</a></li>
                                </ul>
                            </li>
                        @endif
                    @endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} ({{ Auth::user()->role }}) <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>