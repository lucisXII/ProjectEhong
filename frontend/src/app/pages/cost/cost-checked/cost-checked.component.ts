import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-cost-checked',
  templateUrl: './cost-checked.component.html',
  styleUrls: ['./cost-checked.component.scss'],
})
export class CostCheckedComponent implements OnInit {
  private id: string;

  constructor(
    private route: ActivatedRoute,
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        console.log(this.id);
      }
    });
    
  }

}
