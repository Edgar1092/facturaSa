import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProductosService {

  productos$: BehaviorSubject<any[]> = new BehaviorSubject<any[]>([]);

  constructor(private http: HttpClient) { }

  get(params?) {
    let parseParams = new HttpParams();
    if (params) {
      Object.keys(params).forEach(p => {
        parseParams = parseParams.append(p, params[p]);
      });
    }
    this.http
      .get<any[]>(`producto/all`, { params: parseParams })
      .subscribe(productos => {
        this.productos$.next(productos);
      });
  }

  obtener(params) {
    return this.http.post(`producto/get`, params);
  }

  add(params) {
    return this.http.post(`producto/create`, params);
  }

  update(params) {
    return this.http.post(`producto/update`, params);
  }

  delete(params) {
    return this.http.post(`producto/delete`, params);
  }


}
