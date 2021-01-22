import { Component, OnInit } from '@angular/core';
import { Observable, from } from 'rxjs';
import { ProductosService } from 'app/shared/services/productos.service';
import swal from 'sweetalert2';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-productos-list',
  templateUrl: './productos-list.component.html',
  styleUrls: ['./productos-list.component.scss']
})
export class ProductosListComponent implements OnInit {
  productos$: Observable<any[]>;
  total = 0;
  page=1;
  per_page = 10;
  filterParams

  constructor(private productosService: ProductosService, private toast: ToastrService) {
    this.productos$ = this.productosService.productos$;
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
    this.productosService.get(params);
    console.log(this.productos$);
  }
  
  delete(producto: any) {
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
        let data = {id:producto.id}
        this.productosService.delete(data).subscribe(response => {
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
