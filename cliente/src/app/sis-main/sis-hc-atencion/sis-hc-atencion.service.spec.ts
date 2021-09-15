import { TestBed } from '@angular/core/testing';

import { SisHcAtencionService } from './sis-hc-atencion.service';

describe('SisHcAtencionService', () => {
  let service: SisHcAtencionService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(SisHcAtencionService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
