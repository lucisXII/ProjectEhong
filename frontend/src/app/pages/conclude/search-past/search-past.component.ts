import { Component, OnInit } from '@angular/core';
import { YearmonthService } from 'src/app/services/yearmonth.service';
import { NgForm } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-search-past',
  templateUrl: './search-past.component.html',
  styleUrls: ['./search-past.component.scss'],
})
export class SearchPastComponent implements OnInit {
  months: any;
  years: any;

  constructor(
    private yearmonthService: YearmonthService,
    private router: Router
  ) { }

  ngOnInit() {
    this.yearmonthService.getMonth()
      .subscribe(respone => {
        this.months = respone;
        console.log(this.months);
    });
    this.yearmonthService.getYear()
      .subscribe(respone => {
        this.years = respone;
        console.log(this.years);
    });
  }

  searchPoint(form: NgForm) {
    this.router.navigate(['/conclude/result/point/' + form.value.year + '/' + form.value.month]);
  }

  searchRank(form: NgForm) {
    this.router.navigate(['/conclude/result/ranks/' + form.value.year]);
  }

}
