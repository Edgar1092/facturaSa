import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Observable, BehaviorSubject, of } from 'rxjs';
import { ProductosService } from 'app/shared/services/productos.service';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { switchMap } from 'rxjs/operators';

@Component({
  selector: 'app-productos-form',
  templateUrl: './productos-form.component.html',
  styleUrls: ['./productos-form.component.scss']
})
export class ProductosFormComponent implements OnInit {

  formProducto: FormGroup;
  page=1;
  per_page=10;
  userToEdit

  constructor(
    private fb: FormBuilder,
    private productoService: ProductosService,
    private toast: ToastrService,
    private activatedRoute: ActivatedRoute,
    private router: Router,
    ) { 

      this.formProducto = this.fb.group({
        id: [''],
        codigo: ['', Validators.required],
        codigo_proveedor: ['', Validators.required],
        nombre: ['', Validators.required],
        costo: ['', Validators.required],
        precio1: ['', Validators.required],
        precio2: ['', Validators.required],
        precio3: ['', Validators.required],
        departamento: ['', Validators.required],


      });
    }

  ngOnInit() {
  }

  add() {
    if (this.formProducto.valid) {
      this.productoService.add(this.formProducto.value).subscribe(response => {
        console.log(response)
        if (response) {
          this.toast.success("Guardado");
          // this.router.navigate(['/admin/clientes/list']);
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
