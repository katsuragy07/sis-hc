import { TestBed } from '@angular/core/testing';

import { SisHcValidarService } from './sis-hc-validar.service';

describe('SisHcValidarService', () => {
  let service: SisHcValidarService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(SisHcValidarService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
