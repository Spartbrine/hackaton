import { Component } from '@angular/core';
import {FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms'
import { User } from '../../shared/interfaces';
import { NavbarComponent } from './../../components/navbar/navbar.component'
import { CommonModule } from '@angular/common';
import { MatIconModule } from '@angular/material/icon'
import { MatButtonModule } from '@angular/material/button'
import { stringify } from 'querystring';
@Component({
  selector: 'app-login',
  standalone: true,
  imports: [FormsModule, NavbarComponent, ReactiveFormsModule, CommonModule, MatIconModule, MatButtonModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.scss'
})
export class LoginComponent {
  ver_password = '';
  user : User = {
    id:0,
    name:'',
    email:'',
    password:'',
    created_at: new Date().toISOString(),
    updated_at: new Date().toISOString()
  }

  loginForm = new FormGroup({
    email: new FormControl('', [Validators.required, Validators.email,Validators.maxLength(50)]),
    password: new FormControl('', [Validators.required, Validators.minLength(8)]),
  });

  onSubmit() {
    if (this.loginForm.valid) {
      console.log('Info Seteada', this.loginForm.value);
    }
    this.saveFormData()
  }

  saveFormData() {
    const formData = this.loginForm.value;
    localStorage.setItem('loginForm', JSON.stringify(formData));
  }


  passwordFieldType: string = 'password';

  togglePasswordVisibility(): void {
    this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password';
  }

}
