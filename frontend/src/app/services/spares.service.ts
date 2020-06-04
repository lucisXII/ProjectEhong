import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class SparesService {

  constructor(private http: HttpClient) { }

  getSpares(id: string){
    return this.http.get<{data: any}>(BACKEND_URL + '/showSpares/' + id);
  }

  getAmountSpares(id: string){
    return this.http.get<{data: any}>(BACKEND_URL + '/showAmountSpares/' + id);
  }

  getNumberSpares(id: string){
    return this.http.get<{data: any}>(BACKEND_URL + '/showNumberSpares/' + id);
  }

  
  checkSpares(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ChekedSpares/' + id);
  }

}
