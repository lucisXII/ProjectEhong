import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { BranchService } from './../../../services/branch.service';
import { SparesService } from 'src/app/services/spares.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-checked-list',
  templateUrl: './checked-list.component.html',
  styleUrls: ['./checked-list.component.scss'],
})
export class CheckedListComponent implements OnInit {
  public branch: any;
  public checkSpares: any;
  private id: string;

  constructor(
    private branchService: BranchService,
    private sparesService: SparesService,  
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

        this.sparesService.checkSpares(this.id)
        .subscribe(response => {
          this.checkSpares = response;
          console.log(this.checkSpares);
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
    // this.router.navigate(['branch/' + id + '/groups']);
  }

}
