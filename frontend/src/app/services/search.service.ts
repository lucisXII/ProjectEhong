import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class SearchService {

  constructor(private http: HttpClient) { }

  getResult(year: string,month: string) {
    //return this.http.get<{data: any}>(BACKEND_URL + '/branchs/Search/result/' + year + '/' + month);
    const data = {
      year: year, 
      month: month
    };
    console.log(data);
  }
}
