import { Routes } from '@angular/router';
import { authGuard } from './shared/auth.guard';

export const routes: Routes = [
  {
    path:'',
    loadComponent:()=> import('./@pages/home/home.component').then(m => m.HomeComponent),
    canActivate: [authGuard]
  },
  {
    path:'welcome',
    loadComponent: () => import('./components/welcome/welcome.component').then(m => m.WelcomeComponent),
  },
  {
    path:'login',
    loadComponent: () => import('./@pages/login/login.component').then(m => m.LoginComponent),
    canActivate: [authGuard]

  },
  {
    path:'register',
    loadComponent: () => import('./@pages/register/register.component').then(m => m.RegisterComponent),
    canActivate: [authGuard]
  },
  {
    path: '**',
    redirectTo: '/welcome'
  }

];
