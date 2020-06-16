import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';
import { LoadingService } from './loading.service';
import { Route } from '@angular/compiler/src/core';
import { Router } from '@angular/router';


const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class BranchService {

  constructor(
    private http: HttpClient,
    private loading: LoadingService,
    private router: Router
    ) { }

  getBranch(branchID: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/branchs/showBranch/' + branchID);
  }

  getChecked() {
    return this.http.get<{data: any}>(BACKEND_URL + '/branchs/cheked');
  }

  getUnchecked() {
    return this.http.get<{data: any}>(BACKEND_URL + '/branchs/unCheked');
  }
  
  getCheckedRateAndScore(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ChekedRateAndScoreLast/'+ id);
  }
  
  getChekedMotorcycle(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/chekedMotorcycle/'+ id);
  }

  getChekedSpares(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ChekedSpares/'+ id);
  }

  getchekedTools(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/chekedTools/'+ id);
  }
  getcheckedCost(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/checkedCost/'+ id);
  }

  addConcludes(id: string) {
    const data = {
      id: id
    };
    this.http.post<{data: any}>(BACKEND_URL + '/addconclude/' + id ,data)
    .subscribe(response => {
      console.log(response);
      this.loading.dismiss();
      this.router.navigate(['/branch/checked/' + id]);
      this.loading.presentToast();});
  
    }
} 

