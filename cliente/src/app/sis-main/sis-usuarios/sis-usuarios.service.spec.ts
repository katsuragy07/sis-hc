import { TestBed } from '@angular/core/testing';

import { SisUsuariosService } from './sis-usuarios.service';

describe('SisUsuariosService', () => {
  let service: SisUsuariosService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(SisUsuariosService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
