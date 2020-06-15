import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { SparesService } from 'src/app/services/spares.service';
import { NgForm } from '@angular/forms';
import { LoadingService } from 'src/app/services/loading.service';

@Component({
  selector: 'app-spares-unchecked',
  templateUrl: './spares-unchecked.component.html',
  styleUrls: ['./spares-unchecked.component.scss'],
})
export class SparesUncheckedComponent implements OnInit {
  spares: any;
  amountRemain: any;
  amountChecked: any;
  numberRemain: any;
  numberChecked: any;
  private id: string;

  constructor(
    private route: ActivatedRoute,
    private sparesService: SparesService,
    private loading: LoadingService
    
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        console.log(this.id);

        this.sparesService.getSpares(this.id)
        .subscribe(response => {
          this.spares = response;
          console.log(this.spares);
        });

        this.sparesService.getAmountRemain(this.id)
        .subscribe(response => {
          this.amountRemain = response;
          console.log(this.amountRemain);
        });

        this.sparesService.getNumberRemain(this.id)
        .subscribe(response => {
          this.numberRemain = response;
          console.log(this.numberRemain);
        });

      }
    });
  }
  
  addSpares() {
    //console.log(this.spares);
    // this.sparesService.addSpares(this.id, this.spares);
    this.loading.present();
    this.sparesService.addSpares(this.id, this.spares);
  }
}
