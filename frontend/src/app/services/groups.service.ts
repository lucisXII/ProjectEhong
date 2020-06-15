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

  constructor(
    private http: HttpClient,
    private router: Router,
    private loading: LoadingService
    ) { }

  getGroups() {
    return this.http.get<{data: any}>(BACKEND_URL + '/group');
  }

  checkedGroups(branchId: string, groupId: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ChekedRateAndScore/' + branchId + '/' + groupId);
  }

  getHeadings(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showheading/' + id);
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
    });
  }
}
