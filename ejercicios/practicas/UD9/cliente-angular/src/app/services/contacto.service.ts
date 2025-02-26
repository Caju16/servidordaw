import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';
import { HttpClient } from '@angular/common/http';
import { Contacto } from '../models/contacto';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ContactoService {
  apiURL = environment.apiUrl;

  constructor(private http: HttpClient) { }
  
  getContactos(): Observable<Contacto[]> {
    return this.http.get<Contacto[]>(`${this.apiURL}/contactos/`);
  }
}

