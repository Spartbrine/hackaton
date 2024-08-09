import { Component, inject } from '@angular/core';
import { Router } from '@angular/router';

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
}
