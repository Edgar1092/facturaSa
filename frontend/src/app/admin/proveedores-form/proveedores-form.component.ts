import { ProveedoresService } from './../../shared/services/proveedores.service';
import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Observable, BehaviorSubject, of } from 'rxjs';;
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { switchMap } from 'rxjs/operators';

@Component({
  selector: 'app-proveedores-form',
  templateUrl: './proveedores-form.component.html',
  styleUrls: ['./proveedores-form.component.scss']
})
export class ProveedoresFormComponent implements OnInit {

  formProveedor: FormGroup;
  page=1;
  per_page=10;
  proveedorToEdit

  constructor( 
    private fb: FormBuilder,
    private ProveedoresService: ProveedoresService,
    private toast: ToastrService,
    private activatedRoute: ActivatedRoute,
    private router: Router,
    ) { 
        this.formProveedor = this.fb.group({
        id: [''],
        nombre: ['', Validators.required],
        email: ['', Validators.required],
        direccion: ['', Validators.required],
      });
    }

  ngOnInit() {

    this.activatedRoute.params
    .pipe(
      switchMap(params => {
        if (params['id']) {
          let data = {
            id:params['id']
          }
          return this.ProveedoresService.obtener(data);
        } else {
          return of(null);
        }
      })
    )
    .subscribe(proveedor => {
      if (proveedor) {
        this.proveedorToEdit = proveedor
        this.formProveedor.controls['id'].setValue(proveedor['id']);
        this.formProveedor.controls['nombre'].setValue(proveedor['nombre']);
        this.formProveedor.controls['email'].setValue(proveedor['email']);
        this.formProveedor.controls['direccion'].setValue(proveedor['direccion']);
               
        console.log("aquui",this.formProveedor.value)
      }
    });
  }

  add() {
    if (this.formProveedor.valid) {
      this.ProveedoresService.add(this.formProveedor.value).subscribe(response => {
        console.log(response)
        if (response) {
          this.toast.success("Guardado");
          this.router.navigate(['/admin/proveedor/list']);
        } else {
          this.toast.error("Error");
        }
      },(error)=>
      {
        console.log(error)
        this.toast.error("Error");
      });
    }
  }

  
  edit() {
    if (this.formProveedor.valid) {
      this.ProveedoresService.update(this.formProveedor.value).subscribe(response => {
        console.log(response)
        if (response) {
          this.toast.success("Guardado");
          this.router.navigate(['/admin/proveedor/list']);
        } else {
          this.toast.error("Error");
        }
      },(error)=>
      {
        console.log(error)
        this.toast.error("Error");
      });
    }
  }

}
