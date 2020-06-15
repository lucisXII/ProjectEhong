import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { MotocyclesService } from 'src/app/services/motocycles.service';
import { LoadingService } from 'src/app/services/loading.service';

@Component({
  selector: 'app-motorcycles-checked',
  templateUrl: './motorcycles-checked.component.html',
  styleUrls: ['./motorcycles-checked.component.scss'],
})
export class MotorcyclesCheckedComponent implements OnInit {
  private id: string;
  motocycles: any;
  total: any;
  remain: any;
  outstanding: any;
  unready: any;

  constructor(
    private route: ActivatedRoute,
    private motocyclesService: MotocyclesService,
    private loading: LoadingService
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

  updateMotorcycles() {
    this.loading.present();
    this.motocyclesService.updateMotorcycles(this.id, this.motocycles);
  }

}
