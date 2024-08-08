import { Routes } from '@angular/router';

export const routes: Routes = [
  {
    path:'',
    loadComponent:()=> import('./@pages/home/home.component').then(m => m.HomeComponent)
  },
  {
    path:'welcome',
    loadComponent: () => import('./components/welcome/welcome.component').then(m => m.WelcomeComponent)
  },
  {
    path:'login',
    loadComponent: () => import('./@pages/login/login.component').then(m => m.LoginComponent)
  },
  {
    path:'register',
    loadComponent: () => import('./@pages/register/register.component').then(m => m.RegisterComponent)
  }
];
