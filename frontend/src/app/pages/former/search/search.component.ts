import { Component, OnInit } from '@angular/core';
import { YearmonthService } from 'src/app/services/yearmonth.service';
import { NgForm } from '@angular/forms';
import { SearchService } from 'src/app/services/search.service';
import { LoadingService } from 'src/app/services/loading.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss'],
})
export class SearchComponent implements OnInit {
  months: any;
  years: any;

  constructor(
    private yearmonthService: YearmonthService,
    private searchService: SearchService,
    private loading: LoadingService
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
    this.loading.present();
    //console.log(form.value);
    this.searchService.search(form.value.year, form.value.month);
  }

}
