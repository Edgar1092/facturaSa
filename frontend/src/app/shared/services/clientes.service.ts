import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ClientesService {

  clientes$: BehaviorSubject<any[]> = new BehaviorSubject<any[]>([]);

  constructor(private http: HttpClient) { }

  get(params?) {
    let parseParams = new HttpParams();
    if (params) {
      Object.keys(params).forEach(p => {
        parseParams = parseParams.append(p, params[p]);
      });
    }
    this.http
      .get<any[]>(`cliente/all`, { params: parseParams })
      .subscribe(clientes => {
        this.clientes$.next(clientes);
      });
  }
  obtener(params) {
    return this.http.post(`cliente/get`, params);
  }

  add(params) {
    return this.http.post(`cliente/create`, params);
  }

  update(params) {
    return this.http.post(`cliente/update`, params);
  }

  delete(params) {
    return this.http.post(`cliente/delete`, params);
  }

}
