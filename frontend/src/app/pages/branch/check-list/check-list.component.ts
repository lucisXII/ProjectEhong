import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { Router } from '@angular/router';
import { BranchService } from './../../../services/branch.service';

@Component({
  selector: 'app-check-list',
  templateUrl: './check-list.component.html',
  styleUrls: ['./check-list.component.scss'],
})
export class CheckListComponent implements OnInit {
  
  private id: string;
  public branch: any;

  constructor(private branchService: BranchService, private route: ActivatedRoute, private router: Router) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap)=>{
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        console.log(this.id);

        this.branchService.show(this.id)
        .subscribe(response => {
          this.branch = response.data;
          console.log(this.branch);
        });

      }
    });
  }

}
