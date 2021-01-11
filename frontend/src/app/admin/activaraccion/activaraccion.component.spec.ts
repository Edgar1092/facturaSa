import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ActivaraccionComponent } from './activaraccion.component';

describe('ActivaraccionComponent', () => {
  let component: ActivaraccionComponent;
  let fixture: ComponentFixture<ActivaraccionComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ActivaraccionComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ActivaraccionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
