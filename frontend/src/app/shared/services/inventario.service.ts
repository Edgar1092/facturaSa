import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class InventarioService {

  inventario$: BehaviorSubject<any[]> = new BehaviorSubject<any[]>([]);

  constructor(private http: HttpClient) { }

  get(params?) {
    let parseParams = new HttpParams();
    if (params) {
      Object.keys(params).forEach(p => {
        parseParams = parseParams.append(p, params[p]);
      });
    }
    this.http
      .get<any[]>(`inventario/all`, { params: parseParams })
      .subscribe(inventario => {
        this.inventario$.next(inventario);
      });
  }

  obtener(params) {
    return this.http.post(`inventario/get`, params);
  }
  
  add(params) {
    return this.http.post(`inventario/create`, params);
  }

  update(params) {
    return this.http.post(`inventario/update`, params);
  }

  delete(params) {
    return this.http.post(`inventario/delete`, params);
  }

  obtenerProductos() {
    return this.http.get(`producto/getTodos`);
  }

}
