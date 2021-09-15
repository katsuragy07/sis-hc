import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRouteSnapshot, RouterStateSnapshot} from '@angular/router';

import * as $ from 'jquery';
import { AuthService } from '../auth.service';
declare var $: any;

@Component({
  selector: 'app-sis-main',
  templateUrl: './sis-main.component.html',
  styleUrls: ['./sis-main.component.css']
})
export class SisMainComponent implements OnInit {

  menuMin: boolean;
  menuActive: number;
  windowsX: number;
  windowsY: number;
  navX: number;
  navXmin: number;

  constructor(private router: Router, private auth: AuthService){ 
    this.menuMin = false;
    switch(this.router.url){
      case "/usuarios": this.menuActive = 1; break;
      case "/modulos": this.menuActive = 2; break;
      case "/registro": this.menuActive = 3; break;
      case "/atencion": this.menuActive = 4; break;
      case "/validar-pago": this.menuActive = 5; break;
    }
  }

  ngOnInit(): void {
    this.resize();
    
    window.addEventListener("resize",()=>{
      this.resize();
    });

    //$("nav").css("width","40px")
  }


  valRouteActive(get_route){
    switch(get_route){
      case "usuarios": this.menuActive = 1; break;
      case "modulos": this.menuActive = 2; break;
      case "registro": this.menuActive = 3; break;
      case "atencion": this.menuActive = 4; break;
      case "validar-pago": this.menuActive = 5; break;
    }
  }

  minMenu(){
    if(this.menuMin){
      this.menuMin = false;
      if(this.windowsX<700){

      }else{
        $(".main-container section").css("padding-left","260px");
        $(".nav-min").css("width","260px");
        setTimeout(()=>{
          $(".main-container > nav").css("display","block");
          $(".nav-min").css("display","none");
        },300);
      }
      
    }else{
      this.menuMin = true;
      $(".main-container section").css("padding-left","50px");
      $(".nav-min").css("display","block");
      $(".main-container > nav").css("display","none");
      setTimeout(()=>{
        $(".nav-min").css("width","50px");
      },10);
    }
    

    
  }
 
  resize(){
    this.navX = $(".main-container > nav").outerWidth();
    this.navXmin = 50;
    this.windowsX = $(window).width();
    if(this.menuMin){
      if(this.windowsX<700){
        $(".btn_min_resp").css("visibility","hidden");
        this.minMenu()
      }else{
        $(".btn_min_resp").css("visibility","visible");
      }
    }else{
      if(this.windowsX<700){
        $(".btn_min_resp").css("visibility","hidden");
        this.minMenu()
      }else{
        $(".btn_min_resp").css("visibility","visible");
      }
    }
  }


  logout(){
    this.auth.logout();
  }

}
