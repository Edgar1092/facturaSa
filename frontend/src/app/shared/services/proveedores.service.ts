import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProveedoresService {

  proveedores$: BehaviorSubject<any[]> = new BehaviorSubject<any[]>([]);

  constructor(private http: HttpClient) { }

  get(params?) {
    let parseParams = new HttpParams();
    if (params) {
      Object.keys(params).forEach(p => {
        parseParams = parseParams.append(p, params[p]);
      });
    }
    this.http
      .get<any[]>(`proveedor/all`, { params: parseParams })
      .subscribe(proveedores => {
        this.proveedores$.next(proveedores);
      });
  }


  obtener(params) {
    return this.http.post(`proveedor/get`, params);
  }

  add(params) {
    return this.http.post(`proveedor/create`, params);
  }

  update(params) {
    return this.http.post(`proveedor/update`, params);
  }

  delete(params) {
    return this.http.post(`proveedor/delete`, params);
  }
}
