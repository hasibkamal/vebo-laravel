<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none vebo-portal-logo-bg">
        <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#full') }}"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#signet') }}"></use>
        </svg>
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav vebo-nav-bg">
        <li class="c-sidebar-nav-item vebo-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link vebo-nav-link"
                :href="route('admin.dashboard')"
                :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="fa-solid fa-house vebo-menu-icon"
                :text="__('Dashboard')" />
        </li>
        <li class="c-sidebar-nav-item vebo-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link vebo-nav-link"
                :href="route('admin.sales-companies.index')"
                :active="activeClass(Route::is('sales-companies.index'), 'c-active')"
                icon="fa-solid fa-briefcase vebo-menu-icon"
                :text="__('Sales Companies')" />
        </li>
        <li class="c-sidebar-nav-item vebo-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link vebo-nav-link"
                :href="route('admin.sales-companies-admin.index')"
                :active="activeClass(Route::is('sales-companies.index'), 'c-active')"
                icon="fa-solid fa-users vebo-menu-icon"
                :text="__('Sales Companies Admins')" />
        </li>

        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.user.list') ||
                $logged_in_user->can('admin.access.user.deactivate') ||
                $logged_in_user->can('admin.access.user.reactivate') ||
                $logged_in_user->can('admin.access.user.clear-session') ||
                $logged_in_user->can('admin.access.user.impersonate') ||
                $logged_in_user->can('admin.access.user.change-password')
            )
        )
            <!-- <li class="c-sidebar-nav-title">@lang('System')</li> -->

            <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'c-open c-show') }}">
                <x-utils.link
                    href="#"
                    icon="fa-solid fa-user vebo-menu-icon"
                    class="c-sidebar-nav-dropdown-toggle vebo-dropdown-nav vebo-nav-link"
                    :text="__('Access')" />

                <ul class="c-sidebar-nav-dropdown-items vebo-nav-bg">
                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.user.list') ||
                            $logged_in_user->can('admin.access.user.deactivate') ||
                            $logged_in_user->can('admin.access.user.reactivate') ||
                            $logged_in_user->can('admin.access.user.clear-session') ||
                            $logged_in_user->can('admin.access.user.impersonate') ||
                            $logged_in_user->can('admin.access.user.change-password')
                        )
                    )
                        <li class="c-sidebar-nav-item vebo-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.user.index')"
                                class="c-sidebar-nav-link vebo-nav-link"
                                :text="__('User Management')"
                                :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li class="c-sidebar-nav-item vebo-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.role.index')"
                                class="c-sidebar-nav-link vebo-nav-link"
                                :text="__('Role Management')"
                                :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                        </li>
                    @endif
                </ul>
            </li>
        @endif

        @if ($logged_in_user->hasAllAccess())
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="fa-solid fa-list vebo-menu-icon"
                    class="c-sidebar-nav-dropdown-toggle vebo-dropdown-nav vebo-nav-link"
                    :text="__('Logs')" />

                <ul class="c-sidebar-nav-dropdown-items vebo-nav-bg">
                    <li class="c-sidebar-nav-item vebo-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::dashboard')"
                            class="c-sidebar-nav-link vebo-nav-link"
                            :text="__('Dashboard')" />
                    </li>
                    <li class="c-sidebar-nav-item vebo-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::logs.list')"
                            class="c-sidebar-nav-link vebo-nav-link"
                            :text="__('Logs')" />
                    </li>
                </ul>
            </li>
        @endif
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler vebo-display-none" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
