import { Component, OnInit } from '@angular/core';
import { SearchService } from 'src/app/services/search.service';

@Component({
  selector: 'app-result',
  templateUrl: './result.component.html',
  styleUrls: ['./result.component.scss'],
})
export class ResultComponent implements OnInit {
  results: any;
  year: any;
  month: any;

  constructor(
    private searchService: SearchService
  ) { }

  ngOnInit() {}
    
  getResult() {
    this.searchService.search(this.year, this.month)
    .subscribe(response => {
        this.results = response;
        console.log(this.results)
      });
    // this.searchService.search()
    // .subscribe(this.result => {
    //   this.results = response;
    //   console.log(this.results)
    // });
  }

  viewBranch(id) {

  }
}
