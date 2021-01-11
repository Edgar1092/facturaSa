import { Component, OnInit } from '@angular/core';
import { Observable, from } from 'rxjs';
import { AccionService } from 'app/shared/services/accion.service';
import swal from 'sweetalert2';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { switchMap } from 'rxjs/operators';
import { FormGroup, FormBuilder, Validators, FormArray } from '@angular/forms';

@Component({
  selector: 'app-activaraccion',
  templateUrl: './activaraccion.component.html',
  styleUrls: ['./activaraccion.component.scss']
})
export class ActivaraccionComponent implements OnInit {

  blogs$: Observable<any[]>;
  total = 0;
  p=1;
  itemsPerPage = 5;
  formBlog: FormGroup;
  contadorAccion
  constructor(private AccionService: AccionService, private toast: ToastrService, 
    private fb: FormBuilder,
    private activatedRoute: ActivatedRoute,
    private router: Router,) {
    this.blogs$ = this.AccionService.blogs$;

    this.formBlog = this.fb.group({
      id: [''],
      idUsuarioFk: [''],
      estatus: [''],

    });
  }

  ngOnInit() {
    let param;

    if(this.p)
      { 
        param={page:this.p,per_page:this.itemsPerPage};
      }else{
        param={page:1,per_page:this.itemsPerPage};
      }
      this.loadInitialData(param);
      this.verificarAcciones(JSON.parse(localStorage.getItem('user')).id);
  }

  delete(user: any) {
    const confirm = swal.fire({
      title: `Borrar al usuario ${user.first_name} ${user.last_name}`,
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
        this.AccionService.delete(user.id).subscribe(response => {
          if (response) {
            this.toast.success(response['message']);
            this.AccionService.get();
          } else {
            this.toast.error(JSON.stringify(response));
          }
        });
      }
    });
  }

  // joinData(data: string[]): string {
  //   return data.map(o => o['name']).join(', ');
  // }

  loadInitialData(params){
    this.AccionService.get(params);
    console.log('arreglo',this.AccionService.get(params))
  }

  verificarAcciones(params){
    console.log('entre a esta mierda');
    this.AccionService.verificar(params).subscribe(response => {
      this.contadorAccion=response;
    });
  
  }

  onFilter(filterParams) {
    this.AccionService.get(filterParams);
  }

  perPage(itemsPerPage,page){
    this.p = page;
    this.itemsPerPage = itemsPerPage;
    let param={page:this.p,per_page:this.itemsPerPage};
    this.loadInitialData(param);

  }

  aprobar(infor) {
    this.formBlog.controls['idUsuarioFk'].setValue(infor.idUsuarioFk);
    this.formBlog.controls['id'].setValue(infor.id);
    this.formBlog.controls['estatus'].setValue('aprobado');
    // console.log(infor)
    if (this.formBlog.valid) {
      let d = this.formBlog.value;
  
      this.AccionService.aprobar(this.formBlog.value).subscribe(response => {
        if (response) {
          this.toast.success("Pago aprobado");
          let param;

          if(this.p)
            { 
              param={page:this.p,per_page:this.itemsPerPage};
            }else{
              param={page:1,per_page:this.itemsPerPage};
            }
          this.AccionService.get(param);
        } else {
          this.toast.error(JSON.stringify(response));
        }
      });
    }
    // console.log(this.formBlog.value);
  }

  rechazar(infor) {
    this.formBlog.controls['idUsuarioFk'].setValue(infor.idUsuarioFk);
    this.formBlog.controls['id'].setValue(infor.id);
    this.formBlog.controls['estatus'].setValue('rechazado');
    if (this.formBlog.valid) {
      let d = this.formBlog.value;
  
      this.AccionService.rechazar(this.formBlog.value).subscribe(response => {
        if (response) {
          this.toast.success("Pago rechazado");
          this.AccionService.get();
        } else {
          this.toast.error(JSON.stringify(response));
        }
      });
    }
    // console.log(this.formBlog.value);
  }

}
