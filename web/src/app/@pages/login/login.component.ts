import { Component } from '@angular/core';
import {FormsModule } from '@angular/forms'
import { User } from '../../shared/interfaces';
@Component({
  selector: 'app-login',
  standalone: true,
  imports: [FormsModule],
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
