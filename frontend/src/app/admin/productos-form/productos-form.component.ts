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
  productoToEdit
  productos

  constructor(
    private fb: FormBuilder,
    private ProductosService: ProductosService,
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

    this.activatedRoute.params
    .pipe(
      switchMap(params => {
        if (params['id']) {
          let data = {
            id:params['id']
          }
          return this.ProductosService.obtener(data);
        } else {
          return of(null);
        }
      })
    )
    .subscribe(producto => {
      if (producto) {
        this.productoToEdit = producto
        this.formProducto.controls['id'].setValue(producto['id']);
        this.formProducto.controls['codigo'].setValue(producto['codigo']);
        this.formProducto.controls['codigo_proveedor'].setValue(producto['codigo_proveedor']);
        this.formProducto.controls['nombre'].setValue(producto['nombre']);
        this.formProducto.controls['costo'].setValue(producto['costo']);
        this.formProducto.controls['precio1'].setValue(producto['precio1']);
        this.formProducto.controls['precio2'].setValue(producto['precio2']);
        this.formProducto.controls['precio3'].setValue(producto['precio3']);
        this.formProducto.controls['departamento'].setValue(producto['departamento']);
               
        console.log("aquui",this.formProducto.value)
      }
    });
  }

  add() {
    if (this.formProducto.valid) {
      this.ProductosService.add(this.formProducto.value).subscribe(response => {
        console.log(response)
        if (response) {
          this.toast.success("Guardado");
          this.router.navigate(['/admin/productos/list']);
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
    if (this.formProducto.valid) {
      this.ProductosService.update(this.formProducto.value).subscribe(response => {
        console.log(response)
        if (response) {
          this.toast.success("Guardado");
          this.router.navigate(['/admin/productos/list']);
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


   ////////////////////////// esto para inventario
  // obtenerProductos(){
  //   this.clienteService.obtenerProductos().subscribe((response)=>{
  //     this.productos = JSON.parse(JSON.stringify(response))
  //     this.productos = response
  // console.log(response)
  //   },(error)=>{
  //     console.log(error)
  //   })
  // }
}
