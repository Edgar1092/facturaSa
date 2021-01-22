import { ProveedoresService } from './../../shared/services/proveedores.service';
import { Component, OnInit } from '@angular/core';
import { Observable, from } from 'rxjs';
import swal from 'sweetalert2';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-proveedores-list',
  templateUrl: './proveedores-list.component.html',
  styleUrls: ['./proveedores-list.component.scss']
})
export class ProveedoresListComponent implements OnInit {
  proveedores$: Observable<any[]>;
  total = 0;
  page=1;
  per_page = 10;
  filterParams

  constructor(private ProveedoresService: ProveedoresService, private toast: ToastrService) {
    this.proveedores$ = this.ProveedoresService.proveedores$;
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
    this.ProveedoresService.get(params);
    console.log(this.proveedores$);
  }

  delete(proveedor: any) {
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
        let data = {id:proveedor.id}
        this.ProveedoresService.delete(data).subscribe(response => {
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

}
