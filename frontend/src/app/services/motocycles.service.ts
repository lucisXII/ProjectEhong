import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';
import { Router } from '@angular/router';
import { LoadingService } from './loading.service';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class MotocyclesService {

  constructor(
    private http: HttpClient,
    private router: Router,
    private loading: LoadingService
    ) { }

  getMotocycles(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showMotorcycle/' + id);
  }

  getMotocyclesChecked(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/alldatachekedMotorcycle/' + id);
  }

  getTotal(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showvolume/' + id);
  }
  
  getRemain(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showvolumeChekedMotorcycle/' + id);
  }

  getOutstanding(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/outstanding/' + id);
  }

  getUnready(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/unready/' + id);
  }

  checkedMotocycles(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/chekedMotorcycle/' + id);
  }

  addMotorcycles(id:string, motorcycles: string) {
    const data = {
      motorcycles: motorcycles
    };
    this.http.post<{data: any}>(BACKEND_URL + '/addCheckingMotorcycles'  ,data)
    .subscribe(response => {
      console.log(response);
      this.router.navigate(['/branch/unchecked/' + id]);
      this.loading.dismiss();
      this.loading.presentToast();
    });
  }

  updateMotorcycles(id: string, motorcycles: string) {
    const data = {
      motorcycles: motorcycles
    };
    this.http.patch<{data: any}>(BACKEND_URL + '/updateCheckingMotorcycles'  ,data)
    .subscribe(response => {
      console.log(response);
      this.router.navigate(['/branch/unchecked/' + id]);
      this.loading.dismiss();
      this.loading.presentToast();
    });
  }
}
