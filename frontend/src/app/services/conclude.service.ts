import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class ConcludeService {

  constructor(
    private http: HttpClient,
  ) { }

  getPoints() {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowScoreExcelforMonth');
  }

  getRanks() {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowBranchExcel100ForYear');
  }

  getStartToEnd() {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowMonthExcel100ForYear');
  }

}
