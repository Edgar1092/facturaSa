import { InventarioService } from './../../shared/services/inventario.service';
import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Observable, BehaviorSubject, of } from 'rxjs';;
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { switchMap } from 'rxjs/operators';


@Component({
  selector: 'app-inventario-form',
  templateUrl: './inventario-form.component.html',
  styleUrls: ['./inventario-form.component.scss']
})
export class InventarioFormComponent implements OnInit {

  formInventario: FormGroup;
  page=1;
  per_page=10;
  inventarioToEdit
  productos


  constructor(private fb: FormBuilder,
    private InventarioService: InventarioService,
    private toast: ToastrService,
    private activatedRoute: ActivatedRoute,
    private router: Router) { 
      this.formInventario = this.fb.group({
      id: [''],
      producto_id: ['', Validators.required],
      monto: ['', Validators.required],
      tipo: ['', Validators.required],
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
          return this.InventarioService.obtener(data);
        } else {
          return of(null);
        }
      })
    )
    .subscribe(inventario => {
      if (inventario) {
        this.inventarioToEdit = inventario
        this.inventarioToEdit.controls['id'].setValue(inventario['id']);
        this.inventarioToEdit.controls['producto_id'].setValue(inventario['producto_id']);
        this.inventarioToEdit.controls['tipo'].setValue(inventario['tipo']);
        this.inventarioToEdit.controls['monto'].setValue(inventario['monto']);
               
        console.log("aquui",this.formInventario.value)
      }
    });
    //  esto para Mostrar lista de productos
      this.obtenerProductos();
  }

  add() {
    if (this.formInventario.valid) {
      this.InventarioService.add(this.formInventario.value).subscribe(response => {
        console.log("Valor que llega en add",this.formInventario.value)
        console.log(response)
          if (response) {
          this.toast.success("Guardado");
          this.router.navigate(['/admin/inventario/list']);
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
    if (this.formInventario.valid) {
      this.InventarioService.update(this.formInventario.value).subscribe(response => {
        console.log(response)
        if (response) {
          this.toast.success("Guardado");
          this.router.navigate(['/admin/inventario/list']);
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
  obtenerProductos(){
    this.InventarioService.obtenerProductos().subscribe((response)=>{
      this.productos = JSON.parse(JSON.stringify(response))
      this.productos = response
  console.log(response)
    },(error)=>{
      console.log(error)
    })
  }

  





}
