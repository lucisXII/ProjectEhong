import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Route, ParamMap } from '@angular/router';
import { CostService } from 'src/app/services/cost.service';

@Component({
  selector: 'app-cost-show',
  templateUrl: './cost-show.component.html',
  styleUrls: ['./cost-show.component.scss'],
})
export class CostShowComponent implements OnInit {
  private id: string;
  total: any;

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
          this.total = response;
          console.log(this.total);
        });

      }
    });
  }

}
