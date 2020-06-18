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
//import { GroupShowComponent } from './pages/groups/group-show/group-show.component';
import { MotorcyclesUncheckedComponent } from './pages/motorcycles/motorcycles-unchecked/motorcycles-unchecked.component';
import { MotorcyclesCheckedComponent } from './pages/motorcycles/motorcycles-checked/motorcycles-checked.component';
import { ToolsUncheckedComponent } from './pages/tools/tools-unchecked/tools-unchecked.component';
import { ToolsCheckedComponent } from './pages/tools/tools-checked/tools-checked.component';
import { CostUncheckedComponent } from './pages/cost/cost-unchecked/cost-unchecked.component';
import { CostCheckedComponent } from './pages/cost/cost-checked/cost-checked.component';
import { CostShowComponent } from './pages/cost/cost-show/cost-show.component';
import { MotorcyclesShowComponent } from './pages/motorcycles/motorcycles-show/motorcycles-show.component';
import { SparesShowComponent } from './pages/spares/spares-show/spares-show.component';
import { ToolsShowComponent } from './pages/tools/tools-show/tools-show.component';
import { SearchComponent } from './pages/former/search/search.component';
import { ResultComponent } from './pages/former/result/result.component';
import { GroupsAddComponent } from './pages/groups/groups-add/groups-add.component';
import { ReportCheckedComponent } from './pages/reports/report-checked/report-checked.component';
import { BranchFormerComponent } from './pages/former/branch-former/branch-former.component';
import { PointComponent } from './pages/conclude/point/point.component';
import { RanksComponent } from './pages/conclude/ranks/ranks.component';

const routes: Routes = [
  {
    path: 'home',
    loadChildren: () => import('./home/home.module').then( m => m.HomePageModule)
  },
  { path: 'index' , component: HomeComponent},
  {
    path: '',
    redirectTo: 'index',
    pathMatch: 'full'
  },
  { path: 'login' , component: LoginComponent },
  { path: 'blank' , component: BlankComponent , canActivate: [AuthGuard] },
  { path: 'branch/unchecked' , component: UncheckedComponent, canActivate: [AuthGuard] },
  { path: 'branch/unchecked/:id' , component: UncheckedListComponent, canActivate: [AuthGuard] },
  { path: 'branch/checked' , component: CheckedComponent, canActivate: [AuthGuard] },
  { path: 'branch/checked/:id' , component: CheckedListComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/groups' , component: GroupsListComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/groups/:groupId/add' , component: GroupsAddComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/spares/unchecked' , component: SparesUncheckedComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/spares/checked' , component: SparesCheckedComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/spares' , component: SparesShowComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/motocycles/unchecked' , component: MotorcyclesUncheckedComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/motocycles/checked' , component: MotorcyclesCheckedComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/motocycles' , component: MotorcyclesShowComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/tools/unchecked' , component: ToolsUncheckedComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/tools/checked' , component: ToolsCheckedComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/tools' , component: ToolsShowComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/cost/unchecked' , component: CostUncheckedComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/cost/checked' , component: CostCheckedComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/cost' , component: CostShowComponent, canActivate: [AuthGuard] },
  { path: 'branch/:id/report' , component: ReportCheckedComponent , canActivate: [AuthGuard] },
  { path: 'search' , component: SearchComponent },
  { path: 'result/:year/:month' , component: ResultComponent },
  { path: 'result/:year/:month/branch/:id' , component: BranchFormerComponent },
  { path: 'conclude/point' , component: PointComponent },
  { path: 'conclude/ranks' , component: RanksComponent },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule],
  providers: [AuthGuard]
})
export class AppRoutingModule { }
