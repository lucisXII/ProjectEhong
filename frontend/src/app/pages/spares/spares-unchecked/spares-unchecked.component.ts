import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { SparesService } from 'src/app/services/spares.service';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-spares-unchecked',
  templateUrl: './spares-unchecked.component.html',
  styleUrls: ['./spares-unchecked.component.scss'],
})
export class SparesUncheckedComponent implements OnInit {
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
      }
    });
  }

}