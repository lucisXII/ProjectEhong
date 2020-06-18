import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Route } from '@angular/compiler/src/core';
import { Router } from '@angular/router';
import { LoadingService } from './loading.service';
import { environment } from 'src/environments/environment.prod';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class FormerService {

  constructor(
    private http: HttpClient,
    private router: Router,
    private loading: LoadingService
  ) { }
 
  //Motocycles
  getMotocyclesOld(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/watchAlldataChekedMotorcycle/' + id + '/' + month + '/' + year);
  }

  getTotalOld(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/watchShowvolume/' + id + '/' + month + '/' + year);
  }

  getRemainOld(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/watchShowvolumeChekedMotorcycle/' + id + '/' + month + '/' + year);
  }

  getOutstandingOld(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/watchOutstanding/' + id + '/' + month + '/' + year);
  }

  getUnreadyOld(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/watchUnready/' + id + '/' + month + '/' + year);
  }
  
 //Spares
 getSparesCheckedOld(id: string, month: string, year: string){
  return this.http.get<{data: any}>(BACKEND_URL + '/alldataChekedSparesOld/' + id + '/' + month + '/' + year);
  }

  getAmountRemainOld(id: string, month: string, year: string){
  return this.http.get<{data: any}>(BACKEND_URL + '/showAmountSparesremainOld/' + id + '/' + month + '/' + year);
  }

  getAmountCheckedOld(id: string, month: string, year: string){
  return this.http.get<{data: any}>(BACKEND_URL + '/showAmountChekedSparesOld/' + id + '/' + month + '/' + year);
  }

  getNumberRemainOld(id: string, month: string, year: string){
  return this.http.get<{data: any}>(BACKEND_URL + '/showNumberSparesremainOld/' + id + '/' + month + '/' + year);
  }

  getNumberCheckedOld(id: string, month: string, year: string){
  return this.http.get<{data: any}>(BACKEND_URL + '/showNumberChekedSparesOld/' + id + '/' + month + '/' + year);
  }

}
