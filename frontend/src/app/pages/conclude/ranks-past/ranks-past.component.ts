import { Component, OnInit } from '@angular/core';
import { ConcludeService } from 'src/app/services/conclude.service';
import { ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-ranks-past',
  templateUrl: './ranks-past.component.html',
  styleUrls: ['./ranks-past.component.scss'],
})
export class RanksPastComponent implements OnInit {
  year: any;
  yearThai: string;
  startToEnd: any;
  ranks: any;

  constructor(
    private concludeService: ConcludeService,
    private route: ActivatedRoute,
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('year')){
        this.year = paraMap.get('year');
        this.getYear();

        this.concludeService.getStartToEndPast(this.year)
        .subscribe(response => {
          this.startToEnd = response;
          console.log(this.startToEnd);
        });
        this.concludeService.getRanksPast(this.year)
        .subscribe(response => {
          this.ranks = response;
          console.log(this.ranks);
        });
      }
    });
  }

  getYear() {
    let number: number;
    number = +this.year;
    this.yearThai = (number + 543).toString();
  }

}
