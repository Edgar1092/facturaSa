import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { UsersComponent } from './users/users.component';
import { UsersListComponent } from './users-list/users-list.component';
import { UserComponent } from './user/user.component';
import { SolicitudespagoComponent } from './solicitudespago/solicitudespago.component';
import { ActivaraccionComponent } from './activaraccion/activaraccion.component';
import { RoleAdminGuard } from 'app/guards/role-admin.guard';

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
    path: 'solicitudesPago',
    component: SolicitudespagoComponent
  },
  {
    path: 'activar',
    component: ActivaraccionComponent
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule {}
