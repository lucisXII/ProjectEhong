import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class ToolsService {

  constructor(private http: HttpClient) { }

  getToolsChecked(id: string){
    return this.http.get<{data: any}>(BACKEND_URL + '/alldataChekedTools/' + id);
  }

  getAmountRemain(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showAmountToolremain/' + id);
  }
  
  getAmountChecked(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showAmountChekedTools/' + id);
  }

  getNumberRemain(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showNumberToolremain/' + id);
  }

  getNumberChecked(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showNumberChekedTools/' + id);
  }

  checkedTools(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/chekedTools/' + id);
  }
}
