import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class CostService {

  constructor(private http: HttpClient) { }

  checkedCost(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/checkedCost/' + id);
  }
}
