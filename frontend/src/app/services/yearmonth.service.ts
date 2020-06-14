import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class YearmonthService {

  constructor() { }

  getYear(): Observable<any>{
    let yearArray = [
      {
        name: '2563'
      },
      {
        name: '2562'
      },
      {
        name: '2561'
      },
      {
        name: '2560'
      },
      {
        name: '2559'
      },
      {
        name: '2558'
      },
      {
        name: '2557'
      },
      {
        name: '2556'
      },
      {
        name: '2555'
      },
      {
        name: '2554'
      }
  ];
  return of(yearArray);
  }

  getMonth(): Observable<any>{
    let monthArray = [
      {
        name: 'มกราคม'
      },
      {
        name: 'กุมภาพันธ์'
      },
      {
        name: 'มีนาคม'
      },
      {
        name: 'เมษายน'
      },
      {
        name: 'พฤษภาคม'
      },
      {
        name: 'มิถุนายน'
      },
      {
        name: 'กรกฎาคม'
      },
      {
        name: 'สิงหาคม'
      },
      {
        name: 'กันยายน'
      },
      {
        name: 'ตุลาคม'
      },
      {
        name: 'พฤศจิกายน'
      },
      {
        name: 'ธันวาคม'
      },
  ];
  return of(monthArray);
  }
}
