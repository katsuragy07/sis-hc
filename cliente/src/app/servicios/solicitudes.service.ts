import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { GlobalConstants } from 'src/app/common/global-constans';
import { Solicitud } from "../models/solicitud.model";


@Injectable({
  providedIn: 'root'
})
export class SolicitudesService {

  URI = GlobalConstants.apiURL;

  constructor(private http:HttpClient) { }


  getToken(){
    return localStorage.getItem('access_token');
  }


  getPages(size){
    let params = new HttpParams();
    params = params.append('size', size);
    return this.http.get<[]>(this.URI+'solicitudes/paginar.php',{params: params});
  }

  getData(index){
    let params = new HttpParams();
    if(index!=0){
      params = params.append('size', index.size);
      params = params.append('offset', index.offset);
    }
    return this.http.get<Solicitud[]>(this.URI+'solicitudes/listar.php',{params: params});
  }

  getDataFilter(index: string, type: string){
    let params = new HttpParams();
    params = params.append('index', index);
    params = params.append('type', type);
    return this.http.get<any>(this.URI+'solicitudes/buscar.php',{params: params});
  }

  postData(get_data: Solicitud){
    //console.log(get_data);
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    form_data.append('data', JSON.stringify(get_data));
    return this.http.post(this.URI+'solicitudes/registrar.php',form_data);
  }

  putData(get_data: Solicitud){
    //console.log(marcar);
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    form_data.append('data',JSON.stringify(get_data));
    return this.http.post(this.URI+'solicitudes/editar.php',form_data);
  }
  
  deleteData(get_data: Solicitud){
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    form_data.append('data',JSON.stringify(get_data));
    return this.http.post(this.URI+'solicitudes/eliminar.php',form_data);
  }



  getDataAtencion(index){
    let params = new HttpParams();
    if(index!=0){
      params = params.append('size', index.size);
      params = params.append('offset', index.offset);
    }
    return this.http.get<Solicitud[]>(this.URI+'solicitudes/listar_atencion.php',{params: params});
  }

  getDataFilterAtencion(index: string, type: string){
    let params = new HttpParams();
    params = params.append('index', index);
    params = params.append('type', type);
    return this.http.get<any>(this.URI+'solicitudes/buscar_atencion.php',{params: params});
  }

  putDataAtencion(get_data: Solicitud){
    //console.log(marcar);
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    form_data.append('data',JSON.stringify(get_data));
    return this.http.post(this.URI+'solicitudes/atender.php',form_data);
  }
  putDataValidar(get_data: Solicitud){
    //console.log(marcar);
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    form_data.append('data',JSON.stringify(get_data));
    return this.http.post(this.URI+'solicitudes/validar.php',form_data);
  }
}
