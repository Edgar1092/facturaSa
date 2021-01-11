import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable, BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class SolicitudService {

  solicitud$: BehaviorSubject<any[]> = new BehaviorSubject<any[]>([]);
  constructor(private http: HttpClient) {}


  // getSolicitudes(params?) {
  //   let parseParams = new HttpParams();
  //   if (params) {
  //     Object.keys(params).forEach(p => {
  //       parseParams = parseParams.append(p, params[p]);
  //     });
  //   }
  //   this.http
  //     .get<any[]>(`accion/getSolicitudes`, { params: parseParams })
  //     .subscribe(preguntas => {
  //       this.solicitud$.next(preguntas);
  //     });
  // }

  getSolicitudes(params) {
    this.http.post<any[]>(`accion/getSolicitudes`, params ).subscribe(blogs => {
      this.solicitud$.next(blogs);
    });
  }


  aprobarRechazarRetiro(params){
    return this.http.post(`accion/aprobarRechazarRetiro`, params);
  }
}
