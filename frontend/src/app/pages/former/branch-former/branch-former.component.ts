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
  private month: string;
  private year: string;

  constructor(
    private branchService: BranchService,
    private route: ActivatedRoute,
    private router: Router
  ) { }

  ngOnInit() {
    this.route.paramMap.subscribe((paraMap: ParamMap) => {
      if(paraMap.has('id')){
        this.id = paraMap.get('id');
        this.year = paraMap.get('year');
        this.month = paraMap.get('month');
        console.log(this.id,this.month,this.year);

        this.branchService.getBranch(this.id)
          .subscribe(response => {
          this.branch = response;
          console.log(this.branch);
        });
      }
    });
  }
  viewMotocycles() {
    this.router.navigate(['result/' + this.year + '/' + this.month + '/branch/' + this.id + '/Motorcycles']);
  }
  viewSpares() {
    this.router.navigate(['result/' + this.year + '/' + this.month + '/branch/' + this.id + '/Spares']);
  }
  viewTools() {
    this.router.navigate(['result/' + this.year + '/' + this.month + '/branch/' + this.id + '/Tools']);
  }
  viewCosts() {
    this.router.navigate(['result/' + this.year + '/' + this.month + '/branch/' + this.id + '/Costs']);
  }
  viewReport() {
    this.router.navigate(['result/' + this.year + '/' + this.month + '/branch/' + this.id + '/Report']);
  }

}
