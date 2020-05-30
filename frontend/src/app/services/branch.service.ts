import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class BranchService {

  constructor(private http: HttpClient) { }

  getBranch() {
    return this.http.get<{data: any}>(BACKEND_URL + '/branchs/unCheked');
  }

  getUnchecked() {
    return this.http.get<{data: any}>(BACKEND_URL + '/branchs/unCheked');
  }
  
}
