import { Component, OnInit, ChangeDetectorRef, Injectable, ViewChild ,ViewEncapsulation} from '@angular/core';
import { NgForm, FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';
import { AuthService } from 'app/shared/auth/auth.service';
import { ToastrService } from 'ngx-toastr';
import { switchMap } from 'rxjs/operators';
import {NgbDatepickerI18n, NgbDateStruct} from '@ng-bootstrap/ng-bootstrap';
import localeEs from '@angular/common/locales/es';
import { DatePipe } from '@angular/common';
import { registerLocaleData, formatNumber, formatCurrency, getCurrencySymbol } from '@angular/common';
import * as Moment from 'moment';
const I18N_VALUES = {
  'es': {
    weekdays: ['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do'],
    months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
  }
  // other languages you would support
};
@Injectable()
export class I18n {
  language = 'es';
}
@Injectable()
export class CustomDatepickerI18n extends NgbDatepickerI18n {

  constructor(private _i18n: I18n) {
    super();
  }

  getWeekdayShortName(weekday: number): string {
    return I18N_VALUES[this._i18n.language].weekdays[weekday - 1];
  }
  getMonthShortName(month: number): string {
    return I18N_VALUES[this._i18n.language].months[month - 1];
  }
  getMonthFullName(month: number): string {
    return this.getMonthShortName(month);
  }

  getDayAriaLabel(date: NgbDateStruct): string {
    return `${date.day}-${date.month}-${date.year}`;
  }
}
const now = new Date();

@Component({
    selector: 'app-register-page',
    templateUrl: './register-page.component.html',
    styleUrls: ['./register-page.component.scss'],
    
  providers: [I18n, {provide: NgbDatepickerI18n, useClass: CustomDatepickerI18n},DatePipe],
})

export class RegisterPageComponent implements OnInit  {
    registerForm: FormGroup;
  activatedRoute: any;
  maxBirthdate
  ano
  mes;
  dia
  maxDate
  minDate
  temporalfechanac
  fechasesenta
  minFe
  disableFe = true;
  constructor(private router: Router,
    private datePipe: DatePipe,
    private route: ActivatedRoute,
    private fb: FormBuilder,
    private auth: AuthService,
    private toast: ToastrService) { 
      this.registerForm = this.fb.group({
        first_name: ['', Validators.required],
        last_name: ['', Validators.required],
        email: ['', Validators.required],
        n_documento: ['', Validators.required],
        password: ['', Validators.required],
        n_telefono:['',Validators.required],
        fechaNacimiento:['',Validators.required],
        link2: ['']
      });
    }
    ngOnInit() {
      registerLocaleData(localeEs, 'es');
      this.MaxBirthdate();
  
          if (this.route.snapshot.params) {
            this.registerForm.controls['link2'].setValue(this.route.snapshot.params.id);
            
          } 
       
        
    }
    MaxBirthdate(){
      let dat = Moment().subtract(18,"year");
      this.maxBirthdate = Moment(dat).format("YYYY-MM-DD");
      console.log(Moment(dat).format("YYYY-MM-DD"));
  
      var splitted = this.maxBirthdate.split("-", 3); 
      this.ano=splitted[0]
      this.mes=splitted[1]
      this.dia=splitted[2]
  
      this.maxDate= {year: now.getFullYear() - 18, month: now.getMonth() + 1, day: now.getDate()}
      this.fechasesenta={year: now.getFullYear() - 60, month: 12, day: 31}
  // console.log(now.getMonth())
  
  
  
    }
    minFE(event){
      var fecha = event.year+'-'+event.month+'-'+event.day;
      this.registerForm.controls['fechaNacimiento'].setValue(Moment(fecha).format("YYYY-MM-DD"));
      let dateBd = this.registerForm.get('fechaNacimiento').value;
      let minfe = Moment(dateBd).add(10, 'year');
      this.minFe = Moment(minfe).format("YYYY-MM-DD");
      this.disableFe = false;
      console.log("year",this.minFe);
  
      this.minDate = {year: parseInt(Moment(minfe).format("YYYY")), month: now.getMonth() + 1, day: now.getDate()};
      console.log(fecha);
  
    }
    register(){
        if (this.registerForm.valid) {
           console.log('aqui');
          this.auth.register(this.registerForm.value).subscribe(response =>{
            this.registerForm.reset();
            this.toast.success(response['message']);
            this.router.navigate(['/auth/login']);
            console.log(response);
          },error => {
            console.log(error);
            this.toast.error("Error al tratar de registrase");
            let mensaje =error.error.errors;
            Object.keys(mensaje).forEach(key => {
              console.log(key)
              this.toast.error(mensaje[key][0]);
              console.log(mensaje[key][0])
             });
          });
        }
      }
}