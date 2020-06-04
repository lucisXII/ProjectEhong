import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class BranchService {

  constructor(private http: HttpClient) { }

  getBranch(branchID: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/branchs/showBranch/' + branchID);
  }

  getChecked() {
    return this.http.get<{data: any}>(BACKEND_URL + '/branchs/cheked');
  }

  getUnchecked() {
    return this.http.get<{data: any}>(BACKEND_URL + '/branchs/unCheked');
  }
  
}
