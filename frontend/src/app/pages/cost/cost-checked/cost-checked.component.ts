import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { CostService } from 'src/app/services/cost.service';

@Component({
  selector: 'app-cost-checked',
  templateUrl: './cost-checked.component.html',
  styleUrls: ['./cost-checked.component.scss'],
})
export class CostCheckedComponent implements OnInit {
  private id: string;
  cost: any;

  constructor(
    private route: ActivatedRoute,
    private costService: CostService
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        console.log(this.id);

        this.costService.getCost(this.id)
        .subscribe(response => {
          this.cost = response;
          console.log(this.cost);
        });

      }
    });
    
  }

}
