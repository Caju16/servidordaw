import { Routes } from '@angular/router';
import { ContactoListComponent } from './components/contacto-list/contacto-list.component';
import { ContactoAgregarComponent } from './components/contacto-agregar/contacto-agregar.component';
import { ContactoEditarComponent } from './components/contacto-editar/contacto-editar.component';

export const routes: Routes = [
    {path: 'contactos', component: ContactoListComponent},
    {path: 'contactos/agregar', component:ContactoAgregarComponent},
    {path: 'contactos/editar/:id', component:ContactoEditarComponent},
    {path: '', redirectTo: '/contactos', pathMatch: 'full'}
];
