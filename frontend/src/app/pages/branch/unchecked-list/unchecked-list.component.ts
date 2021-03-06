import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { BranchService } from './../../../services/branch.service';
import { Router } from '@angular/router';
import { SparesService } from 'src/app/services/spares.service';
import { CostService } from 'src/app/services/cost.service';
import { MotocyclesService } from 'src/app/services/motocycles.service';
import { ToolsService } from 'src/app/services/tools.service';
import { LoadingService } from 'src/app/services/loading.service';

@Component({
  selector: 'app-unchecked-list',
  templateUrl: './unchecked-list.component.html',
  styleUrls: ['./unchecked-list.component.scss'],
})
export class UncheckedListComponent implements OnInit {
  branch: any;
  checkRateAndScore: any;
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
    private router: Router,
    private loading : LoadingService
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

        this.branchService.getCheckedRateAndScore(this.id)
          .subscribe(response => {
          this.checkRateAndScore = response;
          console.log(this.checkRateAndScore);
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

  viewGroups() {
    this.router.navigate(['branch/' + this.id + '/groups']);
  }

  viewMotocycles(id) {
    if(id == 0){
      this.router.navigate(['branch/' + this.id + '/motocycles/unchecked']);
    } else if (id == 1) {
      this.router.navigate(['branch/' + this.id + '/motocycles/checked']);
    } else {
      return;
    }
  }

  viewSpares(id) {
    if(id == 0){
      this.router.navigate(['branch/' + this.id + '/spares/unchecked']);
    } else if (id == 1) {
      this.router.navigate(['branch/' + this.id + '/spares/checked']);
    } else {
      return;
    }
  }

  viewTools(id) {
    if(id == 0){
      this.router.navigate(['branch/' + this.id + '/tools/unchecked']);
    } else if (id == 1) {
      this.router.navigate(['branch/' + this.id + '/tools/checked']);
    } else {
      return;
    }
  }

  viewCost(id) {
    if(id == 0){
      this.router.navigate(['branch/' + this.id + '/cost/unchecked']);
    } else if (id == 1) {
      this.router.navigate(['branch/' + this.id + '/cost/checked']);
    } else {
      return;
    }
  }

  addConcludes() {
    this.loading.present();
    this.branchService.addConcludes(this.id);
  }

}
