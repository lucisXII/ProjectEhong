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

  getRateAndScore(id: string, groupId: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/watchAlldataRateAndScore/' + id + '/' + groupId + '/' + month + '/' + year);
  }
 
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

  //Tools
  getToolsCheckedOld(id: string, month: string, year: string){
    return this.http.get<{data: any}>(BACKEND_URL + '/alldataChekedToolsOld/' + id + '/' + month + '/' + year);
  }

  getAmountRemainOldTool(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showAmountToolremainOld/' + id + '/' + month + '/' + year);
  }
  
  getAmountCheckedOldTool(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showAmountChekedToolsOld/' + id + '/' + month + '/' + year);
  }

  getNumberRemainOldTool(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showNumberToolremainOld/' + id + '/' + month + '/' + year);
  }

  getNumberCheckedOldTool(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showNumberChekedToolsOld/' + id + '/' + month + '/' + year);
  }

  //Costs
  getCostOld(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/alldataChekedCostOld/' + id + '/' + month + '/' + year);
  }

  //Report
  getHeadingReportOld(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowHeadReportPDFOld/' + id + '/' + month + '/' + year);
  }

  getDateReportOld(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowHeadReportPDFdateOld/' + id + '/' + month + '/' + year);
  }

  getUserReportOld(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowUserPDFOld/' + id + '/' + month + '/' + year);
  }
  getGroupReportOld(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowScoreGroupPDFOld/' + id + '/' + month + '/' + year);
  }
  getSumReportOld(id: string, month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowScoreSumPDFOld/' + id + '/' + month + '/' + year);
  }
}
