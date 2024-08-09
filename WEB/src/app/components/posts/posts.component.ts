import { Component, Inject, inject, Input } from '@angular/core';
import { Comment, Post, User } from '../../shared/interfaces';
import { MatIconModule } from '@angular/material/icon';
import { CommonModule, DatePipe } from '@angular/common';
import { MAT_DIALOG_DATA, MatDialog, MatDialogActions, MatDialogClose, MatDialogContent, MatDialogRef, MatDialogTitle } from '@angular/material/dialog';
import { MatButtonModule } from '@angular/material/button';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { PostsService } from '../../services/posts.service';

@Component({
  selector: 'app-posts',
  standalone: true,
  imports: [MatIconModule,DatePipe, CommonModule],
  templateUrl: './posts.component.html',
  styleUrl: './posts.component.scss'
})
export class PostsComponent {
  @Input() posts: Post[] = [];
  user : User = {
    id:0,
    email:'',
    password:'',
    name:''
  }
  ngOnInit(){
    let user = localStorage.getItem('loginForm');
    if(user) {
      this.user = JSON.parse(user)
    }
  }

  service = inject(PostsService)
  getComments(post : Post){
    this.service.getComments(post)
  }

  commentsVisibility: { [key: number]: boolean } = {};

  toggleComments(post: Post) {
    const postId = post.id;
    if (!post.comments) {
      this.service.getComments(post).subscribe(comments => {
        post.comments = comments;
        this.commentsVisibility[postId] = true;
      });
    } else {
      this.commentsVisibility[postId] = !this.commentsVisibility[postId];
    }
  }

  dialog = inject(MatDialog)
  openDialog(post: Post){
    this.dialog.open(CommentPostDialogComponent, {
      width:'50%',
      height:'70%',
      data: { user: this.user, post: post }
    })
  }
}



@Component({
  selector: 'app-create-post-dialog',
  standalone: true,
  imports: [MatButtonModule, MatDialogActions, MatDialogClose, MatDialogTitle, MatDialogContent, FormsModule],
  templateUrl: './comment-post-dialog.component.html',
  styleUrls: ['./posts.component.scss']
})
export class CommentPostDialogComponent {
  readonly dialogRef = inject(MatDialogRef<CommentPostDialogComponent>);

  constructor(@Inject(MAT_DIALOG_DATA) public data: { user: User, post: Post }) {
    console.log('Post recibido:', this.post)
  }

  user: User = this.data.user;
  post: Post = this.data.post;

  comment: Comment = {
    id: 0,
    description: '',
    publication_id: this.post.id,
    email: this.user.email
  };

  router = inject(Router);

  reload() {
    const currentUrl = this.router.url;
    this.router.navigateByUrl('/blank', { skipLocationChange: true }).then(() => {
      this.router.navigateByUrl(currentUrl);
    });
  }

  service = inject(PostsService)
  onSubmit() {
    this.comment.publication_id = this.post.id
    this.service.postComment(this.comment).subscribe();
    this.reload();
    this.dialogRef.close();
  }
}
