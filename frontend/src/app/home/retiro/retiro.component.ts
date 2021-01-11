import { Component, OnInit, ViewChild, ElementRef, ChangeDetectorRef } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormArray } from '@angular/forms';
import { RolesService } from 'app/shared/services/roles.service';
import { Observable, BehaviorSubject, of } from 'rxjs';
import { AccionService } from 'app/shared/services/accion.service';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { switchMap } from 'rxjs/operators';
import { UsersService } from 'app/shared/services/users.service';


@Component({
  selector: 'app-retiro',
  templateUrl: './retiro.component.html',
  styleUrls: ['./retiro.component.scss']
})
export class RetiroComponent implements OnInit {

  formBlog: FormGroup;
  page=1;
  per_page=30;
  blogToEdit$: BehaviorSubject<any> = new BehaviorSubject<any>(null);
  imagen
  nombreImagen
  urlImagen
 idUser;
 saldo

  constructor(
    private fb: FormBuilder,
    private rolesService: RolesService,
    private AccionService: AccionService,
    private toast: ToastrService,
    private activatedRoute: ActivatedRoute,
    private router: Router,
    private userService: UsersService,
    private cd: ChangeDetectorRef,
  ) {
    this.formBlog = this.fb.group({
      idUsuarioFk: [''],
      saldoDisponible: ['', Validators.required],
      montoSolicitar: ['', Validators.required],
      plataforma: ['', Validators.required],
      cuenta: ['', Validators.required],

    });
   }

  ngOnInit() {
    let usuario= JSON.parse(localStorage.getItem('user'));
    this.obtenerSaldo(usuario.id)

  }
  add() {
    if(this.formBlog.get('montoSolicitar').value<10){
      this.toast.error('El monto minimo de retiro son 10$');
      return;
    }
    if(this.saldo<this.formBlog.get('montoSolicitar').value){
      this.toast.error('No puede retirar un monto mayor al disponible');
      return;
    }
    let usuario= JSON.parse(localStorage.getItem('user'));
    this.idUser=usuario.id;
    this.formBlog.controls['idUsuarioFk'].setValue(this.idUser);
    if (this.formBlog.valid) {
      let d = this.formBlog.value;
 
      this.AccionService.solicitudRetiro(this.formBlog.value).subscribe(response => {
        if (response) {
          
          this.toast.success(response['message']);
          this.router.navigate(['/home']);
        } else {
          this.toast.error(JSON.stringify(response));
        }
      },(error)=>
      {
        let mensaje =error.error.errors;
        Object.keys(mensaje).forEach(key => {
          console.log(key)
          this.toast.error(mensaje[key][0]);
          console.log(mensaje[key][0])
         });
      });
    }
  }

  aprobar() {
    if (this.formBlog.valid) {
      let d = this.formBlog.value;
  
      this.AccionService.aprobar(this.formBlog.value).subscribe(response => {
        if (response) {
          this.toast.success(response['message']);
          this.router.navigate(['/admin/parascore/list']);
        } else {
          this.toast.error(JSON.stringify(response));
        }
      });
    }
    // console.log(this.formBlog.value);
  }

  obtenerSaldo(idLogeado){
  
    this.userService.obtenerSaldo(idLogeado).subscribe((res)=>{
      console.log(res);
      this.saldo = res;
      this.formBlog.controls["saldoDisponible"].setValue(this.saldo)
    },(error)=>{
      console.log(error);
    })
  }


}
