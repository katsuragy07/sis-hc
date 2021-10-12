import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SisPasswordComponent } from './sis-password.component';

describe('SisPasswordComponent', () => {
  let component: SisPasswordComponent;
  let fixture: ComponentFixture<SisPasswordComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SisPasswordComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SisPasswordComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
