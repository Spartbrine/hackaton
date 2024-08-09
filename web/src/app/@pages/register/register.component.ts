import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { NavbarComponent } from './../../components/navbar/navbar.component'
@Component({
  selector: 'app-register',
  standalone: true,
  imports: [FormsModule, NavbarComponent],
  templateUrl: './register.component.html',
  styleUrl: './register.component.scss'
})
export class RegisterComponent {

}
