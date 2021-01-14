import { Component, OnInit } from '@angular/core';
import { Observable, from } from 'rxjs';
import { ClientesService } from 'app/shared/services/clientes.service';
import swal from 'sweetalert2';
import { ToastrService } from 'ngx-toastr';
@Component({
  selector: 'app-clientes-lista',
  templateUrl: './clientes-lista.component.html',
  styleUrls: ['./clientes-lista.component.scss']
})
export class ClientesListaComponent implements OnInit {
  clientes$: Observable<any[]>;
  total = 0;
  page=1;
  per_page = 1;
  filterParams
  constructor(private clientesService: ClientesService, private toast: ToastrService) {
    this.clientes$ = this.clientesService.clientes$;
   }

  ngOnInit() {
    let param;
    if(this.page)
      { 
        param={page:this.page,per_page:this.per_page};
      }else{
        param={page:1,per_page:this.per_page};
      }
    this.loadInitialData(param);
  }

  loadInitialData(params){
    this.clientesService.get(params);
    console.log(this.clientes$);
  }

  delete(cliente: any) {
    const confirm = swal.fire({
      title: `Borrar el cliente`,
      text: 'Esta acción no se puede deshacer',
      type: 'question',
      showConfirmButton: true,
      showCancelButton: true,
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Borrar',
      focusCancel: true
    });

    from(confirm).subscribe(r => {
      if (r['value']) {
        let data = {id:cliente.id}
        this.clientesService.delete(data).subscribe(response => {
          if (response) {
            this.toast.success(response['message']);
            let param={per_page:this.per_page,page:1};
            this.loadInitialData(param);
          } else {
            this.toast.error("Error");
          }
        });
      }
    });
  }

  onFilter(filterParams) {
    console.log(filterParams)
    this.filterParams = filterParams
    this.page=1;
    let param={page:1,per_page:this.per_page,...filterParams};
    this.loadInitialData(param)
    
  }
  
  perPage(itemsPerPage,page){
    this.page = page;
    this.per_page = itemsPerPage;
    let param={page:this.page,per_page:this.per_page,...this.filterParams};
    this.loadInitialData(param);

  }

}
