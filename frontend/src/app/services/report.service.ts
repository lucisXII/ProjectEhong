import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.prod';
import { HttpClient } from '@angular/common/http';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class ReportService {

  constructor(
    private http: HttpClient
  ) { }

  getHeadingReport(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowHeadReportPDF/' + id);
  }

  getDateReport(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowHeadReportPDFdate/' + id);
  }

  getUserReport(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowUserPDF/' + id);
  }
  getGroupReport(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowScoreGroupPDF/' + id);
  }
  getSumReport(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/ShowScoreSumPDF/' + id);
  }
}
