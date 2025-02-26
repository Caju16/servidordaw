import { Component } from '@angular/core';
// import { RouterOutlet } from '@angular/router';
import { ContactosComponent } from './components/contactos/contactos.component';

@Component({
  selector: 'app-root',
  // imports: [RouterOutlet, ContactosComponent],
  imports: [ContactosComponent],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'cliente-angular';
}
