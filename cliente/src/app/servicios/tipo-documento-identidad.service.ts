import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { GlobalConstants } from 'src/app/common/global-constans';
import { TipoDocumentoIdentidad } from '../models/tipo-documento-identidad.model';

@Injectable({
  providedIn: 'root'
})
export class TipoDocumentoIdentidadService {

  URI = GlobalConstants.apiURL;

  constructor(private http:HttpClient) { }

  getData(){
    let params = new HttpParams();
    return this.http.get<TipoDocumentoIdentidad[]>(this.URI+'tipo_doc_identidad/listar.php',{params: params});
  }

}
