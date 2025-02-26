import { Component, OnInit } from '@angular/core';
import { Contacto } from '../../models/contacto';
import { ContactoService } from '../../services/contacto.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-contactos',
  standalone: true,
  imports: [ CommonModule ],
  templateUrl: './contactos.component.html',
  styleUrl: './contactos.component.css'
})

export class ContactosComponent implements OnInit {
  contactos: Contacto[] = [];

  constructor(private contactoService: ContactoService) { }

  // Forma parte de angular
  ngOnInit(): void {
    // Cuando se inicia el objeto
    this.obtenerContactos();
  }

  obtenerContactos() {
    this.contactoService.getContactos().subscribe((data) => { this.contactos=data; });
  }

}
