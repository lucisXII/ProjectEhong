import { Component, OnInit } from '@angular/core';
import { BranchService } from './../../../services/branch.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-unchecked',
  templateUrl: './unchecked.component.html',
  styleUrls: ['./unchecked.component.scss'],
})
export class UncheckedComponent implements OnInit {
  public unChecked: any;

  constructor(private branchService: BranchService, private router: Router) { }

  ngOnInit() {
    this.branchService.getUnchecked()
      .subscribe(unChecked => {
        this.unChecked = unChecked;
        console.log(unChecked);
    });
  }

  viewBranch(id) {
    console.log(id);
    this.router.navigate(['branch/uncheked/' + id]);
  }

}
