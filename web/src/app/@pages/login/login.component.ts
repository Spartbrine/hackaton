import { Component } from '@angular/core';
import {FormsModule } from '@angular/forms'
import { User } from '../../shared/interfaces';
import { NavbarComponent } from './../../components/navbar/navbar.component'

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [FormsModule, NavbarComponent],
  templateUrl: './login.component.html',
  styleUrl: './login.component.scss'
})
export class LoginComponent {
  ver_password = '';
  user : User = {
    id:0,
    name:'',
    email:'',
    password:''
  }

  users : User[] = [];
}
