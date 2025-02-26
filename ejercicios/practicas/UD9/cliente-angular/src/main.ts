import { bootstrapApplication } from '@angular/platform-browser';
import { provideRouter } from '@angular/router';
import { provideHttpClient } from '@angular/common/http';  // Importa HttpClientModule
import { AppComponent } from './app/app.component';
import { provideAnimations } from '@angular/platform-browser/animations';
import { ContactoService } from './app/services/contacto.service';

bootstrapApplication(AppComponent, {
  providers: [
    provideRouter([]),
    provideHttpClient(),  // Asegura que HttpClient esté disponible en toda la aplicación
    provideAnimations(),
    ContactoService  // Si es necesario, puedes incluirlo en los proveedores
  ]
}).catch(err => console.error(err));
