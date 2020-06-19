import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouteReuseStrategy } from '@angular/router';
import { HttpClientModule, HttpClient, HTTP_INTERCEPTORS } from '@angular/common/http';

import { IonicModule, IonicRouteStrategy } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { ScreenOrientation } from '@ionic-native/screen-orientation/ngx';

import { File } from '@ionic-native/file/ngx';
import { FileOpener } from '@ionic-native/file-opener/ngx';

import { LoginComponent } from './auth/login/login.component';
import { BlankComponent } from './pages/blank/blank.component';
import { UncheckedComponent } from './pages/branch/unchecked/unchecked.component';
import { AuthInterceptor } from './auth/auth-interceptor';
import { HomeComponent } from './pages/home/home.component';
import { CheckedComponent } from './pages/branch/checked/checked.component';
import { UncheckedListComponent } from './pages/branch/unchecked-list/unchecked-list.component';
import { CheckedListComponent } from './pages/branch/checked-list/checked-list.component';
import { SparesUncheckedComponent } from './pages/spares/spares-unchecked/spares-unchecked.component';
import { SparesCheckedComponent } from './pages/spares/spares-checked/spares-checked.component';
import { GroupsListComponent } from './pages/groups/groups-list/groups-list.component';
import { MotorcyclesCheckedComponent } from './pages/motorcycles/motorcycles-checked/motorcycles-checked.component';
import { MotorcyclesUncheckedComponent } from './pages/motorcycles/motorcycles-unchecked/motorcycles-unchecked.component';
import { ToolsCheckedComponent } from './pages/tools/tools-checked/tools-checked.component';
import { ToolsUncheckedComponent } from './pages/tools/tools-unchecked/tools-unchecked.component';
import { CostCheckedComponent } from './pages/cost/cost-checked/cost-checked.component';
import { CostUncheckedComponent } from './pages/cost/cost-unchecked/cost-unchecked.component';
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


@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    BlankComponent,
    HomeComponent,
    UncheckedComponent,
    UncheckedListComponent,
    CheckedComponent,
    CheckedListComponent,
    SparesCheckedComponent,
    SparesUncheckedComponent,
    SparesShowComponent,
    GroupsListComponent,
    GroupsShowComponent,
    GroupsAddComponent,
    GroupsEditComponent,
    GroupsCheckedComponent,
    MotorcyclesCheckedComponent,
    MotorcyclesUncheckedComponent,
    MotorcyclesShowComponent,
    ToolsCheckedComponent,
    ToolsUncheckedComponent,
    ToolsShowComponent,
    CostCheckedComponent,
    CostUncheckedComponent,
    CostShowComponent,
    SearchComponent,
    ResultComponent,
    ReportCheckedComponent,
    BranchFormerComponent,
    MotorcyclesFormerComponent,
    SparesFormerComponent,
    ToolsFormerComponent,
    CostsFormerComponent,
    ReportFormerComponent,
    GroupsListFormerComponent,
    GroupsFormerComponent,
    PointComponent,
    RanksComponent,
    PointPastComponent,
    RanksPastComponent,
    SearchPastComponent
  ],
  entryComponents: [],
  imports: [
    BrowserModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    IonicModule.forRoot(),
    AppRoutingModule
  ],
  providers: [
    StatusBar,
    SplashScreen,
    ScreenOrientation,
    File,
    FileOpener,
    {provide: HTTP_INTERCEPTORS , useClass: AuthInterceptor , multi: true},
    { provide: RouteReuseStrategy, useClass: IonicRouteStrategy },
  ],
  bootstrap: [AppComponent]
})
export class AppModule {}
