import { Component } from '@angular/core';
import { NewpostComponent } from '../../components/newpost/newpost.component';
import { NvarloginComponent } from '../../components/nvarlogin/nvarlogin.component';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [NewpostComponent, NvarloginComponent],
  templateUrl: './home.component.html',
  styleUrl: './home.component.scss'
})
export class HomeComponent {

}
