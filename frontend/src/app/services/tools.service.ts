import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';
import { Router } from '@angular/router';
import { LoadingService } from './loading.service';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class ToolsService {

  constructor(
    private http: HttpClient,
    private router: Router,
    private loading: LoadingService
    ) { }

  getTools(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showTools/' + id);
  }

  getAmount(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showAmountTool/' + id);
  }

  getNumber(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showNumberTool/' + id);
  }

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

  addTools(id: string, tools: any) {
    const data = {
      tools: tools 
    };
    this.http.post<{data: any}>(BACKEND_URL + '/addCheckingTool'  ,data)
    .subscribe(response => {
      console.log(response);
      this.router.navigate(['/branch/unchecked/' + id]);
      this.loading.dismiss();
    });
  }

  updateTools(id: string, tools: any) {
    const data = {
      tools: tools 
    };
    console.log(data);
    this.http.patch<{data: any}>(BACKEND_URL + '/updateCheckingTool'  ,data)
    .subscribe(response => {
      console.log(response);
      this.router.navigate(['/branch/unchecked/' + id]);
      this.loading.dismiss();
      this.loading.presentToast();
    });
  }
}
