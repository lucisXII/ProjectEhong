import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject } from 'rxjs';
import { environment } from '../../environments/environment.prod';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class CostService {
  private total: any;
  private totalUpdated = new BehaviorSubject('');

  constructor(private http: HttpClient) { }

  getTotalCost(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/totalcost/' + id);
  }

  getCost(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/alldataChekedCost/' + id);
  }

  checkedCost(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/checkedCost/' + id);
  }

  addTotalCost(money: string, comment: string, bill: string, agreement: string, id: string) {
    const data = {
      money: money, 
      comment: comment, 
      bill: bill, 
      agreement: agreement
    };
    console.log(data);
    console.log(id);
    this.http.post<{data: any}>(BACKEND_URL + '/addCost/' + id ,data)
    .subscribe(response => {
      this.total = response.data;
      console.log('Add Education Success!');
    });
  }

  
}
