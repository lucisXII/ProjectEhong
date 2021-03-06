import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';
import { Router } from '@angular/router';
import { LoadingService } from './loading.service';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class GroupsService {
  checkGroup: string;

  constructor(
    private http: HttpClient,
    private router: Router,
    private loading: LoadingService
    ) { }

  getGroups() {
    return this.http.get<{data: any}>(BACKEND_URL + '/group');
  }

  getCheckedGroups(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/checkedGroup/' + id);
  }

  // checkedGroups(id: string, groupId: string) {
  //   let check: any;
  //   this.http.get<{data: any}>(BACKEND_URL + '/ChekedRateAndScore/' + id + '/' + groupId)
  //   .subscribe(response => {
  //     check = response;
  //     if(check == '0') {
  //       this.router.navigate(['branch/' + id + '/groups/' + groupId + '/add']);
  //     }
  //     else {
  //       this.router.navigate(['branch/' + id + '/groups/' + groupId + '/edit']);
  //     }
  //   });
  // }

  getShowCheckedGroups(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showGroupChecked/' + id);
  }

  getHeadings(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showheading/' + id);
  }

  getRateAndScore(id: string, groupId: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showrate/' + id + '/' + groupId);
  }

  addScore(id: string, headings: string) {
    const data = {
      headings : headings
    };
    this.http.post<{data: any}>(BACKEND_URL + '/addRateAndScore/' + id  ,data)
    .subscribe(response => {
      console.log(response);
      this.router.navigate(['/branch/' + id + '/groups']);
      this.loading.dismiss();
      this.loading.presentToast();
    });
  }

  updateScore(id: string, groupId: string, headings: string) {
    const data = {
      headings : headings
    };
    this.http.patch<{data: any}>(BACKEND_URL + '/updateRateAndScore/' + id + '/' + groupId ,data)
    .subscribe(response => {
      console.log(response);
      this.router.navigate(['/branch/' + id + '/groups']);
      this.loading.dismiss();
      this.loading.presentToast();
    });
  }
}
