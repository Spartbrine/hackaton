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
  imports: [MatButtonModule, MatDialogActions, MatDialogClose, MatDialogTitle, MatDialogContent],
  templateUrl: './create-post-dialog.component.html',
  styleUrl: './newpost.component.scss'
})
export class CreatePostDialogComponent {
    readonly dialogRef = inject(MatDialogRef<CreatePostDialogComponent>);

}
