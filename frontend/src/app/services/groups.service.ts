import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class GroupsService {

  constructor(private http: HttpClient) { }

  getGroups() {
    return this.http.get<{data: any}>(BACKEND_URL + '/group');
  }

  getHeadings(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showheading/' + id);
  }

  getSubHeadings(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/subheading/' + id);
  }

  addScore(id: string, headings: string) {
    const data = {
      headings : headings
    };
    this.http.post<{data: any}>(BACKEND_URL + '/addRateAndScore/' + id  ,data)
    .subscribe(response => {
      console.log(response);
      // this.router.navigate(['/branch/unchecked/' + id]);
      // this.loading.dismiss();
    });
  }
}
