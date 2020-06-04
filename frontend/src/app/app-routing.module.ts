import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import { AuthGuard } from './auth/auth.guard';

import { LoginComponent } from './auth/login/login.component';

import { BlankComponent } from './pages/blank/blank.component';
import { HomeComponent } from './pages/home/home.component';
import { UncheckedComponent } from './pages/branch/unchecked/unchecked.component';
import { CheckedComponent } from './pages/branch/checked/checked.component';
import { UncheckedListComponent } from './pages/branch/unchecked-list/unchecked-list.component';
import { CheckedListComponent } from './pages/branch/checked-list/checked-list.component';
import { GroupsComponent } from './pages/groups/groups.component';
import { SparesUncheckedComponent } from './pages/spares/spares-unchecked/spares-unchecked.component';
import { SparesCheckedComponent } from './pages/spares/spares-checked/spares-checked.component';

const routes: Routes = [
  {
    path: 'home',
    loadChildren: () => import('./home/home.module').then( m => m.HomePageModule)
  },
  { path: 'index' , component: HomeComponent, canActivate: [AuthGuard] },
  {
    path: '',
    redirectTo: 'index',
    pathMatch: 'full'
  },
  { path: 'login' , component: LoginComponent },
  { path: 'blank' , component: BlankComponent, canActivate: [AuthGuard] },
  { path: 'branch/unchecked' , component: UncheckedComponent},
  { path: 'branch/unchecked/:id' , component: UncheckedListComponent},
  { path: 'branch/checked' , component: CheckedComponent},
  { path: 'branch/checked/:id' , component: CheckedListComponent},
  { path: 'branch/:id/groups' , component: GroupsComponent},
  { path: 'branch/:id/spares/unchecked' , component: SparesUncheckedComponent},
  { path: 'branch/:id/spares/checked' , component: SparesCheckedComponent},
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule],
  providers: [AuthGuard]
})
export class AppRoutingModule { }
