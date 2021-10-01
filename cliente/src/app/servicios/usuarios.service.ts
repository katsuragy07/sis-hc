import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { GlobalConstants } from 'src/app/common/global-constans';
import { Usuario } from "../models/usuario.model";
import { Solicitud } from "../models/solicitud.model";
import { Solicitante } from "../models/solicitante.model";
import { Fedatario } from "../models/fedatario.model";

@Injectable({
  providedIn: 'root'
})
export class UsuariosService {

  URI = GlobalConstants.apiURL;

  constructor(private http:HttpClient) { }


  getToken(){
    return localStorage.getItem('access_token');
  }


  getPages(size){
    let params = new HttpParams();
    params = params.append('size', size);
    return this.http.get<[]>(this.URI+'usuarios/paginar.php',{params: params});
  }

  getData(index){
    let params = new HttpParams();
    if(index!=0){
      params = params.append('size', index.size);
      params = params.append('offset', index.offset);
    }
    return this.http.get<Usuario[]>(this.URI+'usuarios/listar.php',{params: params});
  }

  getDataFilter(index: string, type: string){
    let params = new HttpParams();
    params = params.append('index', index);
    params = params.append('type', type);
    return this.http.get<any>(this.URI+'usuarios/buscar.php',{params: params});
  }

  postData(get_data: Usuario){
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    form_data.append('data', JSON.stringify(get_data));
    return this.http.post(this.URI+'usuarios/registrar.php',form_data);
  }

  putData(get_data: Usuario){
    //console.log(marcar);
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    form_data.append('data',JSON.stringify(get_data));
    return this.http.post(this.URI+'usuarios/editar.php',form_data);
  }
  
  deleteData(get_data: Usuario){
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    form_data.append('data',JSON.stringify(get_data));
    return this.http.post(this.URI+'usuarios/eliminar.php',form_data);
  }

}
