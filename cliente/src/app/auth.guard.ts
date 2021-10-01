import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';

import {  AuthService } from "./auth.service";

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {
  
  constructor(private auth: AuthService, private router: Router){

  }
  
  async canActivate(){
    //return true;
    await this.auth.validarLoginPromise().then(
      res => {
        console.log(res)
        if(res.code==200){
          //console.log(res)
          //console.log("token valido");
          return true;
        }else{
          if(res.code==300){
            this.router.navigate(['/unauthorized']);
            return false;
          }else{
            if(res.code==404){
              //console.log("token invalido");
              this.auth.removeToken();
              this.router.navigate(['/login']);
              return false;
            }else{
              console.log("error con la base de datos")
              this.auth.removeToken();
              this.router.navigate(['/login']);
              return false;
            }
          }
        }
        
      }
    );

    return true;
  }

  canActivateChild(){
    return true;
  }

  
}
