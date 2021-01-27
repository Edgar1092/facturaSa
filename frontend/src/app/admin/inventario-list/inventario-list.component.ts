import { InventarioService } from './../../shared/services/inventario.service';
import { Component, OnInit } from '@angular/core';
import { Observable, from } from 'rxjs';
import swal from 'sweetalert2';
import { ToastrService } from 'ngx-toastr';



@Component({
  selector: 'app-inventario-list',
  templateUrl: './inventario-list.component.html',
  styleUrls: ['./inventario-list.component.scss']
})
export class InventarioListComponent implements OnInit {

  inventario$: Observable<any[]>;
  total = 0;
  page=1;
  per_page = 10;
  filterParams

  constructor(private InventarioService: InventarioService, private toast: ToastrService) { 
    this.inventario$ = this.InventarioService.inventario$;
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
    this.InventarioService.get(params);
    console.log(this.inventario$);
  }

  delete(inventario: any) {
    const confirm = swal.fire({
      title: `Borrar el Producto`,
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
        let data = {id:inventario.id}
        this.InventarioService.delete(data).subscribe(response => {
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
