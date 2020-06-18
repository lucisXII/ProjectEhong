import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { FormerService } from 'src/app/services/former.service';

@Component({
  selector: 'app-spares-former',
  templateUrl: './spares-former.component.html',
  styleUrls: ['./spares-former.component.scss'],
})
export class SparesFormerComponent implements OnInit {

  spares: any;
  amountRemain: any;
  amountChecked: any;
  numberRemain: any;
  numberChecked: any;
  private id: string;
  private month: string;
  private year: string;

  constructor(
    private route: ActivatedRoute,
    private FormerService: FormerService
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        this.year = paraMap.get('year');
        this.month = paraMap.get('month');
        console.log(this.id);

        this.FormerService.getSparesCheckedOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.spares = response;
          console.log(this.spares);
        });

        this.FormerService.getAmountRemainOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.amountRemain = response;
          console.log(this.amountRemain);
        });
        this.FormerService.getAmountCheckedOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.amountChecked = response;
          console.log(this.amountChecked);
        });
        this.FormerService.getNumberRemainOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.numberRemain = response;
          console.log(this.numberRemain);
        });
        this.FormerService.getNumberCheckedOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.numberChecked = response;
          console.log(this.numberChecked);
        });
      }
    });
  }
}
