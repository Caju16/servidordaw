import { Component, OnInit } from '@angular/core';
import { Contacto } from '../../models/contacto';
import { ContactoService } from '../../services/contacto.service';
import { Router } from '@angular/router';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-contacto-list',
  imports: [CommonModule],
  templateUrl: './contacto-list.component.html',
  styleUrl: './contacto-list.component.css'
})
export class ContactoListComponent implements OnInit{

  contactos: Contacto[] = [];

  constructor(private contactoService: ContactoService, private router: Router) {}

  ngOnInit(): void {
    this.getContactos();
  }

  getContactos(): void {
    this.contactoService.getContactos().subscribe({
      next: (result:Contacto[]) => {
        console.log("Datos OK", result);
        this.contactos = result;
      },
      error: (error) => {
        console.log("Error", error);
      }
    })
  }

  borrar(id: number): void {
    console.log("borrando", id);
    // Aquí puedes llamar al servicio para borrar el contacto
    this.contactoService.borrarContacto(id).subscribe({
      next: () => {
        console.log("Contacto borrado");
        this.getContactos(); // Actualizar la lista de contactos después de borrar
      },
      error: (error) => {
        console.log("Error al borrar el contacto", error);
      }
    });
  }
}
