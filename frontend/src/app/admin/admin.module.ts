import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AdminRoutingModule } from './admin-routing.module';
import { UsersComponent } from './users/users.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { UsersListComponent } from './users-list/users-list.component';
import { SweetAlert2Module } from '@sweetalert2/ngx-sweetalert2';
import { UserComponent } from './user/user.component';
import { SharedModule } from 'app/shared/shared.module';
import { ProcesarAccionesComponent } from './procesar-acciones/procesar-acciones.component';
import { SolicitudespagoComponent } from './solicitudespago/solicitudespago.component';
import { ActivaraccionComponent } from './activaraccion/activaraccion.component';
import { ClientesListaComponent } from './clientes-lista/clientes-lista.component';
import { ClientesFormComponent } from './clientes-form/clientes-form.component';
import { ProductosFormComponent } from './productos-form/productos-form.component';
import { ProductosListComponent } from './productos-list/productos-list.component';
import { ProveedoresFormComponent } from './proveedores-form/proveedores-form.component';
import { ProveedoresListComponent } from './proveedores-list/proveedores-list.component';
import { InventarioFormComponent } from './inventario-form/inventario-form.component';
import { InventarioListComponent } from './inventario-list/inventario-list.component';

@NgModule({
  declarations: [
    UsersComponent,
    UsersListComponent,
    UserComponent,
    ProcesarAccionesComponent,
    SolicitudespagoComponent,
    ActivaraccionComponent,
    ClientesListaComponent,
    ClientesFormComponent,
    ProductosFormComponent,
    ProductosListComponent,
    ProveedoresFormComponent,
    ProveedoresListComponent,
    InventarioFormComponent,
    InventarioListComponent
  ],
  imports: [
    CommonModule,
    AdminRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    SharedModule,
    SweetAlert2Module.forRoot({
      buttonsStyling: false,
      customClass: 'modal-content',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn'
    })
  ]
})
export class AdminModule {}
