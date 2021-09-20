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
export class SolicitantesService {

  URI = GlobalConstants.apiURL;

  constructor(private http:HttpClient) { }


  getToken(){
    return localStorage.getItem('access_token');
  }


  getPages(size){
    let params = new HttpParams();
    params = params.append('size', size);
    return this.http.get<[]>(this.URI+'solicitantes/paginar.php',{params: params});
  }

  getData(index){
    let params = new HttpParams();
    params = params.append('size', index.size);
    params = params.append('offset', index.offset);
    return this.http.get<Solicitud[]>(this.URI+'solicitantes/listar.php',{params: params});
  }

  getDataFilter(index: string){
    let params = new HttpParams();
    params = params.append('index', index);
    return this.http.get<any>(this.URI+'solicitantes/buscar.php',{params: params});
  }

  postData(get_data: Solicitante){
    console.log(get_data);
    const form_data = new FormData();
    //form_data.append('authorization', this.getToken());
    form_data.append('data', JSON.stringify(get_data));
    return this.http.post(this.URI+'solicitantes/registrar.php',form_data);
  }

  putData(get_data: Solicitante){
    //console.log(marcar);
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    form_data.append('id', get_data.id);
    return this.http.post(this.URI+'solicitantes/editar.php',form_data);
  }
  
  deleteData(get_data: Solicitante){
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    form_data.append('id', get_data.id);
    return this.http.post(this.URI+'solicitantes/eliminar.php',form_data);
  }

}
