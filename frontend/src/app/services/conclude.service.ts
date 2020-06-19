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

  getStartToEnd() {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowMonthExcel100ForYear');
  }

  getPoints() {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowScoreExcelforMonth');
  }

  getRanks() {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowBranchExcel100ForYear');
  }

  getPointsPast(month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowScoreExcelforMonthOld/' + month + '/' + year);
  }

  getPointsPercentPast(month: string, year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowScoreExcelforMonthPercentOld/' + month + '/' + year);
  }

  getStartToEndPast(year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowMonthExcel100ForYearOld/' + year);
  }

  getRanksPast(year: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowBranchExcel100forYearOld/' + year);
  }

  

  

}
