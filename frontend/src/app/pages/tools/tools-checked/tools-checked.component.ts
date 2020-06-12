import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { NgForm } from '@angular/forms';
import { ToolsService } from 'src/app/services/tools.service';


@Component({
  selector: 'app-tools-checked',
  templateUrl: './tools-checked.component.html',
  styleUrls: ['./tools-checked.component.scss'],
})
export class ToolsCheckedComponent implements OnInit {
  private id: string;
  tools: any;
  amountRemain: any;
  amountChecked: any;
  numberRemain: any;
  numberChecked: any;
  
  constructor(
    private route: ActivatedRoute,
    private toolsService: ToolsService
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        console.log(this.id);

        this.toolsService.getToolsChecked(this.id)
        .subscribe(response => {
          this.tools = response;
          console.log(this.tools);
        });

        this.toolsService.getAmountRemain(this.id)
        .subscribe(response => {
          this.amountRemain = response;
          console.log(this.amountRemain);
        });
        this.toolsService.getAmountChecked(this.id)
        .subscribe(response => {
          this.amountChecked = response;
          console.log(this.amountChecked);
        });
        this.toolsService.getNumberRemain(this.id)
        .subscribe(response => {
          this.numberRemain = response;
          console.log(this.numberRemain);
        });
        this.toolsService.getNumberChecked(this.id)
        .subscribe(response => {
          this.numberChecked = response;
          console.log(this.numberChecked);
        });
      }
    });
  }

}
