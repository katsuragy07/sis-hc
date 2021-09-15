import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SisMainComponent } from './sis-main.component';

describe('SisMainComponent', () => {
  let component: SisMainComponent;
  let fixture: ComponentFixture<SisMainComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SisMainComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SisMainComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
