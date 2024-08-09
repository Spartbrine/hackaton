import { Component, inject } from '@angular/core';
import {FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms'
import { User } from '../../shared/interfaces';
import { NavbarComponent } from './../../components/navbar/navbar.component'
import { CommonModule } from '@angular/common';
import { MatIconModule } from '@angular/material/icon'
import { MatButtonModule } from '@angular/material/button'
import { stringify } from 'querystring';
import { Router } from '@angular/router';
import { LoginService } from '../../services/login.service';
import { response } from 'express';
@Component({
  selector: 'app-login',
  standalone: true,
  imports: [FormsModule, NavbarComponent, ReactiveFormsModule, CommonModule, MatIconModule, MatButtonModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.scss'
})
export class LoginComponent {
  service = inject(LoginService)
  router = inject(Router)
  recoverUser : User | undefined
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
      this.validateLogin().then(isValid => {
        if (isValid) {
          this.saveFormData();
          this.router.navigateByUrl('');
        } else {
          this.error_msg = 'Correo electrónico o contraseña incorrectos. Inténtalo de nuevo.';
        }
      }).catch(error => {
        console.error('Error during validation:', error);
        this.error_msg = 'Hubo un problema al verificar las credenciales. Inténtalo de nuevo más tarde.';
      });
    }
  }

  saveFormData() {
    const formData = this.recoverUser;
    localStorage.setItem('loginForm', JSON.stringify(formData));
  }

  checkUser(){
    let email = this.loginForm.get('email')?.value
    if(email){
      this.service.checkUser(email).subscribe(response => {
        this.recoverUser = response
      })
    }

  }

  async validateLogin(): Promise<boolean> {
    try {
      const email = this.loginForm.get('email')?.value;
      if (email) {
        // Convertir Observable a Promise
        this.recoverUser = await this.service.checkUser(email).toPromise();
      }

      if (this.recoverUser &&
          this.loginForm.get('email')?.value === this.recoverUser.email &&
          this.loginForm.get('password')?.value === this.recoverUser.password) {
        return true;
      } else {
        return false;
      }
    } catch (error) {
      console.error('Error validating login:', error);
      return false;
    }
  }


  passwordFieldType: string = 'password';

  togglePasswordVisibility(): void {
    this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password';
  }

}
