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
import { SparesUncheckedComponent } from './pages/spares/spares-unchecked/spares-unchecked.component';
import { SparesCheckedComponent } from './pages/spares/spares-checked/spares-checked.component';
import { GroupsListComponent } from './pages/groups/groups-list/groups-list.component';
import { GroupShowComponent } from './pages/groups/group-show/group-show.component';
import { MotorcyclesUncheckedComponent } from './pages/motorcycles/motorcycles-unchecked/motorcycles-unchecked.component';
import { MotorcyclesCheckedComponent } from './pages/motorcycles/motorcycles-checked/motorcycles-checked.component';
import { ToolsUncheckedComponent } from './pages/tools/tools-unchecked/tools-unchecked.component';
import { ToolsCheckedComponent } from './pages/tools/tools-checked/tools-checked.component';
import { CostUncheckedComponent } from './pages/cost/cost-unchecked/cost-unchecked.component';
import { CostCheckedComponent } from './pages/cost/cost-checked/cost-checked.component';

const routes: Routes = [
  {
    path: 'home',
    loadChildren: () => import('./home/home.module').then( m => m.HomePageModule)
  },
  { path: 'index' , component: HomeComponent },
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
  { path: 'branch/:id/groups' , component: GroupsListComponent},
  { path: 'branch/:id/groups/:groupId' , component: GroupShowComponent},
  { path: 'branch/:id/spares/unchecked' , component: SparesUncheckedComponent},
  { path: 'branch/:id/spares/checked' , component: SparesCheckedComponent},
  { path: 'branch/:id/motocycles/unchecked' , component: MotorcyclesUncheckedComponent},
  { path: 'branch/:id/motocycles/checked' , component: MotorcyclesCheckedComponent},
  { path: 'branch/:id/tools/unchecked' , component: ToolsUncheckedComponent},
  { path: 'branch/:id/tools/checked' , component: ToolsCheckedComponent},
  { path: 'branch/:id/cost/unchecked' , component: CostUncheckedComponent},
  { path: 'branch/:id/cost/checked' , component: CostCheckedComponent},
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule],
  providers: [AuthGuard]
})
export class AppRoutingModule { }
