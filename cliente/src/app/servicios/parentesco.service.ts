import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { GlobalConstants } from 'src/app/common/global-constans';
import { Parentesco } from '../models/parentesco.model';

@Injectable({
  providedIn: 'root'
})
export class ParentescoService {

  URI = GlobalConstants.apiURL;

  constructor(private http:HttpClient) { }


  getData(){
    let params = new HttpParams();
    return this.http.get<Parentesco[]>(this.URI+'parentesco/listar.php',{params: params});
  }

}
