import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { FormerService } from 'src/app/services/former.service';

@Component({
  selector: 'app-motorcycles-former',
  templateUrl: './motorcycles-former.component.html',
  styleUrls: ['./motorcycles-former.component.scss'],
})
export class MotorcyclesFormerComponent implements OnInit {

  private id: string;
  motocycles: any;
  total: any;
  remain: any;
  outstanding: any;
  unready: any;
  constructor(
    private route: ActivatedRoute,
    private FormerService: FormerService
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        this.id = paraMap.get('month');
        console.log(this.id);

        // this.FormerService.getMotocyclesOld(this.id,mount,year)
        // .subscribe(response => {
        //   this.motocycles = response;
        //   console.log(this.motocycles);
        // });
        // this.motocyclesService.getTotal(this.id)
        // .subscribe(response => {
        //   this.total = response;
        //   console.log(this.total);
        // });
        // this.motocyclesService.getRemain(this.id)
        // .subscribe(response => {
        //   this.remain = response;
        //   console.log(this.remain);
        // });
        // this.motocyclesService.getOutstanding(this.id)
        // .subscribe(response => {
        //   this.outstanding = response;
        //   console.log(this.outstanding);
        // });
        // this.motocyclesService.getUnready(this.id)
        // .subscribe(response => {
        //   this.unready = response;
        //   console.log(this.unready);
        // });
      }
    });
  }

}
