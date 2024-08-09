import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { Comment, Post } from '../shared/interfaces';
import { map, Observable } from 'rxjs';
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

  getComments(post: Post): Observable<Comment[]> {
    return this.http.get<{ publication: Post }>(`${this.apiUrl}/${post.id}`)
      .pipe(
        map(response => response.publication.comments || [])
      );
  }
  postComment(comment : Comment){
    return this.http.post<Comment>(this.ip + '/api/comments', comment)
  }
}
