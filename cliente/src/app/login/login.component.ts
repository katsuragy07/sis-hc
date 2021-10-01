import { Component, OnInit } from '@angular/core';
import { LoginService } from "./../servicios/login.service";
import { ToastrService } from 'ngx-toastr';
import { Router} from '@angular/router';

import { Usuario } from "./../models/usuario.model";

import * as $ from 'jquery';
declare var $: any;

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  
  usuarios: Usuario[];
  usuario: Usuario;

  ready: boolean;
  btn: boolean;

  constructor(private service: LoginService, private router: Router, private toastr: ToastrService) { 
    this.usuarios = [];
    this.usuario = new Usuario();
    this.btn = true;
    this.ready = false;
  }

  ngOnInit(): void {
  }

  submit(getForm){
    this.btn = false;
    this.service.postData(this.usuario).subscribe(
      (res) => {
        //console.log(res)
        if(res.estado==200){
          this.toastr.success('Usuario Correcto.','Aviso');
          localStorage.setItem('access_token', res.access_token);
          setTimeout(()=>{
            this.btn = true;
            this.router.navigate(['/']);
          },300);
        }
        if(res.estado==300){
          this.toastr.warning('Contraseña incorrecta!','Aviso');
          setTimeout(()=>{
            this.btn = true;
          },300);
        }
        if(res.estado==404){
          this.toastr.error('El usuario no existe!','Aviso');
          setTimeout(()=>{
            this.btn = true;
          },300);
        }
      },
      (err) => {
        console.log(err);
        this.btn = true;
        this.toastr.error('No se pudo conectar con la base de datos!','Aviso');
      }
    );
  }

}
