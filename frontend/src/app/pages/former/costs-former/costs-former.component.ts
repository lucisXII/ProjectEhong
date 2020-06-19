import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { FormerService } from 'src/app/services/former.service';

@Component({
  selector: 'app-costs-former',
  templateUrl: './costs-former.component.html',
  styleUrls: ['./costs-former.component.scss'],
})
export class CostsFormerComponent implements OnInit {

  private id: string;
  private month: string;
  private year: string;
  total: any;
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

        this.FormerService.getCostOld(this.id,this.month,this.year)
        .subscribe(response => {
          this.total = response;
          console.log(this.total);
        });

      }
    });
  }

}
