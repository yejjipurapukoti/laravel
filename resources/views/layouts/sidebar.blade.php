<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 99%;">
                <!-- Sidebar menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header fs-10 m-0 text-uppercase">Dashboard</li>

                    <!-- Dashboard & Admin Links -->
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
    <a href="{{ route('students.index') }}">
        <i data-feather="users"></i>
        <span>Students</span>
    </a>
</li>

                    <li><a href="{{ route('courses.index') }}"><i data-feather="layers"></i><span>Courses</span></a></li>
                    <li><a href="{{route('student.course.form')}}"><i data-feather="package"></i><span>Course Assign</span></a></li>
                    <li><a href="{{route('institutes.index')}}"><i data-feather="check-square"></i><span>Placements</span></a></li>
                    <li><a href="{{route('college_logs.index')}}"><i data-feather="users"></i><span>College Logs</span></a></li>
                    <li><a href="{{route('slider.index')}}"><i data-feather="tag"></i><span> Slider Images</span></a></li>
                    <li><a href="{{route('materials.index')}}"><i data-feather="clock"></i><span>Student Materials</span></a></li>
                    <li><a href="#"><i data-feather="check-circle"></i><span>Staff</span></a></li>

                    <!-- User-specific links -->
                    <!-- <li><a href="#"><i data-feather="user"></i><span>Products Inspection</span></a></li>
                    <li><a href="#"><i data-feather="check-square"></i><span>Inspection History</span></a></li>
                    <li><a href="#"><i data-feather="check-square"></i><span>Inspection Result</span></a></li> -->

                    <!-- Reports section -->
                    <li class="treeview">
                        <a href="#">
                            <i data-feather="grid"></i>
                            <span>Reports</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="#">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>Cycle Performance
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-Commit">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>Irregular Charging
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</aside>
