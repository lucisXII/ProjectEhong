import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouteReuseStrategy } from '@angular/router';
import { HttpClientModule, HttpClient, HTTP_INTERCEPTORS } from '@angular/common/http';

import { IonicModule, IonicRouteStrategy } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { FormsModule, FormControlDirective, ReactiveFormsModule } from '@angular/forms';
import { ScreenOrientation } from '@ionic-native/screen-orientation/ngx';

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
import { GroupShowComponent } from './pages/groups/group-show/group-show.component';
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
    GroupShowComponent,
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
    ResultComponent
  ],
  entryComponents: [],
  imports: [
    BrowserModule,
    HttpClientModule,
    FormsModule,
    IonicModule.forRoot(),
    AppRoutingModule
  ],
  providers: [
    StatusBar,
    SplashScreen,
    ScreenOrientation,
    {provide: HTTP_INTERCEPTORS , useClass: AuthInterceptor , multi: true},
    { provide: RouteReuseStrategy, useClass: IonicRouteStrategy }
  ],
  bootstrap: [AppComponent]
})
export class AppModule {}
