import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { NgForm } from '@angular/forms';
import { CostService } from 'src/app/services/cost.service';

@Component({
  selector: 'app-cost-unchecked',
  templateUrl: './cost-unchecked.component.html',
  styleUrls: ['./cost-unchecked.component.scss'],
})
export class CostUncheckedComponent implements OnInit {
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
      }
      this.costService.getTotalCost(this.id)
        .subscribe(response => {
          this.total = response;
          console.log(this.total);
        });
    });
  }

  addCost(form: NgForm) {
    if(form.invalid) {
      return;
    }
    console.log(form.value);
    this.costService.addTotalCost(form.value.money, form.value.comment, form.value.bill, form.value.agreement, this.id);
    // console.log(this.spares);
    // this.authService.login(form.value.username, form.value.password);
  }

}
