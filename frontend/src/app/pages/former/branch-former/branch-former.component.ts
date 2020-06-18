import { Component, OnInit } from '@angular/core';
import { BranchService } from 'src/app/services/branch.service';
import { ActivatedRoute, Router, ParamMap } from '@angular/router';

@Component({
  selector: 'app-branch-former',
  templateUrl: './branch-former.component.html',
  styleUrls: ['./branch-former.component.scss'],
})
export class BranchFormerComponent implements OnInit {

  public branch: any;
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

}
