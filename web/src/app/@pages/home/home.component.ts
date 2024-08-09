import { Component, inject } from '@angular/core';
import { NewpostComponent } from '../../components/newpost/newpost.component';
import { NvarloginComponent } from '../../components/nvarlogin/nvarlogin.component';
import { PostsComponent } from '../../components/posts/posts.component';
import { Post, User } from '../../shared/interfaces';
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
  user : User = {
    id:0,
    email:'',
    password:'',
    name:''
  }
  ngOnInit(){
    this.service.getPosts().subscribe(response => {
      this.posts = response
    });
    let user = localStorage.getItem('loginForm');
        if(user) {
          this.user = JSON.parse(user)
          console.log('Usuario:',this.user)
    }
  }
}
