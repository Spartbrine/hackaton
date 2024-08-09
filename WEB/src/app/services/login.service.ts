import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { User } from '../shared/interfaces';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  private apiUrl = 'http://127.0.0.1:8000/api/users/'
  http = inject(HttpClient)
  checkUser(email : string){
   return this.http.get<User>(this.apiUrl + email)
  }
}
