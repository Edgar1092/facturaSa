import { Component, OnInit } from '@angular/core';
import { UsersService } from 'app/shared/services/users.service';
import { Observable, from } from 'rxjs';
import { registerLocaleData } from '@angular/common';
import localeEs from '@angular/common/locales/es';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {
users$: Observable<any[]>;
codigoReferido;
contadorReferidos=0;
Patrocinador;
posicion;
saldo
intensity=0
corporacion=0
administrador
accionesConteo=0
usuarios=0
nombreApellido;
  constructor(private userService: UsersService) { }

  ngOnInit() {
    registerLocaleData(localeEs, 'es');
    let usuario= JSON.parse(localStorage.getItem('user'));
    this.nombreApellido=usuario.first_name+' '+usuario.last_name;
    // this.codigoReferido=usuario.link;
    // this.posicion=usuario.posicion;

    // console.log('administrador',JSON.parse(localStorage.getItem('user')).roles[0].id)
    if(JSON.parse(localStorage.getItem('user')).roles[0].id==1){
      // this.obtenerNumeroUsuario(usuario.id);
      // this.obtenerSaldoCorporacion(usuario.id)
      // this.obtenerSaldoIntensity(usuario.id)
      this.administrador=1;
    }else{
      // this.obtenerReferidos(usuario.id)
      // this.obtenerPatrocinador(usuario.idReferido)
      // this.obtenerSaldo(usuario.id)
      // this.obtenerAcciones(usuario.id)
      this.administrador=0;
    }
  }

  obtenerReferidos(idLogeado){
    
    // this.contadorReferidos=this.userService.countReferidos(idLogeado);


    this.userService.countReferidos(idLogeado).subscribe((res)=>{
      console.log(res);
       this.contadorReferidos = JSON.parse(JSON.stringify(res)).conteoReferidos;

    },(error)=>{
      console.log(error);
    })
  
  }
  obtenerPatrocinador(idLogeado){

  
    this.userService.obtenerPatrocinador(idLogeado).subscribe((res)=>{
      console.log(res);
       this.Patrocinador = JSON.parse(JSON.stringify(res)).patrocinador;

    },(error)=>{
      console.log(error);
    })
    
    // this.contadorReferidos=this.userService.countReferidos(idLogeado);
  
  }
  obtenerNumeroUsuario(idLogeado){

  
    this.userService.obtenerNumeroUsuario(idLogeado).subscribe((res)=>{
      console.log(res);
      this.contadorReferidos = parseFloat(JSON.parse(JSON.stringify(res)));

    },(error)=>{
      console.log(error);
    })
    
    // this.contadorReferidos=this.userService.countReferidos(idLogeado);
  
  }

  obtenerSaldo(idLogeado){
  
    this.userService.obtenerSaldo(idLogeado).subscribe((res)=>{
      console.log(res);
      this.saldo = res;

    },(error)=>{
      console.log(error);
    })
  }

  obtenerSaldoCorporacion(idLogeado){
    this.userService.obtenerSaldoCorporacion(idLogeado).subscribe((res)=>{
      console.log(res);
      this.corporacion = parseFloat(JSON.parse(JSON.stringify(res)));

    },(error)=>{
      console.log(error);
    })
  }

  obtenerSaldoIntensity(idLogeado){
    this.userService.obtenerSaldoIntensity(idLogeado).subscribe((res)=>{
      console.log(res);
      this.intensity = parseFloat(JSON.parse(JSON.stringify(res)));

    },(error)=>{
      console.log(error);
    })
  }

  obtenerAcciones(idLogeado){
  
    this.userService.obtenerAcciones(idLogeado).subscribe((res)=>{
      console.log(res);
      this.accionesConteo = JSON.parse(JSON.stringify(res)).cantidad;

    },(error)=>{
      console.log(error);
    })
  }

}
