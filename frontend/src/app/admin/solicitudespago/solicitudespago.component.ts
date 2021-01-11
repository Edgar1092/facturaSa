import { Component, OnInit } from '@angular/core';
import { Observable, from } from 'rxjs';
import { AccionService } from 'app/shared/services/accion.service';
import { SolicitudService } from 'app/shared/services/solicitud.service';
import swal from 'sweetalert2';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { switchMap } from 'rxjs/operators';
import { FormGroup, FormBuilder, Validators, FormArray } from '@angular/forms';
import { registerLocaleData } from '@angular/common';
import localeEs from '@angular/common/locales/es';

@Component({
  selector: 'app-solicitudespago',
  templateUrl: './solicitudespago.component.html',
  styleUrls: ['./solicitudespago.component.scss']
})
export class SolicitudespagoComponent implements OnInit {

  solicitud$: Observable<any[]>;
  total = 0;
  p=1;
  itemsPerPage = 5;
  formBlog: FormGroup;
  contadorAccion
  constructor(private AccionService: AccionService, private toast: ToastrService, private SolicitudService: SolicitudService,
    private fb: FormBuilder,
    private activatedRoute: ActivatedRoute,
    private router: Router,) {
    this.solicitud$ = this.SolicitudService.solicitud$;

    this.formBlog = this.fb.group({
      id: [''],
      idUserFk: [''],
      montoSolicitado: [''],
      estatus: ['']

    });
  }

  ngOnInit() {
    registerLocaleData(localeEs, 'es');
    let param;

    if(this.p)
      { 
        param={page:this.p,per_page:this.itemsPerPage};
      }else{
        param={page:1,per_page:this.itemsPerPage};
      }
      this.loadInitialData(param);
     
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
    this.SolicitudService.getSolicitudes(params);
    console.log('arreglo',this.SolicitudService.getSolicitudes(params))
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
  
    this.formBlog.controls['idUserFk'].setValue(infor.idUserFk);
    this.formBlog.controls['id'].setValue(infor.id);
    this.formBlog.controls['montoSolicitado'].setValue(infor.montoSolicitado);
    this.formBlog.controls['estatus'].setValue('aprobado');
    // console.log(infor)
    if (this.formBlog.valid) {
      let d = this.formBlog.value;
  
      this.SolicitudService.aprobarRechazarRetiro(this.formBlog.value).subscribe(response => {
        if (response) {
          this.toast.success("Pago aprobado");
          this.AccionService.get();
        } else {
          this.toast.error(JSON.stringify(response));
        }
      });
    }
    // console.log(this.formBlog.value);
  }

  rechazar(infor) {
    this.formBlog.controls['idUserFk'].setValue(infor.idUserFk);
    this.formBlog.controls['id'].setValue(infor.id);
    this.formBlog.controls['montoSolicitado'].setValue(infor.montoSolicitado);
    this.formBlog.controls['estatus'].setValue('rechazado');
    if (this.formBlog.valid) {
      let d = this.formBlog.value;
  
      this.AccionService.aprobar(this.formBlog.value).subscribe(response => {
        if (response) {
          this.toast.success("rechazado");
          let param;
          if(this.p)
            { 
              param={page:this.p,per_page:this.itemsPerPage};
            }else{
              param={page:1,per_page:this.itemsPerPage};
            }
            this.loadInitialData(param);
        } else {
          this.toast.error(JSON.stringify(response));
        }
      });
    }
    // console.log(this.formBlog.value);
  }


}
