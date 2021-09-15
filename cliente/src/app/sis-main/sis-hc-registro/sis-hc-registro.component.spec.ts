import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SisHcRegistroComponent } from './sis-hc-registro.component';

describe('SisHcRegistroComponent', () => {
  let component: SisHcRegistroComponent;
  let fixture: ComponentFixture<SisHcRegistroComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SisHcRegistroComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SisHcRegistroComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
