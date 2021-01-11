import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ProcesarAccionesComponent } from './procesar-acciones.component';

describe('ProcesarAccionesComponent', () => {
  let component: ProcesarAccionesComponent;
  let fixture: ComponentFixture<ProcesarAccionesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ProcesarAccionesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ProcesarAccionesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
