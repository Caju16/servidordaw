import { Component, OnInit } from '@angular/core';
import { Contacto } from '../../models/contacto';
import { ContactoService } from '../../services/contacto.service';
import { Router } from '@angular/router';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-contacto-agregar',
  imports: [ CommonModule, FormsModule ],
  templateUrl: './contacto-agregar.component.html',
  styleUrl: './contacto-agregar.component.css'
})

export class ContactoAgregarComponent implements OnInit{
  contacto: Contacto = {id:0, nombre:'', email: '', telefono: ''};

  constructor(private contactoService:ContactoService, private router:Router) {}

  ngOnInit(): void {
    console.log('Componente creado', this.contacto);
    
  }

  agregarContacto(): void {
    console.log('Agregando contacto', this.contacto);
    this.contactoService.agregarContacto(this.contacto).subscribe(() => {this.router.navigate(['/contactos'])});
    
  }

  cancelar(): void {
    console.log('Cancelando');
    this.router.navigate(['navigate']);
  }

}
