import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss'],
})
export class LoginComponent implements OnInit {

  constructor(private authService: AuthService) { }

  ngOnInit() {}

  onLogin(form: NgForm) {
    if(form.invalid) {
      return;
    }
    // console.log(form.value);
    this.authService.login(form.value.username, form.value.password);
  }

}
