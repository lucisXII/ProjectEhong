import { Component, OnInit } from '@angular/core';
import { ConcludeService } from 'src/app/services/conclude.service';

@Component({
  selector: 'app-ranks',
  templateUrl: './ranks.component.html',
  styleUrls: ['./ranks.component.scss'],
})
export class RanksComponent implements OnInit {
  year: string;
  startToEnd: any;

  constructor(
    private concludeService: ConcludeService
  ) { }

  ngOnInit() {
    this.concludeService.getStartToEnd()
        .subscribe(response => {
        this.startToEnd = response;
        console.log(this.startToEnd);
   });

    this.getYear();
  }

  getYear() {
    this.year = (new Date().getFullYear() + 543).toString();
  }

}
