import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { GlobalConstants } from 'src/app/common/global-constans';
import { TipoSolicitud } from '../models/tipo-solicitud.model';


@Injectable({
  providedIn: 'root'
})
export class TipoSolicitudService {

  URI = GlobalConstants.apiURL;

  constructor(private http:HttpClient) { }

  getData(){
    let params = new HttpParams();
    return this.http.get<TipoSolicitud[]>(this.URI+'tipo_solicitud/listar.php',{params: params});
  }
}
