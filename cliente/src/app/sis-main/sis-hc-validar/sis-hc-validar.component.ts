import { Component, OnInit } from '@angular/core';
import { SisHcValidarService } from "./sis-hc-validar.service";
import { ToastrService } from 'ngx-toastr';

import { Usuario } from "./../../models/usuario.model";
import { Solicitud } from "./../../models/solicitud.model";
import { Solicitante } from "./../../models/solicitante.model";

import * as $ from 'jquery';
declare var $: any;

@Component({
  selector: 'app-sis-hc-validar',
  templateUrl: './sis-hc-validar.component.html',
  styleUrls: ['./sis-hc-validar.component.css']
})
export class SisHcValidarComponent implements OnInit {

  solicitudes: Solicitud[];
  solicitud: Solicitud;
  solicitante: Solicitante;

  ready: boolean;
  btn: boolean;
  pages;
  pageActive: number;
  pageSize: number;

  constructor(private service: SisHcValidarService, private toastr: ToastrService) { 
    this.solicitudes = [];
    this.solicitud = new Solicitud();
    this.solicitante = new Solicitante();
    this.btn = true;
    this.ready = true;
    this.pageActive = 1;
    this.pageSize = 15;
    //this.paginar();
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
    this.service.getPages(this.pageSize).subscribe(
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
      this.service.getSolicitudes(this.pages[page-1]).subscribe(
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
      this.service.getSolicitudes(this.pages[page-2]).subscribe(
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


  edit(getElement: Solicitud){
    this.solicitud = Object.assign({},getElement);
  }

  
  submit(getForm){
    if(this.solicitud.id){ 
      this.btn = false;
      this.service.putSolicitud(this.solicitud).subscribe(
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


  filtrar(index: string, type: string){
    this.pageActive = 1;
    if(index==""){
      this.paginar();
    }else{
      this.ready = false;
      this.service.getSolicitudesFilter(index,type).subscribe(
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


  eliminar(getElement: Solicitud){  
    if(getElement.id){
      this.btn = true;
      this.solicitud = Object.assign({},getElement);
    }else{
      this.btn = false;
      this.service.deleteData(this.solicitud).subscribe(
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
