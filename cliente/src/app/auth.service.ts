import { Injectable } from '@angular/core';

import { Router } from "@angular/router";
import { HttpClient, HttpParams } from '@angular/common/http';
import { GlobalConstants } from 'src/app/common/global-constans';
import { Usuario } from "./models/usuario.model";


@Injectable({
  providedIn: 'root'
})
export class AuthService {

  public login_user: Usuario;
  URI = GlobalConstants.apiURL;

  constructor(private router:Router, private http:HttpClient){
    this.login_user = new Usuario();
  }

  logout(){
    this.removeToken();
    this.router.navigate(['/login']);
  }


  getToken(){
    return localStorage.getItem('access_token');
  }

  removeToken(){
    localStorage.removeItem('id_token');
    localStorage.removeItem('access_token');
  }

  validarLoginPromise(){
    return new Promise<any>( (resultado) => {
      this.validarLogin().subscribe(
        res => {
          //console.log(res)
          this.login_user = res;
          resultado(res);
        }
      )
    });
  }

  validarLogin(){
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    return this.http.post<any>(this.URI+'validar_login.php',form_data);
  }

}
