import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BrowserModule } from '@angular/platform-browser';

import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ToastrModule } from 'ngx-toastr';

import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './app.component';
import { SisMainComponent } from './sis-main/sis-main.component';
import { SisUsuariosComponent } from './sis-main/sis-usuarios/sis-usuarios.component';
import { SisModulosComponent } from './sis-main/sis-modulos/sis-modulos.component';
import { SisHcRegistroComponent } from './sis-main/sis-hc-registro/sis-hc-registro.component';
import { SisHcAtencionComponent } from './sis-main/sis-hc-atencion/sis-hc-atencion.component';
import { SisHcValidarComponent } from './sis-main/sis-hc-validar/sis-hc-validar.component';
import { LoginComponent } from './login/login.component';
import { SisPasswordComponent } from './sis-main/sis-password/sis-password.component';

@NgModule({
  declarations: [
    AppComponent,
    SisMainComponent,
    SisUsuariosComponent,
    SisModulosComponent,
    SisHcRegistroComponent,
    SisHcAtencionComponent,
    SisHcValidarComponent,
    LoginComponent,
    SisPasswordComponent
  ],
  imports: [
    CommonModule,
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    BrowserAnimationsModule,
    ToastrModule.forRoot({
      timeOut: 2000
    }),
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
