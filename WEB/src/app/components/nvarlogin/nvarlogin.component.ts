import { Component } from '@angular/core';

@Component({
  selector: 'app-nvarlogin',
  standalone: true,
  imports: [],
  templateUrl: './nvarlogin.component.html',
  styleUrl: './nvarlogin.component.scss'
})
export class NvarloginComponent {
  logout(){
    localStorage.clear()
    
  }
}
