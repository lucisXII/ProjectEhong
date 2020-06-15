import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/auth/auth.service';
import { ScreenOrientation } from '@ionic-native/screen-orientation/ngx';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss'],
})
export class HomeComponent implements OnInit {

  constructor(
    private authService: AuthService,
    private screenOrientation: ScreenOrientation
  ) { }

  ngOnInit() {
  //   console.log(this.screenOrientation.type);
  //   this.screenOrientation.lock(this.screenOrientation.ORIENTATIONS.LANDSCAPE);
  //   this.screenOrientation.unlock();
  //   this.screenOrientation.onChange().subscribe(
  //     () => {
  //         console.log("Orientation Changed");
  //     }
  //  );
  }

  onLogout() {
    console.log("logout");
    this.authService.logout();
  }

}
