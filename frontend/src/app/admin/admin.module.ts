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

@NgModule({
  declarations: [
    UsersComponent,
    UsersListComponent,
    UserComponent,
    ProcesarAccionesComponent,
    SolicitudespagoComponent,
    ActivaraccionComponent
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
