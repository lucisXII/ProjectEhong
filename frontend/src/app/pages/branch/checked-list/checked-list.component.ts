import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { Router } from '@angular/router';
import { BranchService } from './../../../services/branch.service';
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
      }
    });
  }

  viewSpares() {
      this.router.navigate(['branch/' + this.id + '/spares']);
  }

  viewMotocycles() {
      this.router.navigate(['branch/' + this.id + '/motocycles']);
  }

  viewTools() {
      this.router.navigate(['branch/' + this.id + '/tools']);
  }

  viewCost() {
      this.router.navigate(['branch/' + this.id + '/cost']);
  }

}
