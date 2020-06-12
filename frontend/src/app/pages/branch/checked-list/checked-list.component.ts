import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { Router } from '@angular/router';
import { BranchService } from './../../../services/branch.service';
import { SparesService } from 'src/app/services/spares.service';
import { MotocyclesService } from 'src/app/services/motocycles.service';
import { ToolsService } from 'src/app/services/tools.service';
import { CostService } from 'src/app/services/cost.service';

@Component({
  selector: 'app-checked-list',
  templateUrl: './checked-list.component.html',
  styleUrls: ['./checked-list.component.scss'],
})
export class CheckedListComponent implements OnInit {
  public branch: any;
  public checkSpares: any;
  public checkMotocycles: any;
  public checkTools: any;
  public checkCost: any;
  private id: string;

  constructor(
    private branchService: BranchService,
    private sparesService: SparesService,
    private motocycleService: MotocyclesService, 
    private toolsService: ToolsService,
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

        this.motocycleService.checkedMotocycles(this.id)
        .subscribe(response => {
          this.checkMotocycles = response;
          console.log(this.checkMotocycles);
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

  viewSpares(id) {
    if(id == 0){
      this.router.navigate(['branch/' + this.id + '/spares/unchecked']);
    } else {
      this.router.navigate(['branch/' + this.id + '/spares/checked']);
    }
  }

  viewMotocycles(id) {
    if(id == 0){
      this.router.navigate(['branch/' + this.id + '/motocycles/unchecked']);
    } else {
      this.router.navigate(['branch/' + this.id + '/motocycles/checked']);
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
