import { Component, inject } from '@angular/core';
import { NewpostComponent } from '../../components/newpost/newpost.component';
import { NvarloginComponent } from '../../components/nvarlogin/nvarlogin.component';
import { PostsComponent } from '../../components/posts/posts.component';
import { Post } from '../../shared/interfaces';
import { PostsService } from '../../services/posts.service';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [NewpostComponent, NvarloginComponent, PostsComponent],
  templateUrl: './home.component.html',
  styleUrl: './home.component.scss'
})
export class HomeComponent {
  posts : Post[]= []
  service = inject(PostsService)
  ngOnInit(){
    this.service.getPosts().subscribe(response => {
      this.posts = response
    })
  }
}
