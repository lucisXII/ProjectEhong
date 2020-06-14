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
        id: '2020',
        name: '2563'
      },
      {
        id: '2019',
        name: '2562'
      },
      {
        id: '2018',
        name: '2561'
      },
      {
        id: '2017',
        name: '2560'
      },
      {
        id: '2016',
        name: '2559'
      },
      {
        id: '2015',
        name: '2558'
      },
      {
        id: '2014',
        name: '2557'
      },
      {
        id: '2013',
        name: '2556'
      },
      {
        id: '2012',
        name: '2555'
      },
      {
        id: '2011',
        name: '2554'
      }
  ];
  return of(yearArray);
  }

  getMonth(): Observable<any>{
    let monthArray = [
      {
        id: '01',
        name: 'มกราคม'
      },
      {
        id: '02',
        name: 'กุมภาพันธ์'
      },
      {
        id: '03',
        name: 'มีนาคม'
      },
      {
        id: '04',
        name: 'เมษายน'
      },
      {
        id: '05',
        name: 'พฤษภาคม'
      },
      {
        id: '06',
        name: 'มิถุนายน'
      },
      {
        id: '07',
        name: 'กรกฎาคม'
      },
      {
        id: '08',
        name: 'สิงหาคม'
      },
      {
        id: '09',
        name: 'กันยายน'
      },
      {
        id: '10',
        name: 'ตุลาคม'
      },
      {
        id: '11',
        name: 'พฤศจิกายน'
      },
      {
        id: '12',
        name: 'ธันวาคม'
      },
  ];
  return of(monthArray);
  }
}
