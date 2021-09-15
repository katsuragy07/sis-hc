import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { GlobalConstants } from 'src/app/common/global-constans';
import { Usuario } from ".././../models/usuario.model";
import { Solicitud } from "./../../models/solicitud.model";

@Injectable({
  providedIn: 'root'
})
export class SisHcAtencionService {

  URI = GlobalConstants.apiURL;

  constructor(private http:HttpClient) { }

  getToken(){
    return localStorage.getItem('access_token');
  }


  getPages(size){
    let params = new HttpParams();
    params = params.append('size', size);
    return this.http.get<[]>(this.URI+'usuarios/paginar_usuarios.php',{params: params});
  }

  getSolicitudes(index){
    let params = new HttpParams();
    params = params.append('size', index.size);
    params = params.append('offset', index.offset);
    return this.http.get<Solicitud[]>(this.URI+'usuarios/listar_usuarios.php',{params: params});
  }


  getSolicitudesFilter(index: string, type: string){
    let params = new HttpParams();
    params = params.append('index', index);
    params = params.append('type', type);
    return this.http.get<[]>(this.URI+'usuarios/buscar_usuarios.php',{params: params});
  }

  putSolicitud(user: Solicitud){
    //console.log(marcar);
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    form_data.append('id', user.id);
    return this.http.post(this.URI+'usuarios/editar_usuarios.php',form_data);
  }
  
  deleteData(dependencia: Solicitud){
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    form_data.append('id', dependencia.id);
    return this.http.post(this.URI+'dependencias/eliminar_dependencias.php',form_data);
  }
}
