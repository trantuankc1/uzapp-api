<div class="c-sidebar-brand">
{{--    <img class="c-sidebar-brand-full" src="{{ asset('icons/logo.png') }}"--}}
{{--         alt="CoreUI Logo" style="max-width: 80%">--}}
</div>
<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link {{request()->is('admin/order/*') ? 'c-active' : '' }}" href="{{ route('order') }}">
            <i class="cil-cart c-sidebar-nav-icon"></i>
            {{ __('admin::template.nav.order_list') }}
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link {{request()->is('admin/products/*') ? 'c-active' : '' }}" href="{{ route('admin::product.index') }}">
            <i class="cil-columns c-sidebar-nav-icon"></i>
            {{ __('admin::template.nav.product_list') }}
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link {{request()->is('admin/category/*') ? 'c-active' : '' }}" href="{{ route('category') }}">
            <i class="cil-menu c-sidebar-nav-icon"></i>
            {{ __('admin::template.nav.category_list') }}
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link {{request()->is('admin/users/*') ? 'c-active' : '' }}" href="{{ route('admin::users.index') }}">
            <i class="cil-contact c-sidebar-nav-icon"></i>
            {{ __('admin::template.nav.customer_list') }}
        </a>
    </li>
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
</div>
