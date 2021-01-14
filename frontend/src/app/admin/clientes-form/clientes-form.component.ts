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
  userToEdit
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
      last_name: ['', Validators.required],
      telefono: ['', Validators.required],
      sexo: ['marico', Validators.required]
    });

  }

  ngOnInit() {

  }

  add() {
    if (this.formCliente.valid) {
      this.clienteService.add(this.formCliente.value).subscribe(response => {
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
