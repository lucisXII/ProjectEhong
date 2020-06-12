import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouteReuseStrategy } from '@angular/router';
import { HttpClientModule, HttpClient, HTTP_INTERCEPTORS } from '@angular/common/http';

import { IonicModule, IonicRouteStrategy } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { FormsModule } from '@angular/forms';

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
    GroupsListComponent,
    GroupShowComponent,
    MotorcyclesCheckedComponent,
    MotorcyclesUncheckedComponent,
    ToolsCheckedComponent,
    ToolsUncheckedComponent,
    CostCheckedComponent,
    CostUncheckedComponent
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
    {provide: HTTP_INTERCEPTORS , useClass: AuthInterceptor , multi: true},
    { provide: RouteReuseStrategy, useClass: IonicRouteStrategy }
  ],
  bootstrap: [AppComponent]
})
export class AppModule {}
