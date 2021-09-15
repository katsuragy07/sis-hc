import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SisModulosComponent } from './sis-modulos.component';

describe('SisModulosComponent', () => {
  let component: SisModulosComponent;
  let fixture: ComponentFixture<SisModulosComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SisModulosComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SisModulosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
