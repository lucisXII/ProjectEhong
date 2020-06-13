import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { BranchService } from './../../../services/branch.service';
import { Router } from '@angular/router';
import { SparesService } from 'src/app/services/spares.service';
import { CostService } from 'src/app/services/cost.service';
import { MotocyclesService } from 'src/app/services/motocycles.service';
import { ToolsService } from 'src/app/services/tools.service';

@Component({
  selector: 'app-unchecked-list',
  templateUrl: './unchecked-list.component.html',
  styleUrls: ['./unchecked-list.component.scss'],
})
export class UncheckedListComponent implements OnInit {
  branch: any;
  checkMotocycles: any;
  checkSpares: any;
  checkCost: any;
  checkTools: any;
  private id: string;

  constructor(
    private branchService: BranchService,
    private motocycleService: MotocyclesService,
    private sparesService: SparesService, 
    private costService: CostService,
    private toolsService: ToolsService,
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

        this.motocycleService.checkedMotocycles(this.id)
        .subscribe(response => {
          this.checkMotocycles = response;
          console.log(this.checkMotocycles);
        });

        this.sparesService.checkedSpares(this.id)
        .subscribe(response => {
          this.checkSpares = response;
          console.log(this.checkSpares);
        });

        this.toolsService.checkedTools(this.id)
        .subscribe(response => {
          this.checkTools = response;
          console.log(this.checkTools);
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

  viewMotocycles(id) {
    if(id == 0){
      this.router.navigate(['branch/' + this.id + '/motocycles/unchecked']);
    } else {
      this.router.navigate(['branch/' + this.id + '/motocycles/checked']);
    }
  }

  viewSpares(id) {
    if(id == 0){
      this.router.navigate(['branch/' + this.id + '/spares/unchecked']);
    } else {
      this.router.navigate(['branch/' + this.id + '/spares/checked']);
    }
  }

  viewTools(id) {
    if(id == 0){
      this.router.navigate(['branch/' + this.id + '/tools/unchecked']);
    } else {
      this.router.navigate(['branch/' + this.id + '/tools/checked']);
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
