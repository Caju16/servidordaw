import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ContactoService } from '../../services/contacto.service';
import { Contacto } from '../../models/contacto';

@Component({
  selector: 'app-contacto-editar',
  imports: [CommonModule, FormsModule],
  templateUrl: './contacto-editar.component.html',
  styleUrl: './contacto-editar.component.css'
})
export class ContactoEditarComponent {
  contacto: Contacto = {id:0, nombre:'', telefono:'', email:''};
  constructor(private route: ActivatedRoute, private contactoService: ContactoService, private router: Router){}
  ngOnInit(): void{
    const id = Number(this.route.snapshot.paramMap.get('id'));
    this.contactoService.getContacto(id).subscribe(data=>this.contacto = data);
  }

  guardar(){
    this.contactoService.editarContacto(this.contacto).subscribe(()=>{
      this.router.navigate(['/contactos']);
    });
  }

  cancelar(){
    this.router.navigate(['/contactos']);
  }
}
