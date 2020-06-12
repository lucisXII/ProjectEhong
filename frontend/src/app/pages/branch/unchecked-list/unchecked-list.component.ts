import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { BranchService } from './../../../services/branch.service';
import { Router } from '@angular/router';
import { SparesService } from 'src/app/services/spares.service';
import { CostService } from 'src/app/services/cost.service';

@Component({
  selector: 'app-unchecked-list',
  templateUrl: './unchecked-list.component.html',
  styleUrls: ['./unchecked-list.component.scss'],
})
export class UncheckedListComponent implements OnInit {
  branch: any;
  checkSpares: any;
  checkCost: any;
  private id: string;

  constructor(
    private branchService: BranchService,
    private sparesService: SparesService, 
    private costService: CostService,
    private route: ActivatedRoute, 
    private router: Router
    ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        console.log(this.id);

        this.branchService.getBranch(this.id)
          .subscribe(response => {
          this.branch = response;
          console.log(this.branch);
        });

        this.sparesService.checkedSpares(this.id)
        .subscribe(response => {
          this.checkSpares = response;
          console.log(this.checkSpares);
        });

        this.costService.checkedCost(this.id)
        .subscribe(response => {
          this.checkCost = response;
          console.log(this.checkCost);
        });

      }
    });
  }

  viewGroups(id) {
    console.log(id);
    this.router.navigate(['branch/' + id + '/groups']);
  }

  viewSpares(id) {
    if(id == 0){
      this.router.navigate(['branch/' + this.id + '/spares/unchecked']);
    } else {
      this.router.navigate(['branch/' + this.id + '/spares/checked']);
    }
  }

  viewCost(id) {
    if(id == 0){
      this.router.navigate(['branch/' + this.id + '/cost/unchecked']);
    } else {
      this.router.navigate(['branch/' + this.id + '/cost/checked']);
    }
  }

}
