<div class="page-sidebar-inner">
    <div class="page-sidebar-menu">
        <ul class="accordion-menu">
            <li class="@if(request()->routeIs('countries.*'))active @endif">
                <a href="{{ route('countries.index') }}"><i class="fa fa-map-marker"></i>
                    <span>Davlatlar</span></a>
            </li>
            <li class="@if(request()->routeIs('cities.*'))active @endif">
                <a href="{{ route('cities.index') }}"><i class="fa fa-map-signs"></i>
                    <span>Shaharlar</span></a>
            </li>
            <li class="@if(request()->routeIs('universities.*'))active @endif">
                <a href="{{ route('universities.index') }}"><i class="fa fa-university"></i>
                    <span>Universitetlar</span></a>
            </li>
            <li class="@if(request()->routeIs('directions.*'))active @endif">
                <a href="{{ route('directions.index') }}"><i class="fa fa-bar-chart"></i>
                    <span>Universitet Yo'nalishlari</span></a>
            </li>
            <li class="@if(request()->routeIs('permissions.*', 'roles.*', 'users.*')) open active @endif">
                <a href="javascript:void(0)"><i class="fa fa-cogs"></i>
                    <span>Boshqaruv</span><i class="accordion-icon fa fa-angle-left"></i></a>
                <ul class="sub-menu" style="display: block;">
                    <li class="@if(request()->routeIs('users.*'))active @endif"><a href="{{ route('users.index') }}"><i
                                class="fa fa-users"></i>Foydalanuvchilar</a>
                    </li>
                    <li class="@if(request()->routeIs('permissions.*'))active @endif"><a
                            href="{{ route('permissions.index') }}"><i class="fa fa-key"></i>Ruxsatlar</a></li>
                    <li class="@if(request()->routeIs('roles.*')) active @endif"><a
                            href="{{ route('roles.index') }}"><i class="fa fa-key"></i>Rollar</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)"><i class="fa fa-envelope-o"></i>
                    <span>Mailbox</span><span class="badge-warning ft-right">10+</span></a>
                <ul class="sub-menu">
                    <li><a href="mailbox.html">Inbox</a></li>
                    <li><a href="mailbox-message.html">View Mail</a></li>
                    <li><a href="mailbox-compose.html">Compose Mail</a></li>
                </ul>
            </li>
            <li>
                <a href="widgets.html"><i class="fa fa-object-group"></i>
                    <span>Widgets</span><span class="badge-info ft-right">Hot</span></a>
            </li>
            <li class="menu-divider mg-y-20-force"></li>
            <li class="mg-20-force menu-others">Others</li>
            <li>
                <a href="../documentation/documentation.html"><i class="fa fa-cogs"></i>
                    <span>Documentation</span></a>
            </li>
        </ul>
    </div>
    <!--================================-->
    <!-- Sidebar Information Summary -->
    <!--================================-->
    {{--    <div class="sidebar-info-summary mg-y-80">--}}
    {{--        <p class="tx-uppercase tx-white pd-x-15">Information Summary</p>--}}
    {{--        <div class="d-bock pd-x-15">--}}
    {{--            <div>--}}
    {{--                <p class="tx-10 tx-uppercase tx-spacing-1op-8 tx-white mg-b-2 space-nowrap">Memory Usage</p>--}}
    {{--                <h5 class="tx-white tx-normal mg-b-0">32.3%</h5>--}}
    {{--            </div>--}}
    {{--            <div class="progress progress-xs mb-2">--}}
    {{--                <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                <div class="progress-bar bg-teal" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="d-block pd-x-15 mg-t-20">--}}
    {{--            <div>--}}
    {{--                <p class="tx-10 tx-uppercase tx-spacing-1 tx-white mg-b-2 space-nowrap">CPU Usage</p>--}}
    {{--                <h5 class="tx-white tx-normal mg-b-0">140.05</h5>--}}
    {{--            </div>--}}
    {{--            <div class="progress progress-xs mb-2">--}}
    {{--                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="d-block pd-x-15 mg-t-20">--}}
    {{--            <div>--}}
    {{--                <p class="tx-10 tx-uppercase tx-spacing-1 tx-white mg-b-2 space-nowrap">Disk Usage</p>--}}
    {{--                <h5 class="tx-white tx-normal mg-b-0">82.02%</h5>--}}
    {{--            </div>--}}
    {{--            <div class="progress progress-xs mb-2">--}}
    {{--                <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                <div class="progress-bar bg-primary" role="progressbar" style="width: 35%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="d-block pd-x-15 mg-t-20">--}}
    {{--            <div>--}}
    {{--                <p class="tx-10 tx-uppercase tx-spacing-1 tx-white mg-b-2 space-nowrap">Daily Traffic</p>--}}
    {{--                <h5 class="tx-white tx-normal mg-b-0">2,201</h5>--}}
    {{--            </div>--}}
    {{--            <div class="progress progress-xs mb-2">--}}
    {{--                <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                <div class="progress-bar bg-teal" role="progressbar" style="width: 10%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                <div class="progress-bar bg-secondary" role="progressbar" style="width: 30%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="d-block pd-x-15 mg-t-20">--}}
    {{--            <div>--}}
    {{--                <p class="tx-10 tx-uppercase tx-spacing-1 tx-white mg-b-2 space-nowrap">Monthly Traffic</p>--}}
    {{--                <h5 class="tx-white tx-normal mg-b-0">63,584</h5>--}}
    {{--            </div>--}}
    {{--            <div class="progress progress-xs mb-2">--}}
    {{--                <div class="progress-bar bg-teal" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</div>
