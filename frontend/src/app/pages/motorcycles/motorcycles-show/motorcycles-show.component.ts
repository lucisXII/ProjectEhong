import { Component, OnInit } from '@angular/core';
import { MotocyclesService } from 'src/app/services/motocycles.service';
import { ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-motorcycles-show',
  templateUrl: './motorcycles-show.component.html',
  styleUrls: ['./motorcycles-show.component.scss'],
})
export class MotorcyclesShowComponent implements OnInit {
  private id: string;
  motocycles: any;
  total: any;
  remain: any;
  outstanding: any;
  unready: any;

  constructor(
    private route: ActivatedRoute,
    private motocyclesService: MotocyclesService
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        console.log(this.id);

        this.motocyclesService.getMotocyclesChecked(this.id)
        .subscribe(response => {
          this.motocycles = response;
          console.log(this.motocycles);
        });
        this.motocyclesService.getTotal(this.id)
        .subscribe(response => {
          this.total = response;
          console.log(this.total);
        });
        this.motocyclesService.getRemain(this.id)
        .subscribe(response => {
          this.remain = response;
          console.log(this.remain);
        });
        this.motocyclesService.getOutstanding(this.id)
        .subscribe(response => {
          this.outstanding = response;
          console.log(this.outstanding);
        });
        this.motocyclesService.getUnready(this.id)
        .subscribe(response => {
          this.unready = response;
          console.log(this.unready);
        });
      }
    });
  }

}
