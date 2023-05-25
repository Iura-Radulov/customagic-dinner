{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>{{ trans('messages.users') }}</a>
    <ul class="nav-dropdown-items">
       <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>{{ trans('messages.employees') }}</span></a></li>
        @if(backpack_user()->hasRole(trans('backpack::permissionmanager.admin')) )  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>{{ trans('messages.roles') }}</span></a></li>@endif
        @if(backpack_user()->hasRole(trans('backpack::permissionmanager.admin')) )  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>{{ trans('messages.permissions') }}</span></a></li>@endif

    </ul>
</li>
@if(backpack_user()->hasRole(trans('backpack::permissionmanager.admin')) )
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('division') }}"><i class="nav-icon la la-briefcase"></i> {{ trans('messages.divisions') }}</a></li>
@endif

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('menu-tupe') }}"><i class="nav-icon la la-question"></i> {{ trans('labels.menu_types') }}</a></li>
