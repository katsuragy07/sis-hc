import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { GlobalConstants } from 'src/app/common/global-constans';
import { EstadoSolicitud } from '../models/estado-solicitud.model';

@Injectable({
  providedIn: 'root'
})
export class EstadoSolicitudService {

  URI = GlobalConstants.apiURL;

  constructor(private http:HttpClient) { }

  getData(){
    let params = new HttpParams();
    return this.http.get<EstadoSolicitud[]>(this.URI+'estado_solicitud/listar.php',{params: params});
  }

}
