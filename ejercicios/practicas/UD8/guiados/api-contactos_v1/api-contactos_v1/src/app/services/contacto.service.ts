import { Injectable } from '@angular/core';
import { environment } from '../environments/environment';
import { Observable } from 'rxjs';
import { Contacto } from '../models/contacto';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ContactoService {
  private baseUrl = environment.baseUrl;

  constructor(private http : HttpClient) { }

  // Recuperar todos los contactos

  getContactos() : Observable<Contacto[]> {
    return this.http.get<Contacto[]>(`${this.baseUrl}contactos/`);
  }

  // Recuperar un contacto

  getContacto(id:number): Observable<Contacto> {
    return this.http.get<Contacto>(`${this.baseUrl}contactos/${id}`);
  }

  agregarContacto(contacto: Contacto) {
    return this.http.post(`${this.baseUrl}contactos/`, contacto);
  }  

  editarContacto(contacto: Contacto): Observable<Contacto> {
    return this.http.put<Contacto>(`${this.baseUrl}contactos/editar/${contacto.id}`, contacto);
  }

  borrarContacto(id: number): Observable<Contacto> {
    return this.http.delete<Contacto>(`${this.baseUrl}contactos/` + id);
  }

}
