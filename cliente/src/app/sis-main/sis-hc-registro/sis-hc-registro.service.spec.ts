import { TestBed } from '@angular/core/testing';

import { SisHcRegistroService } from './sis-hc-registro.service';

describe('SisHcRegistroService', () => {
  let service: SisHcRegistroService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(SisHcRegistroService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
