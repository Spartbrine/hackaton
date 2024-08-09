import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { User } from '../shared/interfaces';
import { Observable } from 'rxjs';
import { environment } from '../../../public/enviroments';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  private ip = environment.apiUrl

  private apiUrl = this.ip + '/api/users/'
  http = inject(HttpClient)
  checkUser(email : string) : Observable<User>{
   return this.http.get<User>(this.apiUrl + email)
  }
}
