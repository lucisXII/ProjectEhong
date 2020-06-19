import { Component, OnInit } from '@angular/core';
import { FormerService } from 'src/app/services/former.service';
import { ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-tools-former',
  templateUrl: './tools-former.component.html',
  styleUrls: ['./tools-former.component.scss'],
})
export class ToolsFormerComponent implements OnInit {

  private id: string;
  private month: string;
  private year: string;
  tools: any;
  amountRemain: any;
  amountChecked: any;
  numberRemain: any;
  numberChecked: any;

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

        this.FormerService.getToolsCheckedOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.tools = response;
          console.log(this.tools);
        });

        this.FormerService.getAmountRemainOldTool(this.id,this.month,this.year)
        .subscribe(response => {
          this.amountRemain = response;
          console.log(this.amountRemain);
        });
        this.FormerService.getAmountCheckedOldTool(this.id,this.month,this.year)
        .subscribe(response => {
          this.amountChecked = response;
          console.log(this.amountChecked);
        });
        this.FormerService.getNumberRemainOldTool(this.id,this.month,this.year)
        .subscribe(response => {
          this.numberRemain = response;
          console.log(this.numberRemain);
        });
        this.FormerService.getNumberCheckedOldTool(this.id,this.month,this.year)
        .subscribe(response => {
          this.numberChecked = response;
          console.log(this.numberChecked);
        });

      }
    });
  }
}
