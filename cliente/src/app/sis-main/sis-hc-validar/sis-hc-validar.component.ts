import { Component, OnInit } from '@angular/core';
import { ToastrService } from 'ngx-toastr';

import { SolicitantesService } from "./../../servicios/solicitantes.service";
import { ParentescoService } from "./../../servicios/parentesco.service";
import { TipoSolicitudService } from 'src/app/servicios/tipo-solicitud.service';
import { EstadoSolicitudService } from 'src/app/servicios/estado-solicitud.service';
import { PacientesService } from 'src/app/servicios/pacientes.service';
import { TipoDocumentoIdentidadService } from 'src/app/servicios/tipo-documento-identidad.service';
import { SolicitudesService } from 'src/app/servicios/solicitudes.service';

import { Usuario } from "./../../models/usuario.model";
import { Solicitud } from "./../../models/solicitud.model";
import { Solicitante } from "./../../models/solicitante.model";
import { Parentesco } from './../../models/parentesco.model';
import { TipoSolicitud } from './../../models/tipo-solicitud.model';
import { EstadoSolicitud } from './../../models/estado-solicitud.model';
import { Paciente } from './../../models/paciente.model';
import { TipoDocumentoIdentidad } from './../../models/tipo-documento-identidad.model';

import * as $ from 'jquery';
declare var $: any;

@Component({
  selector: 'app-sis-hc-validar',
  templateUrl: './sis-hc-validar.component.html',
  styleUrls: ['./sis-hc-validar.component.css']
})
export class SisHcValidarComponent implements OnInit {

  tipos_doc_identidad: TipoDocumentoIdentidad[];
  tipo_doc_identidad: TipoDocumentoIdentidad;
  pacientes: Paciente[];
  paciente: Paciente;
  parentescos: Parentesco[];
  parentesco: Parentesco;
  tipo_solicitudes: TipoSolicitud[];
  tipo_solicitud: TipoSolicitud;
  estado_solicitudes: EstadoSolicitud[];
  estado_solicitud: EstadoSolicitud;
  solicitudes: Solicitud[];
  solicitud: Solicitud;
  solicitantes: Solicitante[];
  solicitante: Solicitante;


  ready: boolean;
  btn: boolean;
  pages;
  pageActive: number;
  pageSize: number;

  constructor(private tipoDocIdentidad_service: TipoDocumentoIdentidadService, private pacientes_service: PacientesService, private estadoSolicitud_service: EstadoSolicitudService, private tipoSolicitud_service: TipoSolicitudService, private parentesco_service: ParentescoService, private solicitante_service: SolicitantesService, private solicitud_service: SolicitudesService, private toastr: ToastrService) { 
    this.tipos_doc_identidad = [];
    this.tipo_doc_identidad = new TipoDocumentoIdentidad();
    this.pacientes = [];
    this.paciente = new Paciente();
    this.parentescos = [];
    this.parentesco = new Parentesco();
    this.tipo_solicitudes = [];
    this.tipo_solicitud = new TipoSolicitud();
    this.estado_solicitudes = [];
    this.estado_solicitud = new EstadoSolicitud();
    this.solicitudes = [];
    this.solicitud = new Solicitud();
    this.solicitantes = [];
    this.solicitante = new Solicitante();
    this.btn = true;
    this.ready = true;
    this.pageActive = 1;
    this.pageSize = 15;
    this.paginar();
    this.getParentesco();
    this.getTipoSolicitud();
    this.getTipoDocIdentidad();
    this.getEstadoSolicitud();
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



  
  getParentesco(){
      this.parentesco_service.getData().subscribe(
        res=>{
          this.parentescos = res;
        },
        err=>{
          console.log(err);
        }
      );
  }
  getTipoSolicitud(){
    this.tipoSolicitud_service.getData().subscribe(
      res=>{
        this.tipo_solicitudes = res;
      },
      err=>{
        console.log(err);
      }
    );
  }
  getEstadoSolicitud(){
    this.estadoSolicitud_service.getData().subscribe(
      res=>{
        this.estado_solicitudes = res;
      },
      err=>{
        console.log(err);
      }
    );
  }
  getTipoDocIdentidad(){
    this.tipoDocIdentidad_service.getData().subscribe(
      res=>{
        this.tipos_doc_identidad = res;
      },
      err=>{
        console.log(err);
      }
    );
  }




  filtrarPacientes(index: string){
    this.pacientes_service.getDataFilter(index).subscribe(
      res=>{
        this.pacientes = res;
        //this.codeList = res;
        let find = this.pacientes.find(x => x?.nombres === index);
        //console.log(find);
        $("#inputUSER-hidden").val(find?.id);
        this.solicitud.pac_id = find?.id;
        this.solicitud.pac_nro_historia = find?.nro_historia;
        this.solicitud.pac_situacion = find?.situacion;
        this.solicitud.pac_fecha_situacion = find?.fecha_situacion;
        if($("#inputUSER-hidden").val()==""){
            $("#inputUSER").removeClass("is-valid");
            $("#inputUSER").addClass("is-invalid");
        }else{
            $("#inputUSER").removeClass("is-invalid");
            $("#inputUSER").addClass("is-valid");
        }
      },
      err=>{
        console.log(err)
      }
    );   
  }





  getSolicitudes(page: number){
    this.ready = false;
    this.pageActive = page;
    try{
      this.solicitud_service.getDataAtencion(this.pages[page-1]).subscribe(
        res=>{
          console.log(res)
          this.ready = true;
          this.solicitudes = res;
        },
        err=>{
          this.ready = true;
          console.log(err)
        }
      );
    }catch(error){
      console.log(error);
      this.pageActive -= 1;
      this.solicitud_service.getDataAtencion(this.pages[page-2]).subscribe(
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
    //console.log(this.solicitud);
  }

  putSolicitudes(getForm){
    if(this.solicitud.id){ 
      console.log(this.solicitud);
      this.btn = false;
      this.solicitud_service.putDataValidar(this.solicitud).subscribe(
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
      
    }
  }

  filtrarSolicitudes(index: string, type: string){
    this.pageActive = 1;
    if(index==""){
      this.paginar();
    }else{
      this.ready = false;
      this.solicitud_service.getDataFilterAtencion(index,type).subscribe(
        res =>{
          console.log(res)
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
      this.solicitud_service.deleteData(this.solicitud).subscribe(
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
            if(res==200){
              this.toastr.success('Elemento registrado con exito.','Aviso');
              setTimeout(()=>{
                this.btn = true;
                this.closeForm(getForm);
              },300);
            }else{
              this.btn = true;
              this.toastr.error('No se pudo actualizar el elemento.','Aviso');
            }
          },
          err => {
            console.log(err);
            this.btn = true;
            this.toastr.error('No se pudo registrar el elemento.','Aviso');
          }
        );
    }
  }

  filtrarSolicitantes(index: string){
      this.solicitante_service.getDataFilter(index).subscribe(
        res =>{
          this.solicitante = res;
          this.solicitud.sol_nombre = res.nombre_completo;
          this.solicitud.sol_id = res.id;
          //console.log(res)
          //console.log(this.solicitud)
        },
        err => {
          console.log(err);
        }
      );
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
