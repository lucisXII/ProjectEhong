import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';
import { Router } from '@angular/router';
import { LoadingService } from './loading.service';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class SearchService {
  result: any;
  
  constructor(
    private http: HttpClient,
    private router: Router,
    private loading: LoadingService
    ) { }

  search(year: string,month: string) {
    //return this.http.get<{data: any}>(BACKEND_URL + '/branchs/Search/result/' + year + '/' + month);
    const data = {
      year: year, 
      month: month
    };
    // console.log(data);
    return this.http.post<{data: any}>(BACKEND_URL + '/branchs/search' ,data);
  }

  getResult() {
    // return this.result;
    // return this.http.get<{data: any}>(BACKEND_URL + '/branchs/search');
  }
}
