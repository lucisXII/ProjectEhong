import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { MotocyclesService } from 'src/app/services/motocycles.service';
import { LoadingService } from 'src/app/services/loading.service';

@Component({
  selector: 'app-motorcycles-unchecked',
  templateUrl: './motorcycles-unchecked.component.html',
  styleUrls: ['./motorcycles-unchecked.component.scss'],
})
export class MotorcyclesUncheckedComponent implements OnInit {
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

        this.motocyclesService.getMotocycles(this.id)
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

  addMotocycles() {
    this.loading.present();
    this.motocyclesService.addMotorcycles(this.id, this.motocycles);
  }

}
