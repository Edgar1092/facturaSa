import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { UsersComponent } from './users/users.component';
import { UsersListComponent } from './users-list/users-list.component';
import { UserComponent } from './user/user.component';
import { SolicitudespagoComponent } from './solicitudespago/solicitudespago.component';
import { ActivaraccionComponent } from './activaraccion/activaraccion.component';
import { RoleAdminGuard } from 'app/guards/role-admin.guard';
import { ClientesListaComponent } from './clientes-lista/clientes-lista.component';
import { ClientesFormComponent } from './clientes-form/clientes-form.component';
import { ProductosFormComponent } from './productos-form/productos-form.component';
import { ProductosListComponent } from './productos-list/productos-list.component';
import { ProveedoresFormComponent } from './proveedores-form/proveedores-form.component';
import { ProveedoresListComponent } from './proveedores-list/proveedores-list.component';
import { InventarioFormComponent } from './inventario-form/inventario-form.component';
import { InventarioListComponent } from './inventario-list/inventario-list.component';

const routes: Routes = [
  {
    path: 'users/add',
    component: UsersComponent
  },
  {
    path: 'users/list',
    component: UsersListComponent
  },
  {
    path: 'user/:id',
    component: UserComponent
  },
  {
    path: 'user/:id/edit',
    component: UsersComponent
  },
  {
    path: 'clientes/add',
    component: ClientesFormComponent
  },
  {
    path: 'clientes/list',
    component: ClientesListaComponent
  },
  {
    path: 'clientes/:id',
    component: ClientesFormComponent
  },
  {
    path: 'productos/add',
    component: ProductosFormComponent
  },
  {
    path: 'productos/list',
    component: ProductosListComponent
  },
  {
    path: 'productos/:id',
    component: ProductosFormComponent
  },
  {
    path: 'proveedor/add',
    component: ProveedoresFormComponent
  },
  {
    path: 'proveedor/list',
    component: ProveedoresListComponent
  },
  {
    path: 'proveedor/:id',
    component: ProveedoresFormComponent
  },
  {
    path: 'inventario/add',
    component: InventarioFormComponent
  },
  {
    path: 'inventario/list',
    component: InventarioListComponent
  },
  {
    path: 'inventario/:id',
    component: InventarioFormComponent
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule {}
