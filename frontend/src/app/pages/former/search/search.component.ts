import { Component, OnInit } from '@angular/core';
import { YearmonthService } from 'src/app/services/yearmonth.service';
import { NgForm } from '@angular/forms';
import { SearchService } from 'src/app/services/search.service';
import { LoadingService } from 'src/app/services/loading.service';
import { ActivatedRoute, Router } from '@angular/router';

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
    private loading: LoadingService,
    private router: Router
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
    // this.loading.present();
    this.router.navigate(['/result/' + form.value.year + '/' + form.value.month]);
    //console.log(form.value);
    // this.searchService.search(form.value.year, form.value.month);
  }

}
