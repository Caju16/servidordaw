import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ContactoAgregarComponent } from './contacto-agregar.component';

describe('ContactoAgregarComponent', () => {
  let component: ContactoAgregarComponent;
  let fixture: ComponentFixture<ContactoAgregarComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ContactoAgregarComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ContactoAgregarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
