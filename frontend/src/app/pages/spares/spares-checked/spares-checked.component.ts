import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { SparesService } from 'src/app/services/spares.service';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-spares-checked',
  templateUrl: './spares-checked.component.html',
  styleUrls: ['./spares-checked.component.scss'],
})
export class SparesCheckedComponent implements OnInit {
  spares: any;
  amount: any;
  number: any;
  private id: string;

  constructor(
    private route: ActivatedRoute,
    private sparesService: SparesService
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

        this.sparesService.getAmountSpares(this.id)
        .subscribe(response => {
          this.amount = response;
          console.log(this.amount);
        });
        this.sparesService.getNumberSpares(this.id)
        .subscribe(response => {
          this.number = response;
          console.log(this.number);
        });
      }
    });
  }

  onAddSpares(form: NgForm) {
    if(form.invalid) {
      return;
    }
    console.log(form.value);
    console.log(this.spares);
    // this.authService.login(form.value.username, form.value.password);
  }

}
