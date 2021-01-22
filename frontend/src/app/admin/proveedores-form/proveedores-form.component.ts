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
  userToEdit

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
  }

  add() {
    if (this.formProveedor.valid) {
      this.ProveedoresService.add(this.formProveedor.value).subscribe(response => {
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
