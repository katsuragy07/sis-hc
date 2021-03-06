import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { GlobalConstants } from 'src/app/common/global-constans';
import { Paciente } from "../models/paciente.model";

@Injectable({
  providedIn: 'root'
})
export class PacientesService {

  URI = GlobalConstants.apiURL;

  constructor(private http:HttpClient) { }

  getDataFilter(index: string){
    let params = new HttpParams();
    params = params.append('index', index);
    return this.http.get<any>(this.URI+'paciente/buscar.php',{params: params});
  }

}
