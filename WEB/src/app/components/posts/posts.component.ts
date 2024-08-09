import { Component, Input } from '@angular/core';
import { Post } from '../../shared/interfaces';
import { MatIconModule } from '@angular/material/icon';
import { DatePipe } from '@angular/common';

@Component({
  selector: 'app-posts',
  standalone: true,
  imports: [MatIconModule,DatePipe],
  templateUrl: './posts.component.html',
  styleUrl: './posts.component.scss'
})
export class PostsComponent {
  @Input() posts: Post[] = [];
  ngOnInit(){
    console.log('Posts:', this.posts)
  }
}
