import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';
import { Router } from '@angular/router';
import { LoadingService } from './loading.service';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class SparesService {

  constructor(
    private http: HttpClient,
    private router: Router,
    private loading: LoadingService
    ) { }

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
  
  getAmountRemainSpares(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showAmountSpares/' + id);
  }

  getNumberRemainSpares(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showNumberSpares/' + id);
  }

  addSpares(id: string, spares: string) {
    const data = {
      spares: spares 
    };
    // console.log(data);
    this.http.post<{data: any}>(BACKEND_URL + '/addCheckingSpares'  ,data)
    .subscribe(response => {
      console.log(response);
      this.router.navigate(['/branch/unchecked/' + id]);
      this.loading.dismiss();
      this.loading.presentToast();
    });
  }

  updateSpares(id: string, spares: string) {
    const data = {
      spares: spares 
    };
    this.http.patch<{data: any}>(BACKEND_URL + '/updateCheckingSpares'  ,data)
    .subscribe(response => {
      console.log(response);
      this.router.navigate(['/branch/unchecked/' + id]);
      this.loading.dismiss();
      this.loading.presentToast();
    });
  }

}
