import { Component } from '@angular/core';
import { AbstractControl, FormControl, FormGroup, FormsModule, ReactiveFormsModule, ValidationErrors, Validators } from '@angular/forms';
import { NavbarComponent } from './../../components/navbar/navbar.component'
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';
import { CommonModule } from '@angular/common';
@Component({
  selector: 'app-register',
  standalone: true,
  imports: [FormsModule, NavbarComponent, ReactiveFormsModule, CommonModule, MatIconModule, MatButtonModule],
  templateUrl: './register.component.html',
  styleUrl: './register.component.scss'
})
export class RegisterComponent {
  ver_password : string = '';
  same_password : boolean = true;
  registerForm = new FormGroup(
  {
    firstName: new FormControl('', [Validators.required]),
    lastName: new FormControl('', [Validators.required]),
    email: new FormControl('', [Validators.required, Validators.email]),
    password: new FormControl('', [Validators.required, Validators.minLength(8)]),
    confirmPassword: new FormControl('', [Validators.required])
  },
  );

  passwordMatchValidator(): boolean {
    if(this.registerForm.get('password')?.value == this.registerForm.get('confirmPassword')?.value){
      console.log('Contraseña igual')
      this.same_password = true
      return true
    } else {
      console.log(`Contraseña igualn't`)
      this.same_password = false
      return false
    }
  }

  onSubmit() {
    if (this.registerForm.valid && this.passwordMatchValidator() == true) {
      console.log(this.registerForm.value);
    }
  }

  passwordFieldType: string = 'password';
  passwordFieldType2: string = 'password';

  togglePasswordVisibility(input : string): void {
    if(input == '1'){
      this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password';
    } else {
      this.passwordFieldType2 = this.passwordFieldType2 === 'password' ? 'text' : 'password';
    }
  }
}
