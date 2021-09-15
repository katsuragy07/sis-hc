import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SisHcAtencionComponent } from './sis-hc-atencion.component';

describe('SisHcAtencionComponent', () => {
  let component: SisHcAtencionComponent;
  let fixture: ComponentFixture<SisHcAtencionComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SisHcAtencionComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SisHcAtencionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
