import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { GlobalConstants } from 'src/app/common/global-constans';
import { Usuario } from ".././../models/usuario.model";

@Injectable({
  providedIn: 'root'
})
export class SisUsuariosService {

  URI = GlobalConstants.apiURL;

  constructor(private http:HttpClient) { }

  getToken(){
    return localStorage.getItem('access_token');
  }


  getPages(size){
    let params = new HttpParams();
    params = params.append('size', size);
    return this.http.get<[]>(this.URI+'usuarios/paginar_usuarios.php',{params: params});
  }

  getUsuarios(index){
    let params = new HttpParams();
    params = params.append('size', index.size);
    params = params.append('offset', index.offset);
    return this.http.get<Usuario[]>(this.URI+'usuarios/listar_usuarios.php',{params: params});
  }


  getUsuariosFilter(index: string, type: string){
    let params = new HttpParams();
    params = params.append('index', index);
    params = params.append('type', type);
    return this.http.get<[]>(this.URI+'usuarios/buscar_usuarios.php',{params: params});
  }

  putUsuario(user: Usuario){
    //console.log(marcar);
    const form_data = new FormData();
    form_data.append('authorization', this.getToken());
    form_data.append('id', user.id);
    form_data.append('privilegios', user.privilegios);
    return this.http.post(this.URI+'usuarios/editar_usuarios.php',form_data);
  }

}
