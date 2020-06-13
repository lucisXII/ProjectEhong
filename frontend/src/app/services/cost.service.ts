import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject } from 'rxjs';
import { environment } from '../../environments/environment.prod';
import { Router } from '@angular/router';
import { LoadingService } from './loading.service';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class CostService {
  private total: any;
  private totalUpdated = new BehaviorSubject('');

  constructor(
    private http: HttpClient,
    private router: Router,
    public loading: LoadingService
    ) { }

  getTotalCost(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/totalcost/' + id);
  }

  getCost(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/alldataChekedCost/' + id);
  }

  checkedCost(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/checkedCost/' + id);
  }

  addTotalCost(money: string, comment: string, bill: string, agreement: string, tcost_id: string, id: string) {
    const data = {
      money: money, 
      comment: comment, 
      bill: bill, 
      agreement: agreement
    };
    // console.log(data);
    // console.log(id);
    this.http.post<{data: any}>(BACKEND_URL + '/addCost/' + tcost_id ,data)
    .subscribe(response => {
      console.log(response);
      this.loading.dismiss();
      this.router.navigate(['/branch/unchecked/' + id]);
      // this.total = response.data;
      // console.log('Add Education Success!');
    });
  }

  updateTotalCost(money: string, comment: string, bill: string, agreement: string, cost_id: string, id: string) {
    const data = {
      money: money, 
      comment: comment, 
      bill: bill, 
      agreement: agreement
    };
    this.http.patch<{data: any}>(BACKEND_URL + '/updateCost/' + cost_id ,data)
    .subscribe(response => {
      console.log(response);
      this.loading.dismiss();
      this.router.navigate(['/branch/unchecked/' + id]);
    });
  }

  
}
