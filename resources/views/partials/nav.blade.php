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
                            <li><a href="{{ url('/info') }}">ข้อมูลส่วนตัว</a></li>
                            @if (Auth::user()->role_id == "0001")
                                @if(Auth::user()->courses()->count()> 0)
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">กระบวนวิชา<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            @foreach(Auth::user()->courses()->get() as $course)
                                                <li><a href="./course/{{$course->id}}">{{ $course->id }} {{ $course->courseName }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @else
                                @if (Auth::user()->role_id != "0010")
                                    @if (Auth::user()->role_id == "1000")
                                         <li class="dropdown">
                                              <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">จัดการผู้ใช้<span class="caret"></span></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                         <li><a href="{{url('students')}}">นักศึกษา</a></li>
                                                         <li><a href="{{url('ta')}}">นักศึกษาช่วยสอน</a></li>
                                                         <li><a href="{{url('teachers')}}">อาจารย์ผู้สอน</a></li>
                                                         <li><a href="{{url('admin')}}">ผู้ดูแลระบบ</a></li>
                                                    </ul>
                                          </li>
                                        <li><a href="{{url('course')}}">จัดการกระบวนวิชา</a></li>
                                        <li><a href="{{url('course_section')}}">จัดการตอน</a></li>
                                         <li class="dropdown">
                                               <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">นำเข้าข้อมูลนักศึกษา<span class="caret"></span></a>
                                                     <ul class="dropdown-menu" role="menu">
                                                          <li><a href="{{url('students/manualimport')}}">ใช้ไฟล์</a></li>
                                                          <li><a href="{{url('students/import')}}">semiauto</a></li>
                                                          <li><a href="{{url('students/autoimport')}}">auto</a></li>

                                                     </ul>
                                          </li>
                                    @endif
                                    @if(Auth::user()->role_id == "0100")
                                    <li><a href="{{url('students')}}">รายชื่อนักศึกษา</a></li>
                                    @endif
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">จัดการการบ้าน<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">กระบวนวิชาที่1</a></li>
                                            <li><a href="#">กระบวนวิชาที่2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{url('assistants')}}">เพิ่ม TA</a></li>
                                   <!--
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">เพิ่ม TA<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">กระบวนวิชาที่1</a></li>
                                            <li><a href="#">กระบวนวิชาที่2</a></li>
                                        </ul>
                                    </li>
                                    -->
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
						{{--<li><a href="{{ url('/auth/login') }}">Login</a></li>--}}
						{{--<li><a href="{{ url('/auth/register') }}">Register</a></li>--}}
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->firstname_th . " " . Auth::user()->lastname_th }} ({{ Auth::user()->role_id }}) <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
