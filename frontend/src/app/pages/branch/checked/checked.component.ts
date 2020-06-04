import { Component, OnInit } from '@angular/core';
import { BranchService } from './../../../services/branch.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-checked',
  templateUrl: './checked.component.html',
  styleUrls: ['./checked.component.scss'],
})
export class CheckedComponent implements OnInit {
  checked: any;

  constructor(private branchService: BranchService, private router: Router) { }

  ngOnInit() {
    this.branchService.getChecked()
      .subscribe(checked => {
        this.checked = checked;
        console.log(checked);
    });
  }

  viewBranch(id) {
    console.log(id);
    this.router.navigate(['branch/checked/' + id]);
  }

}
