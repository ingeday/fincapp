<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
@if(backpack_user()->can('crear animal'))
<li class="treeview">
    <a href="#"><i class="fa fa-anchor"></i> <span>Animales</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href='{{ backpack_url('animal') }}'><i class='fa fa-dot-circle-o'></i> <span>Crear Animal</span></a></li>
        <li><a href='{{ backpack_url('class') }}'><i class='fa fa-plus-square'></i> <span>Clases de Animal</span></a></li>
    </ul>
</li>
@endif
@if(backpack_user()->can('crear cliente'))
<li><a href='{{ backpack_url('client') }}'><i class='fa fa-users'></i> <span>Clientes</span></a></li>
@endif
@if(backpack_user()->can('crear venta'))
<li><a href='{{ backpack_url('sale') }}'><i class='fa fa-money'></i> <span>Ventas</span></a></li>
@endif

@if(backpack_user()->can('crear proveedor'))
<li><a href='{{ backpack_url('provider') }}'><i class='fa fa-truck'></i> <span>Proveedores</span></a></li>
@endif
@if(backpack_user()->can('crear compra'))
<li><a href='{{ backpack_url('purchase') }}'><i class='fa fa-shopping-cart'></i> <span>Compras</span></a></li>
@endif


@if(backpack_user()->can('administrar usuario') OR backpack_user()->can('administrar rol') OR backpack_user()->can('administrar permiso'))
<li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
    @if(backpack_user()->can('administrar usuario'))
      <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Usuarios</span></a></li>
    @endif
    @if(backpack_user()->can('administrar rol'))
      <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
    @endif
    @if(backpack_user()->can('administrar permiso'))
      <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>Permisos</span></a></li>
    @endif
    </ul>
  </li>
@endif
