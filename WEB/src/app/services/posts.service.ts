import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { Post } from '../shared/interfaces';
import { Observable } from 'rxjs';
import { environment } from '../../../public/enviroments';

@Injectable({
  providedIn: 'root'
})
export class PostsService {
  private ip = environment.apiUrl
  private apiUrl = this.ip + '/api/publications';

  http = inject(HttpClient)

  getPosts(): Observable<Post[]>{
    console.log('Posts:', this.http.get<Post[]>(`${this.apiUrl}`));
    return this.http.get<Post[]>(`${this.apiUrl}`);
  }

  postPost(post : Post){
    return this.http.post<Post>(this.apiUrl, post)
  }
}
