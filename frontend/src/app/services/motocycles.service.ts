import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.prod';

const BACKEND_URL = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class MotocyclesService {

  constructor(private http: HttpClient) { }

  getMotocyclesChecked(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/alldatachekedMotorcycle/' + id);
  }

  getTotal(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showvolume/' + id);
  }
  
  getRemain(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/showvolumeChekedMotorcycle/' + id);
  }

  getOutstanding(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/outstanding/' + id);
  }

  getUnready(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/unready/' + id);
  }

  checkedMotocycles(id: string) {
    return this.http.get<{data: any}>(BACKEND_URL + '/chekedMotorcycle/' + id);
  }
}
