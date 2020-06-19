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
import { MotorcyclesFormerComponent } from './pages/former/motorcycles-former/motorcycles-former.component';
import { SparesFormerComponent } from './pages/former/spares-former/spares-former.component';
import { ToolsFormerComponent } from './pages/former/tools-former/tools-former.component';
import { CostsFormerComponent } from './pages/former/costs-former/costs-former.component';
import { ReportFormerComponent } from './pages/former/report-former/report-former.component';
import { PointComponent } from './pages/conclude/point/point.component';
import { RanksComponent } from './pages/conclude/ranks/ranks.component';
import { GroupsEditComponent } from './pages/groups/groups-edit/groups-edit.component';
import { SearchPastComponent } from './pages/conclude/search-past/search-past.component';
import { PointPastComponent } from './pages/conclude/point-past/point-past.component';
import { RanksPastComponent } from './pages/conclude/ranks-past/ranks-past.component';
import { GroupsCheckedComponent } from './pages/groups/groups-checked/groups-checked.component';
import { GroupsShowComponent } from './pages/groups/groups-show/groups-show.component';
import { GroupsListFormerComponent } from './pages/former/groups-list-former/groups-list-former.component';
import { GroupsFormerComponent } from './pages/former/groups-former/groups-former.component';


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
  { path: 'blank' , component: BlankComponent  },
  { path: 'branch/unchecked' , component: UncheckedComponent},
  { path: 'branch/unchecked/:id' , component: UncheckedListComponent },
  { path: 'branch/checked' , component: CheckedComponent},
  { path: 'branch/checked/:id' , component: CheckedListComponent },
  { path: 'branch/:id/groups' , component: GroupsListComponent },
  { path: 'branch/:id/groups/checked' , component: GroupsCheckedComponent },
  { path: 'branch/:id/groups/checked/:groupId' , component: GroupsShowComponent },
  { path: 'branch/:id/groups/:groupId/add' , component: GroupsAddComponent},
  { path: 'branch/:id/groups/:groupId/edit' , component: GroupsEditComponent},
  { path: 'branch/:id/spares/unchecked' , component: SparesUncheckedComponent },
  { path: 'branch/:id/spares/checked' , component: SparesCheckedComponent},
  { path: 'branch/:id/spares' , component: SparesShowComponent},
  { path: 'branch/:id/motocycles/unchecked' , component: MotorcyclesUncheckedComponent},
  { path: 'branch/:id/motocycles/checked' , component: MotorcyclesCheckedComponent},
  { path: 'branch/:id/motocycles' , component: MotorcyclesShowComponent},
  { path: 'branch/:id/tools/unchecked' , component: ToolsUncheckedComponent},
  { path: 'branch/:id/tools/checked' , component: ToolsCheckedComponent},
  { path: 'branch/:id/tools' , component: ToolsShowComponent},
  { path: 'branch/:id/cost/unchecked' , component: CostUncheckedComponent},
  { path: 'branch/:id/cost/checked' , component: CostCheckedComponent },
  { path: 'branch/:id/cost' , component: CostShowComponent },
  { path: 'branch/:id/report' , component: ReportCheckedComponent},
  { path: 'search' , component: SearchComponent },
  { path: 'result/:year/:month' , component: ResultComponent },
  { path: 'result/:year/:month/branch/:id' , component: BranchFormerComponent },
  { path: 'result/:year/:month/branch/:id/Motorcycles' , component: MotorcyclesFormerComponent },
  { path: 'result/:year/:month/branch/:id/Spares' , component: SparesFormerComponent },
  { path: 'result/:year/:month/branch/:id/Tools' , component: ToolsFormerComponent },
  { path: 'result/:year/:month/branch/:id/Costs' , component: CostsFormerComponent },
  { path: 'result/:year/:month/branch/:id/Report' , component: ReportFormerComponent },
  { path: 'result/:year/:month/branch/:id/groups' , component: GroupsListFormerComponent },
  { path: 'result/:year/:month/branch/:id/groups/:groupId' , component: GroupsFormerComponent },
  { path: 'conclude/point' , component: PointComponent },
  { path: 'conclude/ranks' , component: RanksComponent },
  { path: 'conclude/search' , component: SearchPastComponent },
  { path: 'conclude/result/point/:year/:month' , component: PointPastComponent },
  { path: 'conclude/result/ranks/:year' , component: RanksPastComponent },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule],
  providers: [AuthGuard]
})
export class AppRoutingModule { }
