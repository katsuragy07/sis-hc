import { Component, OnInit } from '@angular/core';
import { UsuariosService } from "./../../servicios/usuarios.service";
import { ToastrService } from 'ngx-toastr';

import { Usuario } from "./../../models/usuario.model";

import * as $ from 'jquery';
declare var $: any;

@Component({
  selector: 'app-sis-password',
  templateUrl: './sis-password.component.html',
  styleUrls: ['./sis-password.component.css']
})
export class SisPasswordComponent implements OnInit {

  usuarios: Usuario[];
  usuario: Usuario;

  ready: boolean;
  btn: boolean;
  pages;
  pageActive: number;
  pageSize: number;

  constructor(private service: UsuariosService, private toastr: ToastrService) { 
    this.usuarios = [];
    this.usuario = new Usuario();
    this.btn = true;
    this.ready = false;
    this.pageActive = 1;
    this.pageSize = 20;
  }

  ngOnInit(): void {
  }
  
  resetForm(getForm){
    getForm.resetForm();
    this.usuario = new Usuario();
  }


  submit(getForm){
    if(this.usuario.id){ 
      this.btn = false;
      this.service.putData(this.usuario).subscribe(
        (res) => {
          if(res==200){
            this.toastr.success('Elemento actualizado con exito.','Aviso');
            setTimeout(()=>{
              this.btn = true;
              this.resetForm(getForm);
            },300);
          }else{
            this.btn = true;
            this.toastr.error('No se pudo actualizar el elemento.','Aviso');
          }
        },
        (err) => {
          console.log(err);
          this.btn = true;
          this.toastr.error('No se pudo actualizar el elemento.','Aviso');
        }
      );
    }else{

      this.btn = false;
        this.service.postData(this.usuario).subscribe(
          (res) => {
            if(res==200){
              this.toastr.success('Elemento registrado con exito.','Aviso');
              this.pageActive = 1;
              setTimeout(()=>{
                this.btn = true;
                this.resetForm(getForm);
              },300);
            }else{
              this.btn = true;
              this.toastr.error('No se pudo actualizar el elemento.','Aviso');
            }
          },
          (err) => {
            console.log(err);
            this.btn = true;
            this.toastr.error('No se pudo registrar el elemento.','Aviso');
          }
        );

    }
  }

}
