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

  getSparesChecked(id: string){
    return this.http.get<{data: any}>(BACKEND_URL + '/alldataChekedSpares/' + id);
    
  }

  getAmountRemain(id: string){
    return this.http.get<{data: any}>(BACKEND_URL + '/showAmountSparesremain/' + id);
  }

  getAmountChecked(id: string){
    return this.http.get<{data: any}>(BACKEND_URL + '/showAmountChekedSpares/' + id);
  }

  getNumberRemain(id: string){
    return this.http.get<{data: any}>(BACKEND_URL + '/showNumberSparesremain/' + id);
  }

  getNumberChecked(id: string){
    return this.http.get<{data: any}>(BACKEND_URL + '/showNumberChekedSpares/' + id);
  }
  
  checkedSpares(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ChekedSpares/' + id);
  }

  addSpares(id: string, spares: string) {
    const data = {
      spares: spares 
    };
    console.log(data);
  }

}
