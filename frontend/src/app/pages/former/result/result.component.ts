import { Component, OnInit } from '@angular/core';
import { SearchService } from 'src/app/services/search.service';
import { ActivatedRoute, ParamMap } from '@angular/router';

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
    private searchService: SearchService,
    private route: ActivatedRoute,
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('year')){
        this.year = paraMap.get('year');
        this.month = paraMap.get('month');
        console.log(this.year);
        console.log(this.month);

        this.searchService.search(this.year, this.month)
        .subscribe(response => {
          this.results = response;
          console.log(this.results);
        });
      }
    });
  }
    
  getResult() {
    // this.searchService.search(this.year, this.month)
    // .subscribe(response => {
    //     this.results = response;
    //     console.log(this.results)
    //   });
    // this.searchService.search()
    // .subscribe(this.result => {
    //   this.results = response;
    //   console.log(this.results)
    // });
  }

  viewBranch(id) {

  }
}
