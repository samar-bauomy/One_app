<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{ url('/dashboard') }}" target="_blank">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{__('Dashboard')}}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{__('Telegram')}} </li>

                     <!-- Admins-->

                     {{-- @if (auth()->user()->hasRole(['super_admin', 'admin'])) --}}
                     @if (auth()->user()->hasRole('super_admin'))
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#admins-icon">
                                <div class="pull-left"><i class="fas fa-user"></i><span class="right-nav-text">{{__('Admins')}}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>

                            <ul id="admins-icon" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{route('admins.index')}}">{{__('Admins List')}}</a></li>
                            </ul>
                        </li>
                     @endif



                    <!-- Providers-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Providers-icon">
                            <div class="pull-left"><i class="fas fa-users"></i><span class="right-nav-text">{{__('Providers')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Providers-icon" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('providers.index')}}">{{__('Providers List')}}</a></li>
                        </ul>
                    </li>

                     <!-- Locations-->
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Locations-icon">
                            <div class="pull-left"><i class="fas fa-search-location"></i><span class="right-nav-text">{{__('Locations')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Locations-icon" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('locations.index')}}">{{__('Locations List')}}</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
