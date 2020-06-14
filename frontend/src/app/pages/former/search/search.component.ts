import { Component, OnInit } from '@angular/core';
import { YearmonthService } from 'src/app/services/yearmonth.service';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss'],
})
export class SearchComponent implements OnInit {
  months: any;
  years: any;

  constructor(
    private yearmonthService: YearmonthService
  ) { }

  // getMonth() {
  //   this.yearmonthService.getMonth
  //   .subscribe(respone => {
  //     this.month = respone
  //   });
  // }
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

  searchForm(form: NgForm) {
    if(form.invalid) {
      return;
    }
    console.log(form.value);
  }

}
