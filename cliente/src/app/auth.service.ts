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
    window.location.href = "https://login.microsoftonline.com/57c17caf-c500-4ffc-9976-f85fc6c66d47/oauth2/v2.0/logout?%20post_logout_redirect_uri=https://oic.uncp.edu.pe";
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
