import { Component } from '@angular/core';
import { NewpostComponent } from '../../components/newpost/newpost.component';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [NewpostComponent],
  templateUrl: './home.component.html',
  styleUrl: './home.component.scss'
})
export class HomeComponent {

}
