import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { ToolsService } from 'src/app/services/tools.service';
import { NgForm } from '@angular/forms';
import { LoadingService } from 'src/app/services/loading.service';

@Component({
  selector: 'app-tools-unchecked',
  templateUrl: './tools-unchecked.component.html',
  styleUrls: ['./tools-unchecked.component.scss'],
})
export class ToolsUncheckedComponent implements OnInit {
  private id: string;
  tools: any;
  amount: any;
  number: any;
  
  constructor(
    private route: ActivatedRoute,
    private toolsService: ToolsService,
    private loading: LoadingService
  ) {}

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

        this.toolsService.getAmount(this.id)
        .subscribe(response => {
          this.amount = response;
          console.log(this.amount);
        });
        this.toolsService.getNumber(this.id)
        .subscribe(response => {
          this.number = response;
          console.log(this.number);
        });
      }
    });
  }

  addTools() {
    let count = 0;
    this.tools.forEach(tool => {
      if(tool.score == null) {
        count++;
      }
    });
    if(count > 0) {
      this.loading.presentToastWarning();
    }
    else {
      this.loading.present();
      this.toolsService.addTools(this.id, this.tools);
    }
  }
}
