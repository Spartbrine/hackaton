import { CanActivateFn, Router } from '@angular/router';
import { inject } from '@angular/core';

export const authGuard: CanActivateFn = (route, state) => {
  const router = inject(Router);
  const user = localStorage.getItem('loginForm');

  if (user) {
    if (state.url === '/login' || state.url === '/register' || state.url == '/welcome') {
      router.navigate(['/']);
      return false;
    }
    return true;
  } else {
    if (state.url !== '/login' && state.url !== '/register') {
      router.navigate(['/welcome']);
      return false;
    }
    return true;
  }
};
