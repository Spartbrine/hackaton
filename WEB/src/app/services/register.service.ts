import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { environment } from '../../../public/enviroments';
import { User } from '../shared/interfaces';

@Injectable({
  providedIn: 'root'
})
export class RegisterService {
  http = inject(HttpClient)
  ip = environment.apiUrl
  apiurl = this.ip + '/api/users'
  register(user : User){
    return this.http.post(this.apiurl, user)
  }
}
