import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './home.component';
import { CursosComponent } from './cursos/cursos.component';
import { AccionListComponent } from './accion-list/accion-list.component';
import { AccionAddComponent } from './accion-add/accion-add.component';
import { HistoricoComponent } from './historico/historico.component';
import { RetiroComponent } from './retiro/retiro.component';
import { ReferidosComponent } from './referidos/referidos.component';

const routes: Routes = [
  {
    path: '',
    component: HomeComponent
  },
  {
    path: 'cursos',
    component: CursosComponent
  },
  {
    path: 'accion/list',
    component: AccionListComponent
  },
  {
    path: 'accion/add',
    component: AccionAddComponent
  },
  {
    path: 'historico',
    component: HistoricoComponent
  },
  {
    path: 'retiro',
    component: RetiroComponent
  },
  {
    path: 'referidos',
    component: ReferidosComponent
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class HomeRoutingModule {}
