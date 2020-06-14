import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { ToolsService } from 'src/app/services/tools.service';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-tools-unchecked',
  templateUrl: './tools-unchecked.component.html',
  styleUrls: ['./tools-unchecked.component.scss'],
})
export class ToolsUncheckedComponent implements OnInit {
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

        this.toolsService.getTools(this.id)
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

  addTools(form: NgForm) {
  //  console.log(form.value);
    // console.log(this.tools);
    this.toolsService.addTools(this.tools);
  }
  

}
