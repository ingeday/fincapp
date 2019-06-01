<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li><a href='{{ backpack_url('tag') }}'><i class='fa fa-tag'></i> <span>Tags</span></a></li>
<li><a href='{{ backpack_url('animal') }}'><i class='fa fa-dot-circle-o'></i> <span>Animales</span></a></li>
<li><a href='{{ backpack_url('class') }}'><i class='fa fa-plus-square'></i> <span>Clases</span></a></li>
<li><a href='{{ backpack_url('client') }}'><i class='fa fa-users'></i> <span>Clientes</span></a></li>
<li><a href='{{ backpack_url('provider') }}'><i class='fa fa-truck'></i> <span>Proveedores</span></a></li>
<li><a href='{{ backpack_url('sale') }}'><i class='fa fa-truck'></i> <span>Ventas</span></a></li>