import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { AuthGuard } from "./auth.guard";
import { LoginComponent } from './login/login.component';
import { SisHcAtencionComponent } from './sis-main/sis-hc-atencion/sis-hc-atencion.component';
import { SisHcRegistroComponent } from './sis-main/sis-hc-registro/sis-hc-registro.component';
import { SisHcValidarComponent } from './sis-main/sis-hc-validar/sis-hc-validar.component';
import { SisMainComponent } from './sis-main/sis-main.component';
import { SisModulosComponent } from './sis-main/sis-modulos/sis-modulos.component';
import { SisUsuariosComponent } from './sis-main/sis-usuarios/sis-usuarios.component';

const routes: Routes = [
  {
    path: '', 
    component: SisMainComponent,
    canActivate: [AuthGuard],
    canActivateChild: [AuthGuard],
    children: [
      {
        path: 'usuarios',
        component: SisUsuariosComponent
      },
      {
        path: 'modulos',
        component: SisModulosComponent
      },
      {
        path: 'registro',
        component: SisHcRegistroComponent
      },
      {
        path: 'atencion',
        component: SisHcAtencionComponent
      },
      {
        path: 'validar',
        component: SisHcValidarComponent
      },
     
    ]
  },
  {
    path: 'login',
    component: LoginComponent
  }

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
