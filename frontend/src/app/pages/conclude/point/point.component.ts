import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-point',
  templateUrl: './point.component.html',
  styleUrls: ['./point.component.scss'],
})
export class PointComponent implements OnInit {
  month: string;
  year: string;

  constructor() { }

  ngOnInit() {
    this.getMonth();
    this.getYear();
  }

  getMonth() {
    this.month = '0' + (new Date().getMonth() + 1).toString().slice(-2);
    if(this.month == '01') {
      this.month = 'มกราคม';
    } 
    else if(this.month == '02') {
      this.month = 'กุมภาพันธ์';
    }
    else if(this.month == '03') {
      this.month = 'มีนาคม';
    }
    else if(this.month == '04') {
      this.month = 'เมษายน';
    }
    else if(this.month == '05') {
      this.month = 'พฤษภาคม';
    }
    else if(this.month == '06') {
      this.month = 'มิถุนายน';
    }
    else if(this.month == '07') {
      this.month = 'กรกฎาคม';
    }
    else if(this.month == '08') {
      this.month = 'สิงหาคม';
    }
    else if(this.month == '09') {
      this.month = 'กันยายน';
    }
    else if(this.month == '10') {
      this.month = 'คุลาคม';
    }
    else if(this.month == '11') {
      this.month = 'พฤศจิกายน';
    }
    else if(this.month == '12') {
      this.month = 'ธันวาคม';
    }
  }

  getYear() {
    this.year = (new Date().getFullYear() + 543).toString();
  }

}
