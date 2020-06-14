import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { AuthService } from '../auth.service';
import { ScreenOrientation } from '@ionic-native/screen-orientation/ngx';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
})
export class LoginComponent implements OnInit {

  constructor(
    private authService: AuthService,
    private screenOrientation: ScreenOrientation
    ) {
     }

  ngOnInit() {
    console.log(this.screenOrientation.type);
    this.screenOrientation.lock(this.screenOrientation.ORIENTATIONS.LANDSCAPE);
    // this.screenOrientation.unlock();
    this.screenOrientation.onChange().subscribe(
      () => {
          console.log("Orientation Changed");
      }
   );
  }


  onLogin(form: NgForm) {
    if(form.invalid) {
      return;
    }
    // console.log(form.value);
    this.authService.login(form.value.username, form.value.password);
  }

}
