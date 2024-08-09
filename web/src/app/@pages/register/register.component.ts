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
  registerForm = new FormGroup(
  {
    firstName: new FormControl('', [Validators.required]),
    lastName: new FormControl('', [Validators.required]),
    email: new FormControl('', [Validators.required, Validators.email]),
    password: new FormControl('', [Validators.required, Validators.minLength(8)]),
    confirmPassword: new FormControl('', [Validators.required])
  },
  {
    validators: this.passwordMatchValidator
  });

  passwordMatchValidator(): ValidationErrors | null {
    return (control: AbstractControl): ValidationErrors | null => {
      const password = control.get('password')?.value;
      const confirmPassword = control.get('confirmPassword')?.value;

      return password !== confirmPassword ? { mismatch: true } : null;
    };
  }

  onSubmit() {
    if (this.registerForm.valid) {
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
