import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { Post } from '../shared/interfaces';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PostsService {
  private apiUrl = 'http://127.0.0.1:8000/api/publications';

  http = inject(HttpClient)

  getPosts(): Observable<Post[]>{
    console.log('Posts:', this.http.get<Post[]>(`${this.apiUrl}`));
    return this.http.get<Post[]>(`${this.apiUrl}`);
  }

  postPost(post : Post){
    return this.http.post<Post>(this.apiUrl, post)
  }
}
