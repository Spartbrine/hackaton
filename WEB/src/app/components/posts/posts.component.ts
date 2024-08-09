import { Component, Input } from '@angular/core';
import { Post } from '../../shared/interfaces';
import { MatIconModule } from '@angular/material/icon';

@Component({
  selector: 'app-posts',
  standalone: true,
  imports: [MatIconModule],
  templateUrl: './posts.component.html',
  styleUrl: './posts.component.scss'
})
export class PostsComponent {
  @Input() posts: Post[] = [];

}
