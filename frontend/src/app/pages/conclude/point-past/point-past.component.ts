import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { ConcludeService } from 'src/app/services/conclude.service';

@Component({
  selector: 'app-point-past',
  templateUrl: './point-past.component.html',
  styleUrls: ['./point-past.component.scss'],
})
export class PointPastComponent implements OnInit {
  year: string;
  month: string;
  points: any;
  percents: any;
  yearThai: number;
  monthThai: string;
  constructor(
    private concludeService: ConcludeService,
    private route: ActivatedRoute
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('year') && paraMap.has('month')){
        this.year = paraMap.get('year');
        this.month = paraMap.get('month');
        this.getMonth();
        this.getYear();
        console.log(this.month);
        console.log(this.year);

        this.concludeService.getPointsPast(this.month, this.year)
        .subscribe(response => {
          this.points = response;
          console.log(this.points);
        });
        this.concludeService.getPointsPercentPast(this.month, this.year)
        .subscribe(response => {
          this.percents = response;
          console.log(this.percents);
        });
      }
    });
  }

  getMonth() {
    if(this.month == '01') {
      this.monthThai = 'มกราคม';
    } 
    else if(this.month == '02') {
      this.monthThai = 'กุมภาพันธ์';
    }
    else if(this.month == '03') {
      this.monthThai = 'มีนาคม';
    }
    else if(this.month == '04') {
      this.monthThai = 'เมษายน';
    }
    else if(this.month == '05') {
      this.monthThai = 'พฤษภาคม';
    }
    else if(this.month == '06') {
      this.monthThai = 'มิถุนายน';
    }
    else if(this.month == '07') {
      this.monthThai = 'กรกฎาคม';
    }
    else if(this.month == '08') {
      this.monthThai = 'สิงหาคม';
    }
    else if(this.month == '09') {
      this.monthThai = 'กันยายน';
    }
    else if(this.month == '10') {
      this.monthThai = 'คุลาคม';
    }
    else if(this.month == '11') {
      this.monthThai = 'พฤศจิกายน';
    }
    else if(this.month == '12') {
      this.monthThai = 'ธันวาคม';
    }
  }

  getYear() {
    let number: number;
    number = +this.year;
    this.yearThai = number + 543;
  }

}
