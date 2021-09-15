import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SisUsuariosComponent } from './sis-usuarios.component';

describe('SisUsuariosComponent', () => {
  let component: SisUsuariosComponent;
  let fixture: ComponentFixture<SisUsuariosComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SisUsuariosComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SisUsuariosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
