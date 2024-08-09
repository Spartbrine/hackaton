import { Component, inject } from '@angular/core';
import {FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms'
import { User } from '../../shared/interfaces';
import { NavbarComponent } from './../../components/navbar/navbar.component'
import { CommonModule } from '@angular/common';
import { MatIconModule } from '@angular/material/icon'
import { MatButtonModule } from '@angular/material/button'
import { stringify } from 'querystring';
import { Router } from '@angular/router';
@Component({
  selector: 'app-login',
  standalone: true,
  imports: [FormsModule, NavbarComponent, ReactiveFormsModule, CommonModule, MatIconModule, MatButtonModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.scss'
})
export class LoginComponent {
  router = inject(Router)
  ver_password : string = '';
  error_msg = '';
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
      if(this.validateLogin() == true){
        this.saveFormData()
        this.router.navigateByUrl('');
      } else {
        this.error_msg = 'Correo electrónico o contraseña incorrectos. Inténtalo de nuevo.';
      }
    }
  }

  saveFormData() {
    const formData = this.loginForm.value;
    localStorage.setItem('loginForm', JSON.stringify(formData));
  }

  validateLogin(): boolean{
    if(this.loginForm.get('email')?.value =='pedro@correo.com' && this.loginForm.get('password')?.value == '12345678'){
      return true
    } else {
      return false
    }
  }


  passwordFieldType: string = 'password';

  togglePasswordVisibility(): void {
    this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password';
  }

}
