import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SolicitudespagoComponent } from './solicitudespago.component';

describe('SolicitudespagoComponent', () => {
  let component: SolicitudespagoComponent;
  let fixture: ComponentFixture<SolicitudespagoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SolicitudespagoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SolicitudespagoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
