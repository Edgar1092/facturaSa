import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Observable, BehaviorSubject, of } from 'rxjs';
import { ClientesService } from 'app/shared/services/clientes.service';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { switchMap } from 'rxjs/operators';

@Component({
  selector: 'app-clientes-form',
  templateUrl: './clientes-form.component.html',
  styleUrls: ['./clientes-form.component.scss']
})
export class ClientesFormComponent implements OnInit {
  
  formCliente: FormGroup;
  page=1;
  per_page=10;
  clienteToEdit
  productos
  constructor(
    private fb: FormBuilder,
    private clienteService: ClientesService,
    private toast: ToastrService,
    private activatedRoute: ActivatedRoute,
    private router: Router,
  ) { 

    this.formCliente = this.fb.group({
      id: [''],
      email: ['', Validators.required],
      first_name: ['', Validators.required],
      razon_social: ['', Validators.required],
      rif: ['', Validators.required],
      direccion: ['', Validators.required],
      telefono: ['', Validators.required],
      notas: ['', Validators.required]
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
            return this.clienteService.obtener(data);
          } else {
            return of(null);
          }
        })
      )
      .subscribe(cliente => {
        if (cliente) {
          this.clienteToEdit = cliente
          this.formCliente.controls['id'].setValue(cliente['id']);
          this.formCliente.controls['email'].setValue(cliente['email']);
          this.formCliente.controls['first_name'].setValue(cliente['first_name']);
          this.formCliente.controls['razon_social'].setValue(cliente['razon_social']);
          this.formCliente.controls['telefono'].setValue(cliente['telefono']);
          this.formCliente.controls['rif'].setValue(cliente['rif']);
          this.formCliente.controls['direccion'].setValue(cliente['direccion']);
          this.formCliente.controls['notas'].setValue(cliente['notas']);
          
          console.log("aquui",this.formCliente.value)
        }
      });
      // this.obtenerProductos();
  }

  add() {
    if (this.formCliente.valid) {
      this.clienteService.add(this.formCliente.value).subscribe(response => {
        console.log(response)
        if (response) {
          this.toast.success("Guardado");
          this.router.navigate(['/admin/clientes/list']);
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
    if (this.formCliente.valid) {
      this.clienteService.update(this.formCliente.value).subscribe(response => {
        console.log(response)
        if (response) {
          this.toast.success("Guardado");
          this.router.navigate(['/admin/clientes/list']);
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
