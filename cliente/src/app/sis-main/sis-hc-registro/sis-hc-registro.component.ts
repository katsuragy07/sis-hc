import { Component, OnInit } from '@angular/core';
import { ToastrService } from 'ngx-toastr';

import { SolicitantesService } from "./../../servicios/solicitantes.service";

import { Usuario } from "./../../models/usuario.model";
import { Solicitud } from "./../../models/solicitud.model";
import { Solicitante } from "./../../models/solicitante.model";

import * as $ from 'jquery';
declare var $: any;

@Component({
  selector: 'app-sis-hc-registro',
  templateUrl: './sis-hc-registro.component.html',
  styleUrls: ['./sis-hc-registro.component.css']
})
export class SisHcRegistroComponent implements OnInit {

  solicitudes: Solicitud[];
  solicitud: Solicitud;
  solicitante: Solicitante;

  ready: boolean;
  btn: boolean;
  pages;
  pageActive: number;
  pageSize: number;

  constructor(private solicitante_service: SolicitantesService, private toastr: ToastrService) { 
    this.solicitudes = [];
    this.solicitud = new Solicitud();
    this.solicitante = new Solicitante();
    this.btn = true;
    this.ready = false;
    this.pageActive = 1;
    this.pageSize = 15;
    this.paginar();
  }

  ngOnInit(): void {
  }

  
  resetForm(getForm){
    getForm.resetForm();
    this.solicitud = new Solicitud();
  }

  closeForm(getForm){
    $("#modal-add").modal('hide');
    $("#modal-add-solicitante").modal('hide');
    getForm.resetForm();
    this.solicitud = new Solicitud();
  }

  closeConfirm(){
    $("#modal-confirm").modal('hide');
  }

  paginar(){
    this.ready = false;
    this.solicitante_service.getPages(this.pageSize).subscribe(
      res => {
        //console.log(res)
        this.pages = res;
        this.getSolicitudes(this.pageActive);
      },
      err => {console.log(err)}
    );
  }



  getSolicitudes(page: number){
    this.ready = false;
    this.pageActive = page;
    try{
      this.solicitante_service.getData(this.pages[page-1]).subscribe(
        res=>{
          this.ready = true;
          this.solicitudes = res;
        },
        err=>{
          this.ready = true;
        }
      );
    }catch(error){
      console.log(error);
      this.pageActive -= 1;
      this.solicitante_service.getData(this.pages[page-2]).subscribe(
        res=>{
          this.ready = true;
          this.solicitudes = res;
        },
        err=>{
          this.ready = true;
        }
      );
    }
 
  }

  editSolicitudes(getElement: Solicitud){
    this.solicitud = Object.assign({},getElement);
  }

  putSolicitudes(getForm){
    if(this.solicitud.id){ 
      this.btn = false;
      this.solicitante_service.putData(this.solicitante).subscribe(
        (res) => {
          if(res==200){
            this.toastr.success('Elemento actualizado con exito.','Aviso');
            this.paginar();
            setTimeout(()=>{
              this.btn = true;
              this.closeForm(getForm);
            },600);
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
    }
  }

  filtrarSolicitudes(index: string, type: string){
    this.pageActive = 1;
    if(index==""){
      this.paginar();
    }else{
      this.ready = false;
      this.solicitante_service.getDataFilter(index,type).subscribe(
        res =>{
          this.ready = true;
          this.solicitudes = res;
        },
        err => {
          console.log(err);
        }
      );
    }
  }

  eliminarSolicitudes(getElement: Solicitud){  
    if(getElement.id){
      this.btn = true;
      this.solicitud = Object.assign({},getElement);
    }else{
      this.btn = false;
      this.solicitante_service.deleteData(this.solicitante).subscribe(
        res => {
          if(res==200){
            this.btn = true;
            this.toastr.success('Elemento eliminado con exito.','Aviso');
            this.paginar();
            this.closeConfirm();
            setTimeout(()=>{
              this.btn = true;
            },300);
          }else{
            this.btn = true;
            this.toastr.error('No se pudo eliminar el elemento.','Aviso');
          }
        },
        err => {
          console.log(err);
          this.btn = true;
          this.toastr.error('No se pudo eliminar el elemento.','Aviso');
        }
      );
    }
  }





  getSolicitantes(page: number){
    this.ready = false;
    this.pageActive = page;
    try{
      this.solicitante_service.getData(this.pages[page-1]).subscribe(
        res=>{
          this.ready = true;
          this.solicitudes = res;
        },
        err=>{
          this.ready = true;
        }
      );
    }catch(error){
      console.log(error);
      this.pageActive -= 1;
      this.solicitante_service.getData(this.pages[page-2]).subscribe(
        res=>{
          this.ready = true;
          this.solicitudes = res;
        },
        err=>{
          this.ready = true;
        }
      );
    }
 
  }

  editSolicitantes(getElement: Solicitante){
    this.solicitante = Object.assign({},getElement);
  }

  putSolicitantes(getForm){
    if(this.solicitante.id){ 
      this.btn = false;
      this.solicitante_service.putData(this.solicitante).subscribe(
        (res) => {
          if(res==200){
            this.toastr.success('Elemento actualizado con exito.','Aviso');
            this.paginar();
            setTimeout(()=>{
              this.btn = true;
              this.closeForm(getForm);
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
        this.solicitante_service.postData(this.solicitante).subscribe(
          res => {
            console.log(res);
            this.btn = true;
            /*
            if(res==200){
              this.toastr.success('Elemento registrado con exito.','Aviso');
              this.pageActive = 1;
              this.paginar();
              setTimeout(()=>{
                this.btn = true;
                this.closeForm(getForm);
              },300);
            }else{
              this.btn = true;
              this.toastr.error('No se pudo actualizar el elemento.','Aviso');
            }
            */
          },
          err => {
            console.log(err);
            this.btn = true;
            this.toastr.error('No se pudo registrar el elemento.','Aviso');
          }
        );
    }
  }

  filtrarSolicitantes(index: string, type: string){
    this.pageActive = 1;
    if(index==""){
      this.paginar();
    }else{
      this.ready = false;
      this.solicitante_service.getDataFilter(index,type).subscribe(
        res =>{
          this.ready = true;
          this.solicitudes = res;
        },
        err => {
          console.log(err);
        }
      );
    }
  }

  eliminarSolicitantes(getElement: Solicitud){  
    if(getElement.id){
      this.btn = true;
      this.solicitud = Object.assign({},getElement);
    }else{
      this.btn = false;
      this.solicitante_service.deleteData(this.solicitante).subscribe(
        res => {
          if(res==200){
            this.btn = true;
            this.toastr.success('Elemento eliminado con exito.','Aviso');
            this.paginar();
            this.closeConfirm();
            setTimeout(()=>{
              this.btn = true;
            },300);
          }else{
            this.btn = true;
            this.toastr.error('No se pudo eliminar el elemento.','Aviso');
          }
        },
        err => {
          console.log(err);
          this.btn = true;
          this.toastr.error('No se pudo eliminar el elemento.','Aviso');
        }
      );
    }
  }


  
}
