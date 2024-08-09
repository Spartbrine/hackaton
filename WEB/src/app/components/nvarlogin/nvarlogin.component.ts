import { Component, inject } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { MatButtonModule } from '@angular/material/button';
import { MatDialog, MatDialogActions, MatDialogClose, MatDialogContent, MatDialogRef, MatDialogTitle } from '@angular/material/dialog';
import { Router } from '@angular/router';
import { LoginService } from '../../services/login.service';
import { User } from '../../shared/interfaces';

@Component({
  selector: 'app-nvarlogin',
  standalone: true,
  imports: [],
  templateUrl: './nvarlogin.component.html',
  styleUrl: './nvarlogin.component.scss'
})
export class NvarloginComponent {
  router = inject(Router)
  logout(){
    localStorage.clear()
    this.reload()
  }

  reload() {
    const currentUrl = this.router.url;
    this.router.navigateByUrl('/blank', { skipLocationChange: true }).then(() => {
      this.router.navigateByUrl(currentUrl);
    });
  }

  dialog = inject(MatDialog)
  openDialog(){
    this.dialog.open(SeeProfileDialogComponent, {
      width:'50%',
      height:'50%'
    })
  }}


  @Component({
    selector: 'app-create-post-dialog',
    standalone: true,
    imports: [MatButtonModule, MatDialogActions, MatDialogClose, MatDialogTitle, MatDialogContent, FormsModule],
    templateUrl: './see-profile-dialog.component.html',
    styleUrl: './nvarlogin.component.scss'
  })
  export class SeeProfileDialogComponent {
      readonly dialogRef = inject(MatDialogRef<NvarloginComponent>);
      service = inject(LoginService)
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

      router = inject(Router)

      reload() {
        const currentUrl = this.router.url;
        this.router.navigateByUrl('/blank', { skipLocationChange: true }).then(() => {
          this.router.navigateByUrl(currentUrl);
        });
      }

      onSubmit() {
        // console.log('Post a publicar:', this.post)
        // this.service.postPost(this.post).subscribe();
        this.reload();
        this.dialogRef.close();
      }
  }
