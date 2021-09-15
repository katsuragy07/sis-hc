import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SisHcValidarComponent } from './sis-hc-validar.component';

describe('SisHcValidarComponent', () => {
  let component: SisHcValidarComponent;
  let fixture: ComponentFixture<SisHcValidarComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SisHcValidarComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SisHcValidarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
