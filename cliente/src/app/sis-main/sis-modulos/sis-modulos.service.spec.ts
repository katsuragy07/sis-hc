import { TestBed } from '@angular/core/testing';

import { SisModulosService } from './sis-modulos.service';

describe('SisModulosService', () => {
  let service: SisModulosService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(SisModulosService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
