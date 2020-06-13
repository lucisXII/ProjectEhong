import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { CostService } from 'src/app/services/cost.service';
import { NgForm } from '@angular/forms';
import { LoadingService } from 'src/app/services/loading.service';

@Component({
  selector: 'app-cost-checked',
  templateUrl: './cost-checked.component.html',
  styleUrls: ['./cost-checked.component.scss'],
})
export class CostCheckedComponent implements OnInit {
  private id: string;
  total: any;

  constructor(
    private route: ActivatedRoute,
    private costService: CostService,
    private loading: LoadingService
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

  updateCost(form: NgForm) {
    if(form.invalid) {
      return;
    }
    this.loading.present();
    this.costService.updateTotalCost(form.value.money, form.value.comment, form.value.bill, form.value.agreement, this.total.cost_id, this.id);
  }

}
