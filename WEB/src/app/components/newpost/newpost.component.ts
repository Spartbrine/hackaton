import { Component, inject } from '@angular/core';
import { MatButtonModule } from '@angular/material/button';
import {
  MatDialog,
  MatDialogActions,
  MatDialogClose,
  MatDialogContent,
  MatDialogModule,
  MatDialogRef,
  MatDialogTitle,
} from '@angular/material/dialog';
import { MatIconModule } from '@angular/material/icon';
import { Post, User } from '../../shared/interfaces';
import { FormsModule } from '@angular/forms';
import { PostsService } from '../../services/posts.service';
import { stringify } from 'querystring';
import { Router } from '@angular/router';
@Component({
  selector: 'app-newpost',
  standalone: true,
  imports: [MatDialogModule, MatIconModule, MatButtonModule],
  templateUrl: './newpost.component.html',
  styleUrl: './newpost.component.scss'
})
export class NewpostComponent {
  dialog = inject(MatDialog)
  openDialog(){
    this.dialog.open(CreatePostDialogComponent, {
      width:'50%',
      height:'50%'
    })
  }



}

@Component({
  selector: 'app-create-post-dialog',
  standalone: true,
  imports: [MatButtonModule, MatDialogActions, MatDialogClose, MatDialogTitle, MatDialogContent, FormsModule],
  templateUrl: './create-post-dialog.component.html',
  styleUrl: './newpost.component.scss'
})
export class CreatePostDialogComponent {
    readonly dialogRef = inject(MatDialogRef<CreatePostDialogComponent>);
    service = inject(PostsService)
    user : User = {
      id:0,
      email:'',
      password:'',
      name:''
    }

    post: Post = {
      description: '',
      id: 0,
      email:'',
      interaction:'low'
    };

    mail= '';
    ngOnInit(){
      let user = localStorage.getItem('loginForm');
      if(user) {
        this.user = JSON.parse(user)
        this.mail = this.user.email
        console.log('Correo dado de alta:', this.mail)
        this.post.email = this.mail
      }
    }

    router = inject(Router)

    reload() {
      const currentUrl = this.router.url;
      this.router.navigateByUrl('/blank', { skipLocationChange: true }).then(() => {
        this.router.navigateByUrl(currentUrl);
      });
    }

    onSubmit() {
      console.log('Post a publicar:', this.post)
      this.service.postPost(this.post).subscribe();
      this.reload();
      this.dialogRef.close();
    }
}
